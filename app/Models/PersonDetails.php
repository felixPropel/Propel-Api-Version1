<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDetails extends Model
{
    use HasFactory;
    protected $table = 'person_details';

    public function mobile(){
        return $this->hasMany('App\Models\PersonMobile', 'uid', 'uid');
    }

    public function email(){
        return $this->hasMany('App\Models\PersonEmail', 'uid', 'uid');
    }


    public function person(){
        return $this->hasOne('App\Models\Person', 'uid','uid');
    }

    public function person_address(){
        return $this->hasMany('App\Models\PersonAddress', 'uid','uid');
    }

}
