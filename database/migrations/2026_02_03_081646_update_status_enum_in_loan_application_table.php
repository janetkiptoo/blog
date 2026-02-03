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
         $table->enum('status', ['pending','approved','disbursed','rejected','paid'])->default('pending')->change();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_application', function (Blueprint $table) {
            //
        });
    }
};
