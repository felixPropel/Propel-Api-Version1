<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmResourceType extends Model
{
    use HasFactory;
    public function __construct()
    {
        parent::__construct();
        $this->connection ='mysql';
        // $this->connection ='mysql_external';
        
    }
    
}
