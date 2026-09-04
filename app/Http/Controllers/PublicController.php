<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function Homepage()
    {
        $articles = Article::where('is_accepted', true)->with(['category', 'images'])->orderBy('created_at', 'desc')->take(6)->get();

        return view('homepage', compact('articles'));
    }

    public function about()
    {
        return view('about');
    }

    public function setLanguage(string $lang)
    {
        if (in_array($lang, ['it', 'gb', 'fr'])) {
            session()->put('locale', $lang);
        }

        return redirect()->back();
    }

    public function searchArticles(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::search($query)
            ->where('is_accepted', true)
            ->query(fn ($builder) => $builder->with(['category', 'images']))
            ->paginate(6);

        return view('articles.searched', ['articles' => $articles, 'query' => $query]);
    }
}
