<?php
namespace App\Models\Organization;
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
}