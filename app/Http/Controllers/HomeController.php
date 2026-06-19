<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Вижн";
        $user = Auth::user();
        $articles = Article::latest()->take(15)->get();
        return view('home', compact('title', 'user', 'articles'));
    }
    public function show(Article $article){
        $title = "Вижн";
        $relatedNews = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();
        $post = $article;
        return view('article.show', compact('title', 'post', 'relatedNews'));
    }

}
