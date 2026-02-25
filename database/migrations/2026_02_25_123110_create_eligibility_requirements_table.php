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
    Schema::create('eligibility_requirements', function (Blueprint $table) {
        $table->id();
        $table->string('country');
        $table->string('institution');
        $table->string('course_type'); 
        $table->string('loan_purpose'); 
        $table->integer('min_age')->default(15);
        $table->integer('max_age')->default(35);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eligibility_requirements');
    }
};
