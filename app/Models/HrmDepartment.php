<?php

namespace App\Models;

use App\Core\ObservantTrait;
use App\Core\GlobalScope\OrganizationClause;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HrmDepartment extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->connection ='mysql';
    }
    public function hrmParentDept()
    {
        return $this->hasOne(HrmDepartment::class, 'id', 'parent_dept_id');
    }
}
