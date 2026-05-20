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
        Schema::table('movies', function (Blueprint $table) {
            $table->integer('duration')->nullable()->after('release_date'); // длительность в минутах
            $table->string('country')->nullable()->after('duration'); // страна
            $table->string('city')->nullable()->after('country'); // город
            $table->decimal('average_rating', 4, 2)->default(0)->after('city'); // средний рейтинг (0.00 - 10.00)
            $table->unsignedInteger('ratings_count')->default(0)->after('average_rating'); // количество оценок
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn([
                'duration',
                'country',
                'city',
                'average_rating',
                'ratings_count',
            ]);
        });
    }
};
