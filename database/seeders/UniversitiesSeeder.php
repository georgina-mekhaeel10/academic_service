<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\University;
class UniversitiesSeeder extends Seeder
{
    public function run()
{
    University::insert([
        [
            'name' => 'University of Oxford',           // اسم الجامعة
            'description' => 'A prestigious university located in Oxford, UK.',  // وصف الجامعة
            'location' => 'Oxford, United Kingdom',     // الموقع الجغرافي للجامعة
            'established_year' => 1167,                 // سنة التأسيس
            'website' => 'https://www.ox.ac.uk',        // الموقع الإلكتروني
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Stanford University',
            'description' => 'A private research university located in Stanford, California, USA.',
            'location' => 'Stanford, United States',
            'established_year' => 1885,
            'website' => 'https://www.stanford.edu',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Harvard University',
            'description' => 'An Ivy League research university located in Cambridge, Massachusetts, USA.',
            'location' => 'Cambridge, United States',
            'established_year' => 1636,
            'website' => 'https://www.harvard.edu',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    


            /*
            [
                'name' => 'University of Cambridge',
                'location' => 'United Kingdom',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'University of Toronto',
                'location' => 'Canada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Columbia University',
                'location' => 'United States',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'University of California, Berkeley',
                'location' => 'United States',
                'created_at' => now(),
                'updated_at' => now(),
            ],*/
        ]);
    }
}
