<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::paginate(10);

        $ownedGameIds = auth()->user()->games()->pluck('game_id')->toArray();

        return view('games.index', ['games' => $games, 'ownedGameIds' => $ownedGameIds]);
    }

    public function show(Game $game)
    {
        $isOwned = auth()->user()->games->contains($game);

        return view('games.show', ['game' => $game, 'isOwned' => $isOwned]);
    }

    public function store(Game $game)
    {
        auth()->user()->games()->attach($game->id);

        return back()->with('success', 'Game added to your collection');
    }

    public function destroy(Game $game)
    {
        auth()->user()->games()->detach($game->id);

        return back()->with('success', 'Game removed from your collection');
    }
}
