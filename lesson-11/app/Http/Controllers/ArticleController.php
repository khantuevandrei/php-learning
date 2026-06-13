<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ArticleController extends Controller
{
    public function create()
    {
        return view('articles.form', ['user' => auth()->user(), 'isEdit' => false]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        auth()->user()->articles()->create($validated);

        return redirect('/users')->with('success', 'Article created');
    }
}
