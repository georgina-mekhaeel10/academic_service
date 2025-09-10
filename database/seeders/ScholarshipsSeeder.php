<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Scholarships;
class ScholarshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Scholarships::insert([
            [
                'university_ID' => 1, // يمكنك تغيير القيمة حسب علاقة الجامعة
                'name' => 'Oxford Graduate Scholarship',
                'description' => 'A postgraduate scholarship at the University of Oxford covering tuition fees and other expenses.',
                'start_date' => '2025-10-01',
                'end_date' => '2026-06-01',
                'cost' => 25000,
                'type' => 'university',
                'funding_type' => 'Full',
                'funding_amount' => 25000,
                'eligibility_criteria' => 'International students, with an accredited bachelor\'s degree, and proficiency in English.',
                'country' => 'United Kingdom',
                
                'application_url' => 'https://www.ox.ac.uk/admissions/graduate',
            ],
            [
                'university_ID' => 2,
                'name' => 'Stanford Graduate Fellowships',
                'description' => 'Stanford University Graduate Scholarship supports outstanding students in various disciplines.',
                'start_date' => '2025-09-15',
                'end_date' => '2026-06-15',
                'cost' => 50000,
                'type' => 'PhD',
                'funding_type' => 'Partial ',
                'funding_amount' => 50000,
                'eligibility_criteria' => 'Bachelor\'s degree, English proficiency, excellent academic standing.',
                'country' => 'United States',
               
                'application_url' => 'https://www.stanford.edu/admissions',
            ],
            [
                'university_ID' => 3,
                'name' => 'Harvard Kennedy School Scholarships',
                'description' => 'Graduate Scholarship at Harvard University\'s Kennedy School of Public Administration.',
                'start_date' => '2025-08-01',
                'end_date' => '2026-05-01',
                'cost' => 45000,
                'type' => 'Master',
                'funding_type' => 'Full',
                'funding_amount' => 45000,
                'eligibility_criteria' => 'International students, Bachelor\'s degree holder, English language proficiency.',
                'country' => 'United States',
                
                'application_url' => 'https://www.hks.harvard.edu/admissions',
            ],
           /* [
                'university_ID' => 4,
                'name' => 'Toronto International Scholarships',
                'description' => 'منحة دراسات عليا للطلاب الدوليين في جامعة تورنتو.',
                'start_date' => '2025-09-15',
                'end_date' => '2026-06-15',
                'cost' => 30000,
                'type' => 'Master',
                'funding_type' => 'Partial',
                'funding_amount' => 30000,
                'eligibility_criteria' => 'درجة بكالوريوس، من دولة غير كندا، إجادة اللغة الإنجليزية.',
                'country' => 'Canada',
            
                'application_url' => 'https://www.sgs.utoronto.ca/admissions',
            ],*/
        ]);
    }
    }
