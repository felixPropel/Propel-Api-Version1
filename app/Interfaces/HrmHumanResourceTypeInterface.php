<?php

namespace App\Interfaces;

interface HrmHumanResourceTypeInterface
{
    public function index();
    public function store($data);
    public function findById($id); 
    public function destroy($id);


   
}
