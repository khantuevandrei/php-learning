<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function index(): JsonResponse
    {
        $games = Game::paginate(10);
        return response()->json($games);
    }

    public function show(Game $game): JsonResponse
    {
        return response()->json($game);
    }

    public function store(Game $game): JsonResponse
    {
        auth()->user()->games()->attach($game->id);
        return response()->json(['message' => 'Game added to collection'], 201);
    }

    public function destroy(Game $game): JsonResponse
    {
        auth()->user()->games()->detach($game->id);
        return response()->json(['message' => 'Game removed from collection']);
    }
}
