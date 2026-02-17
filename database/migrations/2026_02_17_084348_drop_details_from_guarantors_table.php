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
        Schema::table('guarantors', function (Blueprint $table) {
            $table->dropForeign(['loan_application_id']); 
            $table->dropColumn(['loan_application_id']);
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guarantors', function (Blueprint $table) {
            $table->foreignId('loan_application_id')->constrained('loan_application')->cascadeOnDelete();
            //
        });
    }
};
