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
              'role' => 'Главный редактор/Крёстная мать',
              'name' => 'Полина Брызгалова',
              'image' => 'team/Полина.jpg',
              'social' => 'mevampow',
              'details' => 'Улыбается, значит добрая =)',
          ],
          [
              'id' => 2,
              'role' => 'Веб-разработчик/Энергетик вместо крови',
              'name' => 'Максим Логвинов',
              'image' => 'team/Максим.jpg',
              'social' => 'WhatAboutAula',
              'details' => 'Люблю одну, хиджаб дарю, ебу жену, цыгель цыгель айлюлю!',
          ],
          [
              'id' => 3,
              'role' => 'Дизайнер/Намалевала наше видение',
              'name' => 'Дарья Сендык',
              'image' => 'team/Дарья.jpg',
              'social' => 'White_and_peachy',
              'details' => 'Дайте чая',
          ],
        ];
        return view('about', compact('title', 'team'));
    }
}
