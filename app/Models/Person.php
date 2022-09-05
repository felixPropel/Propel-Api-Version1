<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'person';

    public function mobile()
    {
        return $this->hasMany('App\Models\PersonMobile', 'uid', 'uid');
    }
    public function email()
    {
        return $this->hasMany('App\Models\PersonEmail', 'uid', 'uid');
    }
    public function personDetail()
    {
        return $this->hasOne('App\Models\PersonDetails', 'uid', 'uid');
    }
}
