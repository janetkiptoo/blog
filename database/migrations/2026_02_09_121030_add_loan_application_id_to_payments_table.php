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
        Schema::table('payments', function (Blueprint $table) {
              
              $table->unsignedBigInteger('loan_application_id')->nullable();
              $table->foreign('loan_application_id')->references('id')->on('loan_application')->onDelete('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
                $table->dropForeign(['loan_application_id']);
                $table->dropColumn('loan_application_id');
                //  
        });
    }
};
