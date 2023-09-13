<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmResourceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_resource_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resource_type');
            $table->string('description')->nullable();
            $table->integer('pfm_active_status_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('last_updated_by')->nullable();
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
        Schema::dropIfExists('hrm_resource_types');
    }
}
