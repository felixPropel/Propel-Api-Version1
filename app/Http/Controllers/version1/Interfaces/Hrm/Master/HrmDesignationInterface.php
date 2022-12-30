<?php

namespace App\Http\Controllers\version1\Interfaces\Hrm\Master;

interface HrmDesignationInterface
{
   
    public function findAll();
    public function store($data);
    public function findById($id);
    public function findByDeptId($id);
   
}
