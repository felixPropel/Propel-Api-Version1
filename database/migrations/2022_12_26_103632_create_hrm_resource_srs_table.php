<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmResourceSrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_resource_srs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id');
            $table->integer('hrm_resource_activity_status_id');
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
        Schema::dropIfExists('hrm_resource_srs');
    }
}
