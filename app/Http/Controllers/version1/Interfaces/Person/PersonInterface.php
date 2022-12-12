<?php

namespace App\Http\Controllers\version1\Interfaces\Person;

interface PersonInterface
{
    public function findUserDataByMobileNumber($data);
    public function findUserDataByEmail($data);
    public function storePerson($personModel,$personDetailModel,$personEmailModel,$personMobileModel);
}