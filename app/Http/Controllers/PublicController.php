<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function Homepage()
    {
        $articles = Article::where('is_accepted', true)->with('category')->orderBy('created_at', 'desc')->take(6)->get();

        return view('homepage', compact('articles'));
    }

    public function searchArticles(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::search($query)
            ->where('is_accepted', true)
            ->query(fn ($builder) => $builder->with('category'))
            ->paginate(6);

        return view('articles.searched', ['articles' => $articles, 'query' => $query]);
    }
}
