<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_professions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid'); 
            $table->integer('org_id');
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->date('doj')->nullable();
            $table->date('dor')->nullable();
            $table->date('expirence')->nullable();
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
        Schema::dropIfExists('person_professions');
    }
}
