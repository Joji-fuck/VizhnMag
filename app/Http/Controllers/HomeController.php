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

        $col1 = collect();
        $col2 = collect();
        $col3 = collect();

        foreach ($articles as $key=>$article) {
            if ($key % 3 == 0){
                $col1->push($article);
            }
            elseif ($key % 3 == 1){
                $col2->push($article);
            }
            else{
                $col3->push($article);
            }
        }
        return view('home', compact('title', 'user', 'articles', 'col1', 'col2', 'col3'));
    }
    public function show(Article $article){
        $title = "Вижн";
        $relatedNews = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();
        $post = $article;
        return view('news.show', compact('title', 'post', 'relatedNews'));
    }

}
