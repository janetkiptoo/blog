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
        Schema::create('loan_disbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_application_id');
            $table->foreign('loan_application_id')->references('id')->on('loan_application')->onDelete('cascade');
            $table->foreignId('user_id') ->constrained('users') ->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('phone_number');
            $table->string('conversation_id')->nullable();
            $table->string('originator_conversation_id')->nullable();
            $table->string('mpesa_receipt_number')->nullable();
            $table->integer('result_code')->nullable();
            $table->text('result_desc')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'timeout'])->default('pending');
            $table->timestamp('disbursed_at')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_disbursements');
    
    }
};
