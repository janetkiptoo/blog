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
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('government_id_type')->nullable();
            $table->string('government_id_number')->nullable();
            $table->text('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('id_image')->nullable(true);

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            
            //
        });
    }
};
