<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmResourcetypeAffinityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_resource_type_affinity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id');
            $table->integer('resource_type_id');
            $table->date('offered_dated')->nullable();
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
        Schema::dropIfExists('hrm_resource_type_details');
    }
}
