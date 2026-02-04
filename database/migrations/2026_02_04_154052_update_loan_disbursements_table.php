<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loan_disbursements', function (Blueprint $table) {
            $table->integer('result_type')->nullable()->after('status');
            $table->string('transaction_id')->nullable()->after('result_type');
            $table->dropColumn('mpesa_receipt_number');
        });
    }

    public function down(): void
    {
        Schema::table('loan_disbursements', function (Blueprint $table) {
            $table->string('mpesa_receipt_number')->nullable()->after('originator_conversation_id');
            $table->dropColumn(['result_type', 'transaction_id']);
        });
    }
};
