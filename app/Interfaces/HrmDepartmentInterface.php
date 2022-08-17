<?php

namespace App\Interfaces;

interface HrmDepartmentInterface
{
    public function index();
    public function store($data);
    public function findById($id);   
    public function destroy($id);
}
