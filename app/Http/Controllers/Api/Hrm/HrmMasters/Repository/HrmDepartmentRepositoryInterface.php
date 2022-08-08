<?php

namespace App\Http\Controllers\Api\Hrm\HrmMasters\Repository;

use App\Http\Controllers\Api\Hrm\HrmMasters\Model\HrmDepartment;

interface HrmDepartmentRepositoryInterface
{
    public function findAll();
    
    public function findById($id);
    public function save(HrmDepartment $model, $id = false);
    public function destroyById(HrmDepartment $model);
}
