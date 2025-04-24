<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create 'subject' table
        Schema::create('subject', function (Blueprint $table) {
            $table->string('SubjectCode', 5)->primary();
            $table->string('SubjectName', 128)->nullable();
        });

        // Create 'user' table
        Schema::create('user', function (Blueprint $table) {
            $table->id('UserID');
            $table->date('DateOfBirth');
            $table->string('FirstName', 64)->nullable();
            $table->string('LastName', 32)->nullable();
            $table->string('Email', 64)->unique();
            $table->char('Gender', 1);
            $table->string('Password', 125);
        });

        // Create 'student' table
        Schema::create('student', function (Blueprint $table) {
            $table->id('StudentID');
            $table->smallInteger('Level');
            $table->string('ClassGroup', 5);

            $table->foreign('StudentID')->references('UserID')->on('user')->onDelete('cascade');
        });

        // Create 'teacher' table
        Schema::create('teacher', function (Blueprint $table) {
            $table->id('TeacherID');
            $table->string('SubjectTaught', 5);
            $table->date('DateJoined');

            $table->foreign('TeacherID')->references('UserID')->on('user')->onDelete('cascade');
        });

        // Create 'class' table
        Schema::create('class', function (Blueprint $table) {
            $table->id('ClassID');
            $table->smallInteger('Level');
            $table->string('ClassGroup', 5);
            $table->string('SubjectCode', 5);
            $table->unsignedBigInteger('TeacherID');

            $table->foreign('TeacherID')->references('TeacherID')->on('teacher')->onDelete('cascade');
            $table->foreign('SubjectCode')->references('SubjectCode')->on('subject')->onDelete('cascade');
        });

        // Create 'class_student' pivot table
        Schema::create('class_student', function (Blueprint $table) {
            $table->unsignedBigInteger('ClassID');
            $table->unsignedBigInteger('StudentID');

            $table->primary(['ClassID', 'StudentID']);
            $table->foreign('ClassID')->references('ClassID')->on('class')->onDelete('cascade');
            $table->foreign('StudentID')->references('StudentID')->on('student')->onDelete('cascade');
        });

        // Create 'class_message' table
        Schema::create('class_message', function (Blueprint $table) {
            $table->unsignedBigInteger('ClassID');
            $table->unsignedBigInteger('UserID');
            $table->dateTime('DateSent');
            $table->string('Message', 256);

            $table->primary(['UserID', 'ClassID', 'DateSent']);
            $table->foreign('ClassID')->references('ClassID')->on('class')->onDelete('cascade');
            $table->foreign('UserID')->references('UserID')->on('user')->onDelete('cascade');
        });

        // Create 'administrator' table
        Schema::create('administrator', function (Blueprint $table) {
            $table->id('AdminID');
            $table->date('DateJoined');

            $table->foreign('AdminID')->references('UserID')->on('user')->onDelete('cascade');
        });

        // Create 'approval' table
        Schema::create('approval', function (Blueprint $table) {
            $table->unsignedBigInteger('AdminID')->nullable();
            $table->unsignedBigInteger('UserID')->primary();
            $table->string('UserType', 15);
            $table->boolean('IsApproved')->default(false);

            $table->foreign('AdminID')->references('AdminID')->on('administrator')->onDelete('cascade');
            $table->foreign('UserID')->references('UserID')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval');
        Schema::dropIfExists('administrator');
        Schema::dropIfExists('class_message');
        Schema::dropIfExists('class_student');
        Schema::dropIfExists('class');
        Schema::dropIfExists('teacher');
        Schema::dropIfExists('student');
        Schema::dropIfExists('user');
        Schema::dropIfExists('subject');
    }
};
