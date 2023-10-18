<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_educations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('uid');
                $table->integer('pims_person_qualification_id');
                $table->integer('pims_person_doc_type_id')->nullable();
                $table->integer('intuition_org_id')->nullable();
                $table->integer('university_org_id')->nullable();
                $table->string('year_of_pass')->nullable();
                $table->integer('mark')->nullable();
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
        Schema::dropIfExists('person_educations');
    }
}
