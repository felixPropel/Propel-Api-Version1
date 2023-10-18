<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePimsComCountryTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pims_com_country_time', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->string('time_zone');
            $table->string('gmt_difference')->nullable();
            $table->string('is_daylight')->nullable();
            $table->string('daylight')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('description')->nullable();
            $table->integer('pfm_active_status_id')->nullable();
            $table->integer('deleted_flag')->nullable();
            $table->string('created_by')->nullable();
            $table->string('last_updated_by')->nullable();
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
        Schema::dropIfExists('pims_com_country_time');
    }
}
