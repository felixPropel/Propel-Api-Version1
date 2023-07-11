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
            $table->integer('active_state');
            $table->date('date_of_joining');
            $table->date('break_date')->nullable();
            $table->date('relived_date')->nullable();
            $table->date('rejoin_date')->nullable();
            $table->string('reason')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('hrm_resource_srs');
    }
}
