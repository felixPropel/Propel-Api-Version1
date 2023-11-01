<?php
namespace App\Models\Organization;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserOrganizationRelational extends Model
{
    use HasFactory;
    public function ParentOrganization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    public function getAllOrganization()
    {
        return $this->hasMany(Organization::class, 'id', 'organization_id');
    }
    public function ParentPerson()
    {
        return $this->belongsTo(Person::class, 'uid', 'uid');
    }
    public function organizationDetail()
    {
        return $this->hasOne(OrganizationDetail::class, 'org_id', 'organization_id');
    }
}