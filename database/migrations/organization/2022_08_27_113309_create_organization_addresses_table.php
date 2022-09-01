<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->integer('address_type_id')->nullable();
            $table->string('door_no', 50)->nullable();
            $table->string('building_name', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('area', 50)->nullable();
            $table->integer('district_id')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('pincode', 50)->nullable();
            $table->string('landmark', 50)->nullable();
            $table->string('location', 100)->nullable();
            $table->integer('status_id')->nullable();
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
        Schema::dropIfExists('organization_addresses');
    }
}
