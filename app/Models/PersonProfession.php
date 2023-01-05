<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonProfession extends Model
{
    use HasFactory;
    protected $table = 'person_Professions';
    
    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }
}
