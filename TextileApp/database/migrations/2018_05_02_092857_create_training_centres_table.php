<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_centres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('centre_id');
            $table->string('centre_name');
            $table->string('district_id');
            $table->string('upload_pic')->nullable();
            $table->string('street')->nullable(); 
            $table->string('district')->nullable(); 
            $table->string('state')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('landline')->nullable();
            $table->string('website_id')->nullable();
            $table->string('pan_card')->nullable(); 
            $table->string('pan_card_image')->nullable();
            $table->string('gst')->nullable();
            $table->string('gst_image')->nullable();
            $table->string('training_start')->nullable();
            $table->string('training_end')->nullable();
            $table->string('adhar_card')->nullable();
            $table->string('adhar_card_image')->nullable();
            $table->string('centre_type')->nullable();
            $table->string('training')->nullable();
            $table->string('centre_status')->nullable();
            $table->string('academic_year')->nullable();
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
        Schema::dropIfExists('training_centres');
    }
}
