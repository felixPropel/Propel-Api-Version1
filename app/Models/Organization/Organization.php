<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'organizations';
    public function OrganizationDetail()
    {
        return $this->hasOne(OrganizationDetail::class, 'org_id', 'id');
    }
  
}
