<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ASupports;
use Illuminate\Database\Seeder;

use App\Models\Support;


class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
        //
        public function run()
        {
            ASupports::create([
                'name' => 'Support User',
                'email' => 'support@example.com',
                'password' => bcrypt('1'), // تشفير كلمة المرور
            ]);
        }
    
}
