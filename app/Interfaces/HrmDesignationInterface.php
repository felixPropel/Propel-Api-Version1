<?php

namespace App\Interfaces;

interface HrmDesignationInterface
{
    public function findAll();
    public function store($data);
    public function findById($id); 
    public function findByName($name);
    public function destroy($id);
   


   
}
