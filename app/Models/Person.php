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
        return $this->hasMany('App\Models\PersonMobile', 'uid', 'uid');
    }
    public function email()
    {
        return $this->hasMany('App\Models\PersonEmail', 'uid', 'uid');
    }
    public function personDetails()
    {
        return $this->hasOne(PersonDetails::class,'uid','uid');
    }
    
}
