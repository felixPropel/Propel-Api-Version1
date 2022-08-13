<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDetails extends Model
{
    use HasFactory;
    protected $table = 'person_details';

    public function mobile(){
        return $this->hasMany('App\Models\PersonMobile', 'uid', 'uid')->where('status','!=', 0)->orderBy('status');
    }

    public function email(){
        return $this->hasMany('App\Models\PersonEmail', 'uid', 'uid')->where('status','!=', 0)->orderBy('status');
    }


    public function person(){
        return $this->hasOne('App\Models\Person', 'uid','uid');
    }

    public function person_address(){
        return $this->hasMany('App\Models\PersonAddress', 'uid','uid');
    }

    public function person_address_profile(){
        return $this->hasMany('App\Models\PersonAddress', 'uid','uid')->where('address_type','=', 3);
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'uid','uid');
    }

}
