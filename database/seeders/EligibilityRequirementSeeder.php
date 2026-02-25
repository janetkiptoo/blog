<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EligibilityRequirement;

class EligibilityRequirementSeeder extends Seeder
{
    public function run(): void
    {
        
        $institutions = [
            ['name' => 'University of Nairobi', 'type' => 'University'],
            ['name' => 'Moi University',         'type' => 'University'],
            ['name' => 'Kabarak',                'type' => 'University'],
            ['name' => 'BD Computing',           'type' => 'College'],
        ];

        $courseTypes  = ['Undergraduate', 'Postgraduate', 'Vocational'];
        $loanPurposes = ['Fees Loan', 'Personal Loan'];

        foreach ($institutions as $institution) {
            foreach ($courseTypes as $course) {
                foreach ($loanPurposes as $purpose) {
                    EligibilityRequirement::create([
                        'country'          => 'Kenya',
                        'institution'      => $institution['name'],
                        'institution_type' => $institution['type'],
                        'course_type'      => $course,
                        'loan_purpose'     => $purpose,
                        'min_age'          => 15,
                        'max_age'          => 35,
                        'is_active'        => true,
                    ]);
                }
            }
        }
    }
}