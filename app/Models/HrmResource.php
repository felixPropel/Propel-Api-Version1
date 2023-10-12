<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmResource extends Model
{
    use HasFactory;
    protected $connection;
    
    public function __construct(){
        parent::__construct();
        $this->connection = "mysql_external";
    }
    public function Person()
    {
        return $this->hasOne(Person::class, 'uid', 'uid');
    }
    public function resourceDesignation()
    {
        return $this->hasOne(HrmResourceDesignation::class, 'resource_id', 'id');
    }
    public function resourceType()
    {
        return $this->hasOne(HrmResourceTypeAffinity::class, 'resource_id', 'id');
    }
    public function resourceSr()
    {
        return $this->hasOne(HrmResourceSr::class, 'resource_id', 'id');
    }

}
