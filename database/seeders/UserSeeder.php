<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(int $count = 15): void
    {
        // Create admin account
        $adminRole = DB::table('roles')->where('name', 'admin')->first()->id;
        User::create([
            'role_id' => $adminRole,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '123456789',
            'password' => bcrypt('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create regular users
        $userRole = DB::table('roles')->where('name', 'user')->first()->id;
        $users = [];
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $users[] = [
                'role_id' => $userRole,
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        User::insert($users);
    }
}
