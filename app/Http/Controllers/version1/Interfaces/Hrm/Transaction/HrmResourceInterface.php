<?php

namespace App\Http\Controllers\version1\Interfaces\Hrm\Transaction;

interface HrmResourceInterface
{

    public function findResourceByUid($uid);
    
    public function findAll();
    public function store($data);
    public function findById($id);
    public function getParentDeptExceptThisId($id);
    public function saveResourceModel($data);
    public function saveResource($allModels);
}
