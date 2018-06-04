<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('batch_id');
            $table->string('batch_name')->nullable();
             $table->string('training_type')->nullable();
             $table->string('no_of_stud');
             $table->string('district_id');
             $table->string('centre_id');
             $table->string('start_date');
             $table->string('end_date');
             $table->string('status'); 
             $table->string('academic_year');             
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
        Schema::dropIfExists('batches');
    }
}
