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
            $table->string('national_id');
            $table->string('phone');
            $table->string('institution');
            $table->string('course');
            $table->string('year_of_study');
            $table->string('student_id');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('national_id');
            $table->dropColumn('phone');
            $table->dropColumn('institution');
            $table->dropColumn('course');       
            $table->dropColumn('year_of_study');
            $table->dropColumn('student_id');   
            //
        });
    }
};
