<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            ['title' => 'The Witcher 3', 'genre' => 'RPG', 'platform' => 'PC', 'description' => 'Охота на монстров в открытом мире'],
            ['title' => 'Elden Ring', 'genre' => 'Action RPG', 'platform' => 'PlayStation', 'description' => 'Мир между землями'],
            ['title' => 'Zelda: Tears of the Kingdom', 'genre' => 'Adventure', 'platform' => 'Nintendo', 'description' => 'Продолжение Breath of the Wild'],
            ['title' => 'Red Dead Redemption 2', 'genre' => 'Action', 'platform' => 'PC', 'description' => 'Вестерн от Rockstar'],
            ['title' => 'Cyberpunk 2077', 'genre' => 'RPG', 'platform' => 'PC', 'description' => 'Найт-Сити и киберимпланты'],
            ['title' => 'God of War Ragnarok', 'genre' => 'Action', 'platform' => 'PlayStation', 'description' => 'Кратос и Атрей в скандинавской мифологии'],
            ['title' => 'Hollow Knight', 'genre' => 'Metroidvania', 'platform' => 'PC', 'description' => 'Подземное королевство жуков'],
            ['title' => 'Stardew Valley', 'genre' => 'Simulation', 'platform' => 'PC', 'description' => 'Ферма и жизнь в долине'],
            ['title' => 'Baldur\'s Gate 3', 'genre' => 'RPG', 'platform' => 'PC', 'description' => 'D&D в цифровом формате'],
            ['title' => 'Super Mario Odyssey', 'genre' => 'Platformer', 'platform' => 'Nintendo', 'description' => 'Марио путешествует по мирам'],
            ['title' => 'Horizon Forbidden West', 'genre' => 'Action RPG', 'platform' => 'PlayStation', 'description' => 'Элой на запретном западе'],
            ['title' => 'Hades', 'genre' => 'Roguelike', 'platform' => 'PC', 'description' => 'Побег из подземного мира'],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
