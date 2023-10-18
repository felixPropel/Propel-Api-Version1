<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('pims_com_language_id');
            $table->string('is_mother_tongue')->nullable();
            $table->string('spoken')->nullable();
            $table->string('read')->nullable();
            $table->string('write')->nullable();
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
        Schema::dropIfExists('person_languages');
    }
}
