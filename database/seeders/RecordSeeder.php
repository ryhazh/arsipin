<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Record;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordSeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::all()->pluck('id'); // Changed from available_copies check since it's now dynamic
        $userRoleId = DB::table('roles')->where('name', 'user')->first()->id;
        $users = User::where('role_id', $userRoleId)->pluck('id');

        $faker = \Faker\Factory::create();
        
        $reasons = [
            'Academic research',
            'Personal reading',
            'School assignment',
            'Book report',
            'Self-improvement',
            'Course requirement',
            'Thesis reference',
            'Project research'
        ];

        foreach($books as $bookId) {
            $randomUsers = $users->random(rand(1, 2)); 
            
            foreach($randomUsers as $userId) {
                $borrowedAt = $faker->dateTimeBetween('-3 months', 'now');
                $book = Book::find($bookId);
                
                $availableCopies = $book->available_copies;
                if ($availableCopies > 0) {
                    Record::create([
                        'book_id' => $bookId,
                        'user_id' => $userId,
                        'borrowed_at' => $borrowedAt,
                        'reason' => $faker->randomElement($reasons),
                        'quantity' => rand(1, min(3, $availableCopies)),
                        'due_date' => date('Y-m-d', strtotime($borrowedAt->format('Y-m-d') . ' +14 days')),
                        'returned_at' => $faker->randomElement([
                            $faker->dateTimeBetween($borrowedAt, 'now'),
                            null
                        ]),
                        'is_approved' => $faker->randomElement([true, false]),
                    ]);
                }
            }
        }
    }
}
