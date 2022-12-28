<?php

namespace App\Http\Controllers\version1\Interfaces\Hrm\Master;

interface HrmHumanResourceTypeInterface
{
    public function index();
    public function store($data);
    public function findById($id); 
    public function destroy($id);


   
}
