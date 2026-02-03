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
        Schema::table('mpesa_payments', function (Blueprint $table) {
            $table->decimal('amount', 12, 2)->after('phone');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mpesa_payments', function (Blueprint $table) {
            $table->dropColumn('amount');
            //
        });
    }
};
