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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['institution', 'course', 'year_of_study', 'student_reg_no','national_id','image']);
       
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('national_id')->unique();
            $table->string('institution');
            $table->string('course');
            $table->string('year_of_study');
            $table->string('student_reg_no')->unique();
            $table->string('image')->nullable(true);

            //
        });
    }
};
