<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); //название
            $table->integer('year'); //год выпуска
            $table->string('description'); //описание
            $table->string('image'); //фотка
            $table->string('genre'); //жанр
            $table->string('director'); //режиссер
            $table->datetime('release_date'); // полная дата релиза
            $table->string('link'); //ссылка на ВК или другую хуйню
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
