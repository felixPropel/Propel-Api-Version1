<?php

namespace App\Interfaces;

interface HrmDepartmentInterface
{
    public function findAll();
    public function store($data);
    public function findById($id);   
    public function getParentDeptExceptThisId($id);
    public function destroy($id);
}
