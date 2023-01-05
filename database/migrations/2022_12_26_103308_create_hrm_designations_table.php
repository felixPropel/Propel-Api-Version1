<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_designations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('designation_name');
            $table->integer('no_of_posting')->nullable();
            $table->integer('dept_id');
            $table->string('description')->nullable();
            $table->integer('active_state');
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
        Schema::dropIfExists('hrm_designations');
    }
}
