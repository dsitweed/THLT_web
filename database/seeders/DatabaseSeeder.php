<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'id' => 1,
            'name' => "Student1",
            'email' => "student@gmail.com",
            'password' => Hash::make("123"),
            'role' => 'student',
        ]);

        Student::create([
            'id' => 1,
            'user_id' => 1,
        ]);

        User::create([
            'id' => 2,
            'name' => "Teacher",
            'email' => "teacher@gmail.com",
            'password' => Hash::make("123"),
            'role' => 'teacher',
        ]);

        Teacher::create([
            'id' => 1,
            'user_id' => 2,
        ]);

        Course::create([
            'id' => 1,
            "name" => 'Math',
            'description' => "Just for test",
            'teacher_id' => 1,
            'privacy' => 'public',
            'code' => null,
        ]);
    }
}
