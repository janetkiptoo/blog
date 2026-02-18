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
    Schema::create('academic_profiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('institution_name');
    $table->string('institution_type');
    $table->string('course_name');
    $table->string('level');
    $table->string('student_document');
    $table->string('student_registration_number');

    $table->enum('status', ['pending', 'approved', 'rejected'])
          ->default('pending');
    $table->text('rejection_reason')->nullable();
    $table->timestamp('reviewed_at')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_profiles');
    }
};
