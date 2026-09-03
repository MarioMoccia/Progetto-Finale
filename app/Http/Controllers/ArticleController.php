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
        $articles = Article::where('is_accepted', true)->with(['category', 'images'])->orderBy('created_at', 'desc')->paginate(6);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        abort_unless($article->is_accepted, 404);

        return view('articles.show', compact('article'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()->where('is_accepted', true)->with(['category', 'images'])->orderBy('created_at', 'desc')->get();

        return view('articles.by-category', compact('category', 'articles'));
    }
}
