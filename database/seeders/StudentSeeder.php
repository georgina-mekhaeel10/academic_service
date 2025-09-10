<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('1'), // تشفير كلمة المرور
            'age' => 22,
            'phone' => '123-456-7890',
            'gender' => 'Male'
        ]);
    }
}
