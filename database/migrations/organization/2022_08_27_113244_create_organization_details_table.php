<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->integer('title_id')->nullable();
            $table->string('org_name', 50);
            $table->string('alias', 50)->nullable();
            $table->date('started_date')->nullable();
            $table->year('year_of_yestablishment')->nullable();
            $table->integer('org_category_id')->nullable();
            $table->integer('org_ownership_id')->nullable();
            $table->integer('org_register_status')->nullable();
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
        Schema::dropIfExists('organization_details');
    }
}
