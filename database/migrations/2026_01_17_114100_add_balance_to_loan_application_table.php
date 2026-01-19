<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('loan_application', function (Blueprint $table) {
        $table->decimal('balance', 10, 2)->nullable()->after('loan_amount');
    });
}

public function down()
{
    Schema::table('loan_application', function (Blueprint $table) {
        $table->dropColumn('balance');
    });
}

};
