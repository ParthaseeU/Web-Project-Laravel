<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = DB::table('teachers')->pluck('id');
        $subjects = DB::table('subjects')->pluck('subjects_code')->unique();

        if ($teachers->count() == 0 || $subjects->count() < 5) {
            throw new \Exception('Not enough teachers or subjects available. Make sure you have at least 5 subjects.');
        }

        $classGroups = ['RED', 'BLUE'];

        // Take 5 unique subject codes
        $selectedSubjects = $subjects->random(5);

        foreach ($classGroups as $classGroup) {
            foreach ($selectedSubjects as $subjectCode) {
                DB::table('classes')->insert([
                    'level' => 1,
                    'class_group' => $classGroup,
                    'subjects_code' => $subjectCode,
                    'teachers_id' => $teachers->random(), // Random teacher
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
