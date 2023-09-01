<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    public function __construct()
    {
        parent::__construct();
        $this->connection = 'mysql';
    }
    public function mobile()
    {
        return $this->hasOne('App\Models\PersonMobile', 'uid', 'uid');
    }
    public function email()
    {
        return $this->hasOne('App\Models\PersonEmail', 'uid', 'uid');
    }
    public function personDetails()
    {
        return $this->hasOne(PersonDetails::class,'uid','uid');
    }
    public function personAnniversaryDate()
    {
        return $this->hasOne(personAnniversary::class,'uid','uid');
    }
    public function existUser()
    {
        return $this->hasOne(User::class,'uid','uid');
    }
    public function profilePic()
    {
        return $this->hasOne('App\Models\PersonProfilePic', 'uid','uid');
    }
    public function personAddress()
    {
        return $this->hasOne('App\Models\PersonAddress', 'uid','uid');
    }
    public function personEducation()
    {
        return $this->hasMany('App\Models\PersonEducation', 'uid','uid');
    }
    public function personProfession()
    {
        return $this->hasMany('App\Models\PersonProfession', 'uid','uid');
    }
    public function personLanguage()
    {
        return $this->hasMany('App\Models\PersonLanguage', 'uid','uid');
    }
}
