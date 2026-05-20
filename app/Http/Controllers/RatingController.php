<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;

class RatingController extends Controller
{
    public function store(Request $request, Movie $movie): RedirectResponse
    {
        $data = $request->validate([
            'nickname' => 'required|string|min:2|max:30',
            'score' => 'required|integer|min:1|max:10',
            'review' => 'nullable|string|max:1000',
        ], [
            'nickname.required' => 'Введите ник',
            'nickname.min' => 'Ник слишком короткий',
            'score.required' => 'Поставьте оценку',
            'score.min' => 'Оценка должна быть от 1 до 10',
            'score.max' => 'Оценка должна быть от 1 до 10',
        ]);
        $alreadyRated = Rating::where('movie_id', $movie->id)
            ->where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if ($alreadyRated) {
            return back()
                ->withInput()
                ->withErrors(['nickname' => 'Вы уже оценивали этот фильм недавно']);
        }

        Rating::create([
            'movie_id' => $movie->id,
            'nickname' => $data['nickname'],
            'score' => $data['score'],
            'review' => $data['review'] ?? null,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Спасибо за вашу оценку!');
    }
}
