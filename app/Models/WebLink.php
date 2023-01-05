<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebLink extends Model
{
    use HasFactory;
    protected $table = 'person_web_addresses'; 

    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }

}
