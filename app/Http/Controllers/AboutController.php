<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $title = "Наша команда";
        $team = [
          [
              'id' => 1,
              'role' => 'Главный редактор',
              'name' => 'Полина Брызгалова',
              'image' => 'team/Полина.jpg',
              'social' => 'mevampow',
              'details' => 'Улыбается, значит добрая =)',
          ],
          [
              'id' => 2,
              'role' => 'Веб-разработчик',
              'name' => 'Максим Логвинов',
              'image' => 'team/Максим.jpg',
              'social' => 'WhatAboutAula',
              'details' => 'По вайбу что-то между солнцем и психом',
          ],
          [
              'id' => 3,
              'role' => 'Дизайнер',
              'name' => 'Дарья Сендык',
              'image' => 'team/Дарья.jpg',
              'social' => 'White_and_peachy',
              'details' => 'Дайте чая',
          ],
        ];
        return view('about', compact('title', 'team'));
    }

    public function about()
    {
        $title = "Наша задача";
        return view('mission', compact('title'));
    }
}
