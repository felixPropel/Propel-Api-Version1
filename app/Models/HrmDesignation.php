<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDesignation extends Model
{
    protected $connection;
    
    public function __construct(){
        parent::__construct();
        $this->connection = "mysql_external";
    }
    public function department()
    {
        return $this->hasOne(HrmDepartment::class,'id','dept_id');
    }
    public function ParentHrmDesignation()
    {
        return $this->hasOne(HrmResourceDesignation::class,'designation_id','id');
    }
}
