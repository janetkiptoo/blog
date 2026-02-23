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
       Schema::create('loan_applications', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('loan_product_id')->constrained()->cascadeOnDelete();
    $table->decimal('loan_amount', 12, 2);
    $table->unsignedInteger('term_months');
    $table->decimal('interest_rate', 5, 2);
    $table->decimal('monthly_payment', 12, 2);
    $table->decimal('total_interest', 12, 2);
    $table->decimal('approved_amount', 12, 2)->nullable();
    $table->decimal('balance', 12, 2)->nullable();
    $table->decimal('total_paid', 12, 2)->default(0);
    $table->enum('status', [ 'draft', 'submitted', 'under_review', 'approved','rejected','disbursed','paid'])->default('draft');
    $table->timestamp('submitted_at')->nullable();
    $table->timestamp('approved_at')->nullable();
    $table->timestamp('disbursed_at')->nullable();
    $table->text('rejection_reason')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
