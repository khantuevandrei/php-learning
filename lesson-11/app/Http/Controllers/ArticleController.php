<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ArticleController extends Controller
{
    public function create(User $user)
    {
        return view('articles.form', ['user' => $user, 'isEdit' => false]);
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $user->articles()->create($validated);

        return redirect('/users')->with('success', 'Article created');
    }
}
