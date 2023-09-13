<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_mobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->integer('country_id');
            $table->string('mobile_no');
            $table->integer('mobile_cachet_id')->nullable();
            $table->date('mobile_updated_on')->nullable();
            $table->integer('mobile_validation_id')->nullable();
            $table->date('validation_updated_on')->nullable();
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
        Schema::dropIfExists('organization_mobiles');
    }
}
