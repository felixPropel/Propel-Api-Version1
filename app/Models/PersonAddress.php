<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{
    use HasFactory;
    protected $table = 'person_addresses';

    public function ParentComAddress()
    {
        return $this->belongsTo(PropertyAddress::class, 'com_property_address_id','id');
    }
    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }

}
