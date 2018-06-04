<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('academic_year')->nullable();
            $table->string('centre_id')->nullable();
            $table->string('batch_id')->nullable();
            $table->string('batch_type')->nullable();
            $table->string('candidate_id')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('employed_industry')->nullable();
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
        Schema::dropIfExists('batch_candidates');
    }
}
