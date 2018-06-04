<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicalTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district_id');
            $table->string('financial_year')->nullable();
            $table->string('centre_id');
            $table->string('batch_id');
            $table->string('general_male_target')->nullable();
            $table->string('general_female_target')->nullable();
            $table->string('general_total_target')->nullable();
            $table->string('tsp_male_target')->nullable();
            $table->string('tsp_female_target')->nullable();
            $table->string('tsp_total_target')->nullable();
            $table->string('scp_male_target')->nullable();
            $table->string('scp_female_target')->nullable();
            $table->string('scp_total_target')->nullable();
            $table->string('min_male_target')->nullable();
            $table->string('min_female_target')->nullable();
            $table->string('min_total_target')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
            $table->string('status_updated_date')->nullable();
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
        Schema::dropIfExists('physical_targets');
    }
}
