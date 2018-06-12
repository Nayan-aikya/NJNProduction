<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('category')->nullable();
            $table->string('relationship')->nullable();
            $table->string('relation_firstname')->nullable();
            $table->string('relation_lastname')->nullable();
            $table->string('current_location')->nullable();
            $table->string('current_street')->nullable();
            $table->string('current_city')->nullable();
            $table->string('current_state')->nullable();
            $table->string('current_district')->nullable();
            $table->string('current_taluk')->nullable();
            $table->string('current_village')->nullable();
            $table->string('current_pincode')->nullable();
            $table->string('permanent_location')->nullable();
            $table->string('permanent_street')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_taluk')->nullable();
            $table->string('permanent_village')->nullable();
            $table->string('permanent_pincode')->nullable();
            $table->string('education')->nullable();
            $table->string('subject')->nullable();
            $table->string('yearofpassing')->nullable();
            $table->string('physically_challenged')->nullable();
            $table->string('skill')->nullable();
            $table->string('apprentiseship')->nullable();
            $table->string('perviously_employed')->nullable();
            $table->string('willing_migrate')->nullable();
            $table->string('expected_salary_outside')->nullable();
            $table->string('expected_salary_within')->nullable();
            $table->string('preferred_training_period')->nullable();
            $table->string('status')->nullable();
            $table->string('candidate_id')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
