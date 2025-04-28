<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classGroups = ['RED', 'BLUE'];

        for ($i = 1; $i <= 20; $i++) {

            // Insert into users table
            $userId = DB::table('users')->insertGetId([
                'name' => 'Student' . $i,
                'email' => 'student' . $i . '@example.com',
                'password' => Hash::make('password'), // Default password: "password"
                'date_of_birth' => now()->subYears(rand(15, 20))->subDays(rand(0, 365)),
                'gender' => rand(0, 1) === 1 ? 'M' : 'F',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert into students table linked to user_id
            DB::table('students')->insert([
                'user_id' => $userId,
                'level' => 1, // Always Level 1
                'class_group' => $classGroups[array_rand($classGroups)], // RED or BLUE randomly
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
