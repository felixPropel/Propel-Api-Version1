<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmResourceSrAffinity extends Model
{
    use HasFactory;
    protected $connection;
    
    public function __construct(){
        parent::__construct();
        $this->connection = "mysql_external";
    }
    public function ParentHrmResourceService()
    {
        return $this->belongsTo(HrmResourceSr::class, 'resource_sr_id', 'id');
    }
}
