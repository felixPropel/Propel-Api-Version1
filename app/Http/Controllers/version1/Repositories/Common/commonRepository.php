<?php

namespace App\Http\Controllers\version1\Repositories\common;

use App\Http\Controllers\version1\Interfaces\Common\commonInterface;
use App\Models\BasicModels\Salutation;
use App\Models\BasicModels\BloodGroup;
use App\Models\BasicModels\Gender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class commonRepository implements commonInterface
{
    public function getSalutation(){
    
       $model=Salutation::get();
       log::info('commonrepo > ' .json_encode($model));
        return $model;
    }

    public function getAllGender()
    {
        $model=Gender::get();
        return $model;
    }
    public function getAllBloodGroup(){
        $model=BloodGroup::get();
        return $model;
    }
}