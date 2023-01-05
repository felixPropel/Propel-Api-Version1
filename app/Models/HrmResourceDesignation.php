<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmResourceDesignation extends Model
{
    use HasFactory;
    public function __construct()
    {
        parent::__construct();
        $this->connection ='mysql_external';
        
    }
    public function ParentHrmResource()
    {
        return $this->belongsTo(HrmResource::class, 'resource_id', 'id');
    }
    public function ParentHrmDesignation()
    {
        return $this->belongsTo(HrmDesignation::class, 'designation_id', 'id');
    }
    
    
}
