<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uid');
                $table->integer('pfm_stage_id')->nullable();
                $table->integer('pfm_origin_id')->nullable();
                $table->integer('pfm_existence_id')->nullable();
                $table->string('reason')->nullable();
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
        Schema::dropIfExists('persons');
    }
}
