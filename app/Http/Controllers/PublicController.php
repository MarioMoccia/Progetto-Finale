<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PublicController extends Controller
{
    public function Homepage()
    {
        $articles = Article::where('is_accepted', true)->with('category')->orderBy('created_at', 'desc')->take(6)->get();

        return view('homepage', compact('articles'));
    }
}
