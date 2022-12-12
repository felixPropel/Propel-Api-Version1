<?php

namespace App\Http\Controllers\version1\Interfaces\Person;

interface PersonInterface
{
  
    public function storePerson($personModel,$personDetailModel,$personEmailModel,$personMobileModel);
    public function getPersonPrimaryDataByUid($uid);
}