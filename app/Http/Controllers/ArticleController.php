<?php

namespace App\Http\Controllers;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function  show(Article $article)
    {
        return $article;
    }

    public function store()
    {
        $article = Article::create(request()->all());
        return response()->json($article, 201);
    }

    public function update(Article $article)
    {
        $article->update(request()->all());
        return  response()->json($article, 200);
    }

    public function  delete(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
