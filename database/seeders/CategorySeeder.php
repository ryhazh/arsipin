<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science'],
            ['name' => 'Technology'],
            ['name' => 'History'],
            ['name' => 'Biography'],
            ['name' => 'Literature'],
            ['name' => 'Reference'],
        ];

        DB::table('categories')->insert($categories);
    }
}