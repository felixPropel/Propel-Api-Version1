<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_mobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('country_id')->nullable();
            $table->string('mobile_no');
            $table->integer('mobile_cachet_id');
            $table->datetime('mobileno_updated_on')->nullable();
            $table->integer('otp_recevied')->nullable();
            $table->integer('mobile_validation_id')->nullable();
            $table->datetime('validation_updated_on')->nullable();
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
        Schema::dropIfExists('person_mobiles');
    }
}
