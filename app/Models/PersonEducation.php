<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonEducation extends Model
{
    use HasFactory;
    protected $table = 'person_educations';
    
    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }
}
