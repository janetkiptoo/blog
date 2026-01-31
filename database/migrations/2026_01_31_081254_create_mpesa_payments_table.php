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
        Schema::create('mpesa_payments', function (Blueprint $table) {
      $table->id();
     $table->foreignId('payment_id') ->constrained('payments') ->cascadeOnDelete();

        $table->string('phone');
    $table->string('checkout_request_id')->unique();
    $table->string('merchant_request_id');
    $table->string('mpesa_receipt_number')->nullable()->unique();
    $table->string('result_code')->nullable();
    $table->string('result_desc')->nullable();
    $table->string('status'); 

    $table->timestamp('paid_at')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpesa_payments');
    }
};
