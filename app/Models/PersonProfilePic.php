<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonProfilePic extends Model
{
    use HasFactory;
    protected $table = 'person_profile_pics';
    
    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }
}
