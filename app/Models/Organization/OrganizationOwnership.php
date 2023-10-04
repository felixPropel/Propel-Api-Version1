<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationOwnership extends Model
{
    use HasFactory;
    protected $table = 'organization_ownerships';

    // public function ParentOrganization()
    // {
    //     return $this->belongsTo(Organization::class, 'org_id', 'id');
    // }
}
