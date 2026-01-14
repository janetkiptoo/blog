<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LoanProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample loan products
        DB::table('loan_products')->insert([
            'product_name' => 'Personal Loan',
            'description' => 'A loan for personal use.',
            'min_loan_amount' => 1000,
            'max_loan_amount' => 50000,
            'interest_rate' => 8.5,
            'loan_term_months' => 36
        ]);

        DB::table('loan_products')->insert([
            'product_name' => 'fees Loan',
            'description' => 'A loan for purchasing a home.',
            'min_loan_amount' => 10000,
            'max_loan_amount' => 500000,
            'interest_rate' => 6.5,
            'loan_term_months' => 240
        ]);
    }
}