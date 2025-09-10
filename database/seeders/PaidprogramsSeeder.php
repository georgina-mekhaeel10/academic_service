<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paidprograms;
class PaidprogramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
   

        Paidprograms::insert([
    [
        'university_ID' => 1, // ربط بجامعة أكسفورد (ID الخاص بها في جدول الجامعات)
        'name' => 'Master of Business Administration (MBA)', // اسم البرنامج
        'description' => 'A graduate business program designed to develop leadership and managerial skills.', // الوصف
        'start_date' => '2025-09-01', // تاريخ البدء
        'end_date' => '2027-06-30', // تاريخ الانتهاء
        'cost' => 120000, // التكلفة
        'type' => 'master', // نوع البرنامج (ماجستير)
        'country' => 'United Kingdom', // البلد
        'uploaded_data' => null,
        'application_url' => 'https://www.ox.ac.uk/admissions/mba' // رابط التقديم
    ],
   [
        'university_ID' => 2, // ربط بجامعة كامبريدج (ID الخاص بها في جدول الجامعات)
        'name' => 'PhD in Physics', // اسم البرنامج
        'description' => 'An advanced program in theoretical and experimental physics, preparing students for careers in research and academia.', // الوصف
        'start_date' => '2025-10-01', // تاريخ البدء
        'end_date' => '2030-06-30', // تاريخ الانتهاء
        'cost' => 150000, // التكلفة
        'type' => 'phd', // نوع البرنامج (دكتوراه)
        'country' => 'United Kingdom', // البلد
        'uploaded_data' => json_encode(['documents' => 'research_proposal.pdf', 'transcripts' => 'academic_transcript.pdf']), // بيانات مرفوعة (اختياري)
        'application_url' => 'https://www.cam.ac.uk/admissions/phd-physics' // رابط التقديم
    ],
    [
        'university_ID' => 3, // ربط بجامعة ستانفورد (ID الخاص بها في جدول الجامعات)
        'name' => 'Bachelor of Science in Computer Science', // اسم البرنامج
        'description' => 'A comprehensive undergraduate program that covers programming, data structures, algorithms, and artificial intelligence.', // الوصف
        'start_date' => '2025-08-15', // تاريخ البدء
        'end_date' => '2029-05-20', // تاريخ الانتهاء
        'cost' => 80000, // التكلفة
        'type' => 'university', // نوع البرنامج (بكالوريوس)
        'country' => 'United States', // البلد
        'uploaded_data' => json_encode(['documents' => 'highschool_transcript.pdf', 'recommendations' => 'letter_of_recommendation.pdf']), // بيانات مرفوعة (اختياري)
        'application_url' => 'https://admission.stanford.edu' // رابط التقديم
    ]
]);

    }
}
