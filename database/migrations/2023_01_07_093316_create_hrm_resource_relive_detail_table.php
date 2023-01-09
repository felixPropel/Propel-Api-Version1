<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmResourceReliveDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_hrm_resource_relive_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id');
            $table->integer('relive_type_id');          
            $table->date('relive_date');
            $table->string('reason');
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
        Schema::dropIfExists('create_hrm_resource_relive_details');
    }
}
