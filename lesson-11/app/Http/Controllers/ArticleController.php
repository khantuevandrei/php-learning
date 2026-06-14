<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    public function create()
    {
        return view('articles.form', ['article' => null, 'isEdit' => false]);
    }

    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        auth()->user()->articles()->create($validated);

        return redirect('/users')->with('success', 'Article created');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.form', ['article' => $article, 'isEdit' => true]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validated = $request->validated();

        $article->update($validated);

        return redirect('/users')->with('success', 'Article updated');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect('/users')->with('success', 'Article deleted');
    }
}
