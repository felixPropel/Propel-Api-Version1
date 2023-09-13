<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->integer('pims_org_doc_type_id')->nullable();
            $table->string('doc_no')->nullable();
            $table->integer('doc_validity')->nullable();
            $table->string('doc_attachment')->nullable();
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
        Schema::dropIfExists('organization_documents');
    }
}
