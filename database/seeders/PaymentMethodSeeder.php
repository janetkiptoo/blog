<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         DB::table('payment_methods')->insert([
            [
                'name' => 'M-Pesa',
                'code' => 'mpesa',
                'requires_reference' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Cash',
                'code' => 'cash',
                'requires_reference' => false,
                'is_active' => true,
            ],
        ]);
        //
    }
}
