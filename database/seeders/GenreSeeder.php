<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Mystery'],
            ['name' => 'Romance'],
            ['name' => 'Science Fiction'],
            ['name' => 'Fantasy'],
            ['name' => 'Thriller'],
            ['name' => 'Horror'],
            ['name' => 'Adventure'],
            ['name' => 'Drama'],
            ['name' => 'Poetry'],
            ['name' => 'Comedy'],
        ];

        DB::table('genres')->insert($genres);
    }
}