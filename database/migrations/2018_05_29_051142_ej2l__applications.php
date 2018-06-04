<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ej2lApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	        Schema::create('ej2l_Applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_district',255);
            $table->string('name',255);
            $table->string('resi_houseno',255);
            $table->string('resi_wardno',255);
            $table->string('resi_crossno',255);
            $table->string('resi_village',255);
            $table->string('resi_taluk',255);
            $table->string('resi_district',255);
            $table->string('resi_pin',255);
            $table->string('dob',255);
            $table->string('age',255);
            $table->string('aadhaar',255);
            $table->string('email',255);
            $table->string('resi_mobile',255);
            $table->string('resi_phone', 255)->nullable();
            $table->string('fwh_name',255);
            $table->string('gender',255);
            $table->string('e2l',255)->nullable();;
            $table->string('ejs',255)->nullable();;
            $table->string('kms',255)->nullable();;
            $table->string('sap',255)->nullable();;
            $table->string('cis',255)->nullable();;
            $table->string('castecategory',255);
            $table->string('rr_number',255);
            $table->text('plan_uadd');
            $table->string('space_sqft',255);
            $table->string('income',255);
            $table->string('msme_number',255);
            $table->string('bankpref',255);
            $table->string('bank_branch',255);
            $table->string('actype',255);
            $table->string('bank_acno',255);
            $table->string('bank_ifsc',255);
            $table->string('exp_loan',255);
            $table->string('app_place',255);
            $table->string("photo",255)->nullable();
            $table->string("cast_cert",255)->nullable();
            $table->string("training_cert",255)->nullable();
            $table->enum('status', ['applied', 'approved','rejected'])->default('applied');
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
        //
    }
}
