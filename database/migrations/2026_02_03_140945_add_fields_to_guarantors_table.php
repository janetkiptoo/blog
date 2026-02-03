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
        Schema::table('guarantors', function (Blueprint $table) {
             $table->string('physical_address')->after('phone');
             $table->enum('employment_status', ['employed', 'not employed'])->after('physical_address');
             $table->string('image')->nullable()->after('employment_status');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guarantors', function (Blueprint $table) {
            $table->dropColumn(['physical_address', 'employment_status', 'image']);
            //
        });
    }
};
