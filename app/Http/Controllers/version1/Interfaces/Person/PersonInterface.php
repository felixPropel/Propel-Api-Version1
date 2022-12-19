<?php

namespace App\Http\Controllers\version1\Interfaces\Person;

interface PersonInterface
{
    public function checkPersonByMobile($mobileNumber);
    public function storePerson($personModel,$personDetailModel,$personEmailModel,$personMobileModel);
    public function getPersonPrimaryDataByUid($uid);
    public function storeTempPerson($model);
    public function findTempPersonById($id);
<<<<<<< HEAD
    public function emailOtpValidation($uid);


=======
    public function checkPersonEmailByUid($email,$uid);
    public function getOtpByUid($uid);
>>>>>>> ce051c3b92291820626f9b6b0fbbbc6f1e5846a6
}