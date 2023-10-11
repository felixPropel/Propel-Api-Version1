<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationOwnership extends Model
{
    protected $connection;
    
    public function __construct(){
        parent::__construct();
        $this->connection = "mysql_external";
    }
    use HasFactory;
    protected $table = 'organization_ownerships';

    // public function ParentOrganization()
    // {
    //     return $this->belongsTo(Organization::class, 'org_id', 'id');
    // }
}
