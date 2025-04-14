<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        
        $categories = DB::table('categories')->pluck('id')->toArray();
        $genres = DB::table('genres')->pluck('id')->toArray();
        $imagePath = 'books/oXUNg1CACorFyhUaOEBMVEfeBXIrNsRIlvcgbuA4.jpg';

        for ($i = 0; $i < 20; $i++) {
            $book = Book::create([
                'title' => $faker->sentence(3),
                'author' => $faker->name(),
                'publisher' => $faker->company(),
                'publication_date' => $faker->dateTimeBetween('-30 years', '-1 year')->format('Y-m-d'),
                'description' => $faker->sentence(),
                'category_id' => $faker->randomElement($categories),
                'total_copies' => $faker->numberBetween(1, 5),
                'image' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Attach 1-3 random genres to each book
            $randomGenres = array_rand($genres, rand(1, 3));
            if (!is_array($randomGenres)) {
                $randomGenres = [$randomGenres];
            }
            
            foreach ($randomGenres as $genreId) {
                DB::table('book_genres')->insert([
                    'book_id' => $book->id,
                    'genre_id' => $genres[$genreId],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}