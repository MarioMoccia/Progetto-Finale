<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['create']),
        ];
    }

    public function create()
    {
        return view('articles.create');
    }

    public function index()
    {
        $articles = Article::with('category')->orderBy('created_at', 'desc')->paginate(6);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()->with('category')->orderBy('created_at', 'desc')->get();

        return view('articles.by-category', compact('category', 'articles'));
    }
}
