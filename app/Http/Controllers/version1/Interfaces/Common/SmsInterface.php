<?php

namespace App\Http\Controllers\version1\Interfaces\Common;

interface SmsInterface
{ 
    public function store($model);
    public function findSmsTypeByName($name);
}