<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Mary',
            'email' => 'mary@gmail.com',
            
            'national_id' => '.',
            'phone' => '07111111',
            'institution' => '.',
            'course' => '.',
            'year_of_study' =>'.',
            'student_reg_no' => '.',
            'password' => Hash::make('marythomas'),
            'role'=>'admin'
        ]);

          DB::table('users')->insert([
            'name' => 'janet kiptoo',
            'email' => 'kjanet506@gmail.com',
            'national_id' => '41452151',
            'phone' => '0799671838',
            'institution' => 'kabarak',
            'course' => 'cs',
            'year_of_study' =>'4',
            'student_reg_no' => 'CS/MG/1801/09/22',
            'password' => Hash::make('janet2004'),
            'role'=>'student',
             ]);

    }
}
