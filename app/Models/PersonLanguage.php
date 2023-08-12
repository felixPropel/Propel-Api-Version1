<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonLanguage extends Model
{
    use HasFactory;
    protected $table = 'person_languages';

    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }
    public function PimsLanguage()
    {
        return $this->hasMany(Language::class, 'id', 'language_id');
    }
}
