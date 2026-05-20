<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CMSController extends Controller
{
    public function index(){
        $title = "cms";
        $user = Auth::user();
        return view('cms.index', compact('title', 'user'));
    }
    public function article()
    {
        $title = "Редакция новостей";
        $articles = Article::all();
        return view('cms.article.index', compact('title', 'articles'));
    }
    public function special()
    {
        $title = "Специальные выпуски";
        return view('cms.special', compact('title'));
    }
    public function movie()
    {
        $title = "Редактор кино";
        $movies = Movie::all();
        return view('cms.movie.index', compact('title', 'movies'));
    }
}
