<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            ['subjects_code' => 'CS101', 'subjects_name' => 'Introduction to Computer Science', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'MA102', 'subjects_name' => 'Calculus I', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'PH103', 'subjects_name' => 'Physics for Engineers', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'CS201', 'subjects_name' => 'Data Structures', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'CS202', 'subjects_name' => 'Database Systems', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'MA203', 'subjects_name' => 'Linear Algebra', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'PH204', 'subjects_name' => 'Electromagnetism', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'CS301', 'subjects_name' => 'Operating Systems', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'CS302', 'subjects_name' => 'Software Engineering', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'MA304', 'subjects_name' => 'Discrete Mathematics', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'CS305', 'subjects_name' => 'Computer Networks', 'created_at' => now(), 'updated_at' => now()],
            ['subjects_code' => 'CS306', 'subjects_name' => 'Artificial Intelligence', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
