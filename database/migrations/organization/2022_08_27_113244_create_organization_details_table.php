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
            $table->string('org_name', 250);
            $table->string('org_alias', 250)->nullable();
            $table->date('started_date')->nullable();
            $table->year('year_of_yestablishment')->nullable();
            $table->string('is_registered_org')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('date_of_reg')->nullable();
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
        Schema::dropIfExists('organization_details');
    }
}
