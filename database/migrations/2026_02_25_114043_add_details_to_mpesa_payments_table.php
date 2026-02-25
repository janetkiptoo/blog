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
    // Drop the old wrong foreign key if it exists
    try {
        Schema::table('mpesa_payments', function (Blueprint $table) {
            $table->dropForeign('mpesa_payments_loan_id_foreign');
        });
    } catch (\Exception $e) {
        // Foreign key didn't exist, continue
    }

    Schema::table('mpesa_payments', function (Blueprint $table) {
        $table->foreign('loan_id')
              ->references('id')
              ->on('loan_applications')
              ->onDelete('cascade');
    });
}

public function down(): void
{
    try {
        Schema::table('mpesa_payments', function (Blueprint $table) {
            $table->dropForeign(['loan_id']);
        });
    } catch (\Exception $e) {
        //
    }
}
};
