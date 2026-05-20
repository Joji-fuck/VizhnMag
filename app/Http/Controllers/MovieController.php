<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $title = "Фильмы Вижн";
        $movies = Movie::latest()->take(15)->get();

        $col1 = collect();
        $col2 = collect();
        $col3 = collect();
        $col4 = collect();

        foreach ($movies as $key => $movie) {
            if ($key % 4 == 0) {
                $col1->push($movie);
            } elseif ($key % 4 == 1) {
                $col2->push($movie);
            } elseif ($key % 4 == 2) {
                $col3->push($movie);
            } else {
                $col4->push($movie);
            }
        }
        return view('movie', compact('title',  'movies', 'col1', 'col2', 'col3', 'col4'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Фильмы";
        $categories = Category::all();
        return view('cms.movie.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'description'  => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|string|max:100',
            'director'  => 'required|string|max:255',
            'release_date' => 'required|date',
            'duration' => 'required|integer',
            'country' => 'required|string',
            'city' => 'required|string',
            'link' => 'required|url|max:500',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('movies', 'public');
            $validated['image'] = $path;
        }

        Movie::create($validated);

        return redirect()->route('cms.movie')->with('success', 'Статья успешно добавлена!');
    }
    public function show(Movie $movie)
    {
        $title = "Вижн";
        $post = $movie;
        return view('movie.show', compact('title', 'post'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $title = "Редактор фильма";
        return view('cms.movie.edit', compact('movie', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'description'  => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|string|max:100',
            'director'  => 'required|string|max:255',
            'release_date' => 'required|date',
            'duration' => 'required|integer',
            'country' => 'required|string',
            'city' => 'required|string',
            'link' => 'required|url|max:500',
        ]);
        if ($request->hasFile('image')) {
            if ($movie->image) {
                Storage::disk('public')->delete($movie->image);
            }
            $validated['image'] = $request->file('image')->store('movie', 'public');;
        }
        $movie -> update($validated);
        return redirect()->route('cms.movie')->with('success', 'Статья успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        if ($movie->image) {
            Storage::disk('public')->delete($movie->image);
        }
        $movie->delete();
        return redirect()->route('cms.movie')->with('success', 'Статья успешно удалена!');
    }

}
