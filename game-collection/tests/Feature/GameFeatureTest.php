<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Game;
use App\Models\User;

class GameFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_game_catalog(): void
    {
        Game::create([
            'title' => 'Test Game',
            'genre' => 'RPG',
            'platform' => 'PC',
            'description' => 'A test game'
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('Test Game');
    }

    public function test_user_can_add_game_to_collection(): void
    {
        $game = Game::create([
            'title' => 'Elden Ring',
            'genre' => 'Action RPG',
            'platform' => 'PC',
            'description' => 'Rise, Tarnished'
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post("/games/{$game->id}");

        $response->assertRedirect();
        $this->assertDatabaseHas('game_user', [
            'user_id' => $user->id,
            'game_id' => $game->id,
            'status' => 'wishlist'
        ]);
    }

    public function test_user_can_remove_game_from_collection(): void
    {
        $game = Game::create([
            'title' => 'Elden Ring',
            'genre' => 'Action RPG',
            'platform' => 'PC',
            'description' => 'Rise, Tarnished'
        ]);

        $user = User::factory()->create();
        $user->games()->attach($game->id, ['status' => 'wishlist']);

        $response = $this->actingAs($user)->delete("/games/{$game->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('game_user', [
            'user_id' => $user->id,
            'game_id' => $game->id
        ]);
    }
}
