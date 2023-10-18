<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('pims_person_doc_type_id');
            $table->string('doc_no');
            $table->date('doc_validity');
            $table->text('attachment')->nullable();
            $table->integer('doc_cachet_id')->nullable();
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
        Schema::dropIfExists('person_documents');
    }
}
