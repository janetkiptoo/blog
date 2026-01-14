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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('national_id');
            $table->string('email');
            $table->string('phone');
            $table->string('institution');   
            $table->string('course');
            $table->string('year_of_study');
            $table->string('student_reg_no');
             $table->string('loan_amount'); 
            $table->string('loan_purpose');
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
