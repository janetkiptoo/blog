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
        Schema::create('personal_profiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('gender');
    $table->string('nationality');
    $table->string('government_id_type');
    $table->string('government_id_number');
    $table->string('address');
    $table->string('date_of_birth');
    $table->string('id_image');

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
        Schema::dropIfExists('personal_profiles');
    }
};
