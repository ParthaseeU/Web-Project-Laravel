<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Insert root admin
        DB::table('user')->insert([
            'DateOfBirth' => '1970-01-01',
            'FirstName' => 'root',
            'LastName' => 'admin',
            'Email' => 'root@email.com',
            'Gender' => 'M',
            'Password' => 'rootPass123',
        ]);

        $adminId = DB::table('user')->where('Email', 'root@email.com')->value('UserID');

        DB::table('administrator')->insert([
            'AdminID' => $adminId,
            'DateJoined' => now()->toDateString(),
        ]);

        // Subjects
        DB::table('subject')->insert([
            ['SubjectCode' => 'MATH1', 'SubjectName' => 'Mathematics 1'],
            ['SubjectCode' => 'ENG1', 'SubjectName' => 'English 1'],
            ['SubjectCode' => 'CS101', 'SubjectName' => 'Introduction to Computer Science'],
            ['SubjectCode' => 'MA102', 'SubjectName' => 'Calculus I'],
            ['SubjectCode' => 'PH103', 'SubjectName' => 'Physics for Engineers'],
            ['SubjectCode' => 'CS201', 'SubjectName' => 'Data Structures'],
            ['SubjectCode' => 'CS202', 'SubjectName' => 'Database Systems'],
            ['SubjectCode' => 'MA203', 'SubjectName' => 'Linear Algebra'],
            ['SubjectCode' => 'PH204', 'SubjectName' => 'Electromagnetism'],
            ['SubjectCode' => 'CS301', 'SubjectName' => 'Operating Systems'],
            ['SubjectCode' => 'CS302', 'SubjectName' => 'Software Engineering'],
            ['SubjectCode' => 'MA304', 'SubjectName' => 'Discrete Mathematics'],
            ['SubjectCode' => 'CS305', 'SubjectName' => 'Computer Networks'],
            ['SubjectCode' => 'CS306', 'SubjectName' => 'Artificial Intelligence'],
        ]);

        // Students
        DB::table('user')->insert([
            [
                'DateOfBirth' => '2005-02-15',
                'FirstName' => 'John',
                'LastName' => 'Doe',
                'Email' => 'john.doe@email.com',
                'Gender' => 'M',
                'Password' => 'studentPass123',
            ],
            [
                'DateOfBirth' => '2005-05-23',
                'FirstName' => 'Jane',
                'LastName' => 'Smith',
                'Email' => 'jane.smith@email.com',
                'Gender' => 'F',
                'Password' => 'studentPass123',
            ]
        ]);

        $johnId = DB::table('user')->where('Email', 'john.doe@email.com')->value('UserID');
        $janeId = DB::table('user')->where('Email', 'jane.smith@email.com')->value('UserID');

        DB::table('student')->insert([
            ['StudentID' => $johnId, 'Level' => 1, 'ClassGroup' => 'RED'],
            ['StudentID' => $janeId, 'Level' => 1, 'ClassGroup' => 'BLUE'],
        ]);

        // Teachers (unauthorized and authorized)
        DB::table('user')->insert([
            [
                'DateOfBirth' => '1980-03-10',
                'FirstName' => 'Mark',
                'LastName' => 'Twain',
                'Email' => 'mark.twain@email.com',
                'Gender' => 'M',
                'Password' => 'teacherPass123',
            ],
            [
                'DateOfBirth' => '1980-03-10',
                'FirstName' => 'Kelvin',
                'LastName' => 'Lord',
                'Email' => 'lord.kelvin@email.com',
                'Gender' => 'M',
                'Password' => 'teacherPass123',
            ],
            [
                'DateOfBirth' => '1980-03-10',
                'FirstName' => 'Michael',
                'LastName' => 'Bron',
                'Email' => 'michael.bron@email.com',
                'Gender' => 'M',
                'Password' => 'teacherPass123',
            ],
        ]);

        $michaelId = DB::table('user')->where('Email', 'michael.bron@email.com')->value('UserID');

        // Authorize Michael as a teacher
        DB::table('teacher')->insert([
            'TeacherID' => $michaelId,
            'SubjectTaught' => 'ENG1',
            'DateJoined' => now()->toDateString(),
        ]);

        // Now insert the classes using Michael's ID as teacher
        DB::table('class')->insert([
            ['Level' => 1, 'ClassGroup' => 'RED', 'SubjectCode' => 'ENG1', 'TeacherID' => $michaelId],
            ['Level' => 1, 'ClassGroup' => 'BLUE', 'SubjectCode' => 'ENG1', 'TeacherID' => $michaelId],
        ]);


        $class1Id = DB::table('class')->where('Level', 1)->where('ClassGroup', 'RED')->where('SubjectCode', 'ENG1')->value('ClassID');
        $class2Id = DB::table('class')->where('Level', 1)->where('ClassGroup', 'BLUE')->where('SubjectCode', 'ENG1')->value('ClassID');

        DB::table('class_student')->insert([
            ['ClassID' => $class1Id, 'StudentID' => $johnId],
            ['ClassID' => $class2Id, 'StudentID' => $janeId],
        ]);

        // Assign teacher to class
        DB::table('class')
            ->where('ClassID', $class1Id)
            ->update(['TeacherID' => $michaelId]);

        // Approve Mark Twain
        $markId = DB::table('user')->where('Email', 'mark.twain@email.com')->value('UserID');

        DB::table('approval')->insert([
            'AdminID' => $adminId,
            'UserID' => $markId,
            'UserType' => 'teacher',
            'IsApproved' => true,
        ]);

        // Send a message from Michael Bron
        DB::table('class_message')->insert([
            'ClassID' => $class1Id,
            'UserID' => $michaelId,
            'DateSent' => now(),
            'Message' => 'Welcome to the class',
        ]);
    }
}
