<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchEmploymentExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_employment_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('batch_id');
            $table->string('centre_id')->nullable();
             $table->string('batch_type')->nullable();
             $table->string('expense')->nullable();
             $table->string('academic_year')->nullable();
             $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_employment_expenses');
    }
}
