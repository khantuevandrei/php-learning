<?php

namespace Tests\Unit;

use App\Models\Game;
use App\Models\User;
use App\Policies\GamePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamePolicyTest extends \PHPUnit\Framework\TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_their_own_game(): void
    {
        $user = $this->createUser(1);
        $game = $this->createGame(1, 1);

        $policy = new GamePolicy();
        $result = $policy->update($user, $game);

        $this->assertTrue($result);
    }

    public function test_user_cannot_update_other_user_game(): void
    {
        $user = $this->createUser(1);
        $game = $this->createGame(2, 2);

        $policy = new GamePolicy();
        $result = $policy->update($user, $game);

        $this->assertFalse($result);
    }



    private function createUser(int $id): User
    {
        $user = new User();
        $user->id = $id;
        return $user;
    }

    private function createGame(int $id, int $userId): Game
    {
        $game = new Game();
        $game->id = $id;
        $game->user_id = $userId;
        return $game;
    }
}
