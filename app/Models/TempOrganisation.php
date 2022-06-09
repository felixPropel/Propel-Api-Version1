<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempOrganisation extends Model
{
    use HasFactory;
    protected $table = 'temp_organisation';

    public function temp_mobile(){
        return $this->hasMany('App\Models\TempOrganisationPhone', 'oid', 'id')->where('status','=', 1)->orderBy('status');
    }

    public function temp_email(){
        return $this->hasMany('App\Models\TempOrganisationEmail', 'oid', 'id')->where('status','=', 1)->orderBy('status');
    }


    public function temp_details(){
        return $this->hasOne('App\Models\TempOrganisation_details', 'oid','id');
    }

    public function temp_address(){
        return $this->hasMany('App\Models\TempOrganisation_address', 'oid','id');
    }

    public function temp_identities(){
        return $this->hasMany('App\Models\TempOrganisationIdentities', 'oid','id')->where('status','=', 1);
    }

    public function temp_web(){
        return $this->hasOne('App\Models\TempOrganisationWebaddress', 'oid','id');
    }
}
