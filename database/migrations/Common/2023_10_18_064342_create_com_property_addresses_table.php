<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComPropertyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_property_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pims_com_address_type_id');
            $table->string('address')->nullable();
            $table->string('door_no')->nullable();
            $table->string('building_name')->nullable();
            $table->integer('pincode')->nullable();
            $table->integer('pims_com_area_id')->nullable();
            $table->string('street')->nullable();
            $table->string('land_mark')->nullable();
            $table->integer('pims_com_district_id')->nullable();
            $table->integer('pims_com_city_id')->nullable();
            $table->integer('pims_com_state_id')->nullable();
            $table->integer('pims_com_country_id')->nullable();
            $table->string('location')->nullable();
            $table->text('google_link')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('pfm_active_status_id')->nullable();
            $table->integer('deleted_flag')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('com_property_addresses');
    }
}
