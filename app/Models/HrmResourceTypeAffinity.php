<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmResourceTypeAffinity extends Model
{
    use HasFactory;
    protected $connection;
    
    public function __construct(){
        parent::__construct();
        $this->connection = "mysql_external";
    }

    public function ParentHrmResource()
    {
        return $this->belongsTo(HrmResource::class, 'resource_id', 'id');
    }
    public function ParentHrmResourceType()
    {
        return $this->belongsTo(HrmResourceType::class, 'resource_type_id', 'id');
    }
}
