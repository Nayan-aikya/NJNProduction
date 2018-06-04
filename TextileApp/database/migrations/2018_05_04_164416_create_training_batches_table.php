<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_batches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('centre_id');
            $table->string('batch_id');
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->string('batch_type')->nullable();
            $table->string('batch_name')->nullable();
            $table->string('batch_academic_year')->nullable();
            $table->timestamps();
            $table->string('action')->nullable();
            $table->string('stipend')->nullable();
            $table->string('raw_material')->nullable();
            $table->string('inst_exp')->nullable();
            $table->string('total_expense')->nullable();
            $table->string('employment_expense_status')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_batches');
    }
}
