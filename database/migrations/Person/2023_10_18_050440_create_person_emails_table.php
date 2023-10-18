<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->string('email');
            $table->integer('email_cachet_id');
            $table->datetime('email_updated_on')->nullable();
            $table->integer('otp_recevied')->nullable();
            $table->integer('email_validation_id')->nullable();
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
        Schema::dropIfExists('person_emails');
    }
}
