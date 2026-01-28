<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loan_repayments', function (Blueprint $table) {
             $table->decimal('interest', 12, 2)->after('amount');
            $table->decimal('principal', 12, 2)->after('interest');

            $table->decimal('balance_before', 12, 2)->after('principal');
            $table->decimal('balance_after', 12, 2)->after('balance_before');

            $table->string('payment_method')->nullable();
            $table->string('reference')->nullable();

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_repayments', function (Blueprint $table) {
             $table->dropColumn([
                'interest',
                'principal',
                'balance_before',
                'balance_after',
                'payment_method',
                'reference'
            ]);
            //
        });
    }
};
