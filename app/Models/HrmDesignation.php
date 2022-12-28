<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDesignation extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->connection ='mysql_external';
    }
    public function hrmDesDept()
    {
        return $this->belongsTo(HrmDesignation::class,'');
    }
}
