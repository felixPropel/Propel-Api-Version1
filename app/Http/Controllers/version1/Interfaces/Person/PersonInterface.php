<?php

namespace App\Http\Controllers\version1\Interfaces\Person;

interface PersonInterface
{
    public function checkPersonByMobile($mobileNumber);
    public function storePerson($personModel,$personDetailModel,$personEmailModel,$personMobileModel);
    public function getPersonPrimaryDataByUid($uid);
    public function storeTempPerson($model);
    public function findTempPersonById($id);
    public function checkPersonEmailByUid($email,$uid);
    public function getOtpByUid($uid);
    public function emailOtpValidation($uid);
}