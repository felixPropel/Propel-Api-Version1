<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAddress extends Model
{
    use HasFactory;
    protected $table = 'com_property_addresses';

    public function ParentAddress()
    {
        return $this->belongsTo(PersonAddress::class, 'com_property_address_id', 'id');
    }

}
