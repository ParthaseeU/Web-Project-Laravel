<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // 1. 'subjects' Table
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subjects_code', 5)->unique(); // Original primary key, now unique
            $table->string('subjects_name', 128)->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('date_of_birth')->nullable();
            $table->char('gender', 1)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 3. 'students' Table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('level');
            $table->string('class_group', 5);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // 4. 'teachers' Table
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // New integer primary key 'id'
            $table->unsignedBigInteger('user_id');
            $table->string('subjects_taught', 5);
            $table->date('date_joined');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subjects_taught')->references('subjects_code')->on('subjects')->onDelete('cascade'); // Foreign key
        });

        // 5. 'classes' Table
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('level');
            $table->string('class_group', 5);
            $table->string('subjects_code', 5);
            $table->unsignedBigInteger('teachers_id');
            $table->timestamps();

            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade'); // Changed to id
            $table->foreign('subjects_code')->references('subjects_code')->on('subjects')->onDelete('cascade');
        });

        // 6. 'class_students' Pivot Table
        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('students_id');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade'); // Changed to id
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade'); // Changed to id
            $table->unique(['class_id', 'students_id']);
        });

        // 7. 'class_message' Table
        Schema::create('class_message', function (Blueprint $table) {
            $table->id(); // New integer primary key 'id'
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('date_sent');
            $table->string('message', 256);
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade'); // Changed to id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'class_id', 'date_sent']);
        });

        // 8. 'administrators' Table
        Schema::create('administrators', function (Blueprint $table) {
            $table->id(); // New integer primary key 'id'
            $table->unsignedBigInteger('user_id');
            $table->date('date_joined');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // 9. 'approvals' Table
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->string('user_type', 15);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('administrators')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
        Schema::dropIfExists('administrators');
        Schema::dropIfExists('class_messages');
        Schema::dropIfExists('class_students');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('students');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
