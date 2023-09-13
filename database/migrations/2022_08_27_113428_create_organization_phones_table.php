<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->integer('coutry_code')->nullable();
            $table->integer('std_code')->nullable();
            $table->integer('phone_no');
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
        Schema::dropIfExists('organization_phones');
    }
}
