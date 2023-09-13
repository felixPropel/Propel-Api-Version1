<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempOrganizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('authorized_person_id')->nullable();
            $table->text('organization_detail')->nullable();
            $table->text('organization_address')->nullable();
            $table->text('organization_doc_type')->nullable();
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
        Schema::dropIfExists('temp_organizations');
    }
}
