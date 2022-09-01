<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationIndentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_indentities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->integer('doc_type')->nullable();
            $table->integer('doc_no')->nullable();
            $table->integer('doc_validity')->nullable();
            $table->string('doc_attachment')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('organization_indentities');
    }
}
