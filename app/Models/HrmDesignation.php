<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDesignation extends Model
{
    use HasFactory;
    public function hrmDesDept()
    {
        return $this->belongsTo(HrmDepartment::class,'dept_id');
    }
}
