<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = DB::table('subjects')->pluck('subjects_code'); // Fetch all subjects codes

        if ($subjects->count() == 0) {
            throw new \Exception('No subjects found! Please seed subjects first.');
        }

        for ($i = 1; $i <= 10; $i++) { // Let's create 10 teachers

            // Insert into users table
            $userId = DB::table('users')->insertGetId([
                'name' => 'Teacher' . $i,
                'email' => 'teacher' . $i . '@example.com',
                'password' => Hash::make('password'), // Default password
                'date_of_birth' => now()->subYears(rand(25, 35))->subDays(rand(0, 365)),
                'gender' => (rand(0, 1) == 1) ? 'M' : 'F',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Random subject assignment
            $subjectCode = $subjects->random();

            // Insert into teachers table
            DB::table('teachers')->insert([
                'user_id' => $userId,
                'subjects_taught' => $subjectCode,
                'date_joined' => now()->subYears(rand(1, 5))->subDays(rand(0, 365)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
