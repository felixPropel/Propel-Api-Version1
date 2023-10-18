<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('pims_person_salutation_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('birth_place')->nullable();
            $table->integer('pims_person_gender_id')->nullable();
            $table->integer('pims_person_blood_group_id')->nullable();
            $table->integer('pims_person_martial_status_id')->nullable();
            $table->integer('pims_com_country_id')->nullable();
            $table->integer('pfm_survial_id')->nullable();
            $table->date('decesaed_date')->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('person_details');
    }
}
