<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Показ формы
    public function create()
    {
        $categories = Category::all();
        return view('cms.article.create', compact('categories'));
    }

    // Сохранение статьи
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $validated['image'] = $path;
        }
        Article::create($validated);
        return redirect()->route('cms.article')->with('success', 'Статья успешно добавлена!');
    }
    public function edit(Article $article){
        $categories = Category::all();
        return view('cms.article.edit', compact('article', 'categories'));
    }
    public function update(Request $request, Article $article){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $request->file('image')->store('articles', 'public');;
        }
        $article -> update($validated);
        return redirect()->route('cms.article')->with('success', 'Статья успешно обновлена!');
    }
    public function destroy(Article $article){
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return redirect()->route('cms.article')->with('success', 'Статья успешно удалена!');
    }
}
