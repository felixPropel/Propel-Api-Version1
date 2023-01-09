<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmResourceReliveDetail extends Model
{
    use HasFactory;
    public function __construct()
    {
        parent::__construct();
        $this->connection = 'mysql_external';
    }
   
    public function resource()
    {
        return $this->belongsTo(HrmResource::class, 'resource_id', 'id');
    }
    
}
