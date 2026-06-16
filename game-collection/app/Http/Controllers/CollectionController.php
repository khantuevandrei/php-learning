<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class CollectionController extends Controller
{
    public function index()
    {
        $games = auth()->user()->games()->withPivot('status', 'rating', 'notes')->paginate(10);

        return view('collection.index', ['games' => $games]);
    }

    public function edit(Game $game)
    {
        $pivot = auth()->user()->games()->where('game_id', $game->id)->first();

        if (!$pivot) abort(404);

        return view('collection.form', [
            'game' => $game,
            'status' => $pivot->pivot->status,
            'rating' => $pivot->pivot->rating,
            'notes' => $pivot->pivot->notes,
        ]);
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:playing,completed,dropped,wishlist',
            'rating' => 'nullable|integer|min:1|max:10',
            'notes' => 'nullable|string|max:500'
        ]);

        auth()->user()->games()->updateExistingPivot($game->id, $validated);

        return redirect('/collection')->with('success', 'Game updated');
    }
}
