<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: Clear old class_students records
        DB::table('class_students')->truncate();

        $classes = DB::table('classes')->get();

        foreach ($classes as $class) {
            // Find all students matching the class's level and class_group
            $matchingStudents = DB::table('students')
                ->where('level', $class->level)
                ->where('class_group', $class->class_group)
                ->pluck('id');

            if ($matchingStudents->isEmpty()) {
                // No matching students for this class — just skip
                continue;
            }

            foreach ($matchingStudents as $studentId) {
                DB::table('class_students')->insert([
                    'class_id' => $class->id,
                    'students_id' => $studentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
