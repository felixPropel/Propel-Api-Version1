<?php

namespace App\Http\Controllers\version1\Repositories\Person;

use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Models\User;

class PersonRepository implements PersonInterface
{
    public function findUserDataByMobileNumber($mobileNumber)
    {      
       return User::where('primary_mobile', $mobileNumber)->first();       
    }

}