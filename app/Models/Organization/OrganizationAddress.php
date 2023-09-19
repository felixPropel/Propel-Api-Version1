<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyAddress;

class OrganizationAddress extends Model
{
    use HasFactory;
    public function ParentOrganization()
    {
        return $this->belongsTo(Organization::class, 'org_id', 'id');
    }
    public function ParentComAddress()
    {
        return $this->belongsTo(PropertyAddress::class, 'com_property_address_id','id');
    }
   
}
