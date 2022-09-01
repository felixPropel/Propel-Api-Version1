<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('org_name',50);
            $table->string('email',50);
            $table->string('door_no',50)->nullable();
            $table->string('building_name',50)->nullable();
            $table->string('street',50)->nullable();
            $table->string('landmark',50)->nullable();
            $table->integer('pincode');
            $table->integer('district_id')->nullable();
            $table->string('area',50)->nullable();
            $table->string('location',50)->nullable();
            $table->integer('authority_status')->default(0);
            $table->integer('tried_person_id');
            $table->integer('gst_available_status')->default(0);
            $table->integer('gst_no')->nullable();
            $table->integer('pan_no')->nullable();
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
        Schema::dropIfExists('temp_organizations');
    }
}
