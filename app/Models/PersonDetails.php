<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDetails extends Model
{
    use HasFactory;
    protected $table = 'person_details';

    public function mobile()
    {
        return $this->hasMany('App\Models\PersonMobile', 'uid', 'uid')->where('pfm_active_status_id', '!=', 0)->orderBy('pfm_active_status_id');
    }

    public function email()
    {
        return $this->hasMany('App\Models\PersonEmail', 'uid', 'uid')->where('pfm_active_status_id', '!=', 0)->orderBy('pfm_active_status_id');
    }


    public function person()
    {
        return $this->hasOne('App\Models\Person', 'uid', 'uid');
    }

    public function person_address()
    {
        return $this->hasMany('App\Models\PersonAddress', 'uid', 'uid');
    }

    public function person_address_profile()
    {
        return $this->hasMany('App\Models\PersonAddress', 'uid', 'uid')->where('pfm_active_status_id', '=', 1);
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'uid', 'uid');
    }
    //written by dhanaraj
    public function getMobile()
    {
        return $this->hasMany('App\Models\PersonMobile', 'uid', 'uid');
    }

    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }
    public function PersonPic()
    {
        return $this->hasOne(PersonProfilePic::class, 'uid', 'uid');
    }
    public function gender()
    {
        return $this->hasOne('App\Models\BasicModels\Gender', 'id','pims_person_gender_id');
    }
    public function bloodGroup()
    {
        return $this->hasOne('App\Models\BasicModels\BloodGroup', 'id','pims_person_blood_group_id');
    }
}
