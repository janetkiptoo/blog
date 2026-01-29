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
        Schema::table('loan_application', function (Blueprint $table) {
            $table->decimal('interest_rate', 5, 2)->after('loan_amount');
            $table->decimal('monthly_payment', 12, 2)->after('interest_rate');
            $table->decimal('balance', 12, 2)->after('monthly_payment');
            $table->decimal('total_paid', 12, 2)->after('balance');
            $table->integer('term_months')->after('total_paid'); // ✅ just integer
            $table->timestamp('approved_at')->nullable()->after('total_paid');
            $table->timestamp('paid_at')->nullable()->after('approved_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_application', function (Blueprint $table) {
            $table->dropColumn([
                'interest_rate',
                'monthly_payment',
                'balance',
                'total_paid',
                'term_months',
                'approved_at',
                'paid_at',
            ]);
        });
    }
};
