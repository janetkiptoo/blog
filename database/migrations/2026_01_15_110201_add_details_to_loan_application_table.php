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
            $table->string('name'); 
            $table->string('email');
            $table->string('phone');
            $table->string('national_id');
            $table->string('institution');
            $table->string('course');
            $table->string('year_of_study');
            $table->string('student_reg_no');           
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_application', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('national_id');      
            $table->dropColumn('institution');
            $table->dropColumn('course');
            $table->dropColumn('year_of_study');
            $table->dropColumn('student_reg_no');
            //
        });
    }
};
