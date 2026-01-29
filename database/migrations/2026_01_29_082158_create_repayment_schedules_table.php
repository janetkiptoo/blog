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
           Schema::create('repayment_schedules', function (Blueprint $table) {
             $table->id();
             $table->foreign('loan_application_id')->references('id')->on('loan_application') ->onDelete('cascade');
             $table->integer('month_number');
             $table->decimal('opening_balance', 12, 2);
             $table->decimal('interest', 12, 2);
             $table->decimal('principal', 12, 2);
             $table->decimal('total_payment', 12, 2);
             $table->decimal('closing_balance', 12, 2);
             $table->date('due_date');
             $table->boolean('is_grace_period')->default(false);
             $table->boolean('is_paid')->default(false);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repayment_schedules');

    }
};
