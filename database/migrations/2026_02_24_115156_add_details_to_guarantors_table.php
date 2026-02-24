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
       Schema::disableForeignKeyConstraints();

Schema::table('guarantors', function (Blueprint $table) {
    $table->foreign('loan_application_id')
          ->references('id')
          ->on('loan_applications')
          ->onDelete('cascade');
});

Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guarantors', function (Blueprint $table) {
            //
        });
    }
};
