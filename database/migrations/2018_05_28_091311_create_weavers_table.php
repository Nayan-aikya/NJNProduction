<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeaversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weavers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('resi_houseno',255);
            $table->string('resi_wardno',255);
            $table->string('resi_crossno',255);
            $table->string('resi_village', 255);
            $table->string('resi_taluk', 255);
            $table->string('resi_district', 255);
            $table->string('resi_pin', 255);
            $table->string('resi_phone', 255);
            $table->string('resi_mobile', 255);
            $table->string('unit_houseno',255);
            $table->string('unit_wardno',255);
            $table->string('unit_crossno',255);
            $table->string('unit_village', 255);
            $table->string('unit_taluk', 255);
            $table->string('unit_district', 255);
            $table->string('unit_pin', 255);
            $table->string('unit_phone', 255);
            $table->string('unit_mobile', 255);
            $table->string('unit_meter', 255);
            $table->string('subcast', 255);
            $table->string('cast_category', 255);
            $table->string('education', 255);
            $table->string('reg_number', 255);
            $table->string('reg_date', 255);
            $table->string('ownership_type', 255);
            $table->string('power_alloted', 255);
            $table->string('power_consumed', 255);
            $table->string('rr_number', 255);
            $table->string('mc_details_A', 255);
            $table->string('mc_details_B', 255);
            $table->string('mc_details_C', 255);
            $table->string('mc_details_D', 255);
            $table->string('app_date', 255);
            $table->string('app_place', 255);
            $table->enum('status', ['applied', 'approved','rejected'])->default('applied');
            $table->string("photograph",255)->nullable();
            $table->string("certificate",255)->nullable();
            $table->string("annexurea",255)->nullable();
            $table->string("annexureb",255)->nullable();
            $table->string("annexurec",255)->nullable();
            $table->string("annexured",255)->nullable();
            $table->string("app_district",255);
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
        Schema::dropIfExists('weavers');
    }
}
