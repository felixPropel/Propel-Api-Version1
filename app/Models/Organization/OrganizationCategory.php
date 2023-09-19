<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationCategory extends Model
{
    use HasFactory;
    protected $table = 'pims_org_categories';

    public function ParentOrganization()
    {
        return $this->belongsTo(Organization::class, 'org_id', 'id');
    }
}
