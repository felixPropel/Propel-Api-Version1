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
    public function getOtpByUid($uid);//re
    public function emailOtpValidation($uid);//re
    public function getPersonEmailByUid($uid);//re
    public function getPersonDatasByUid($uid);
    public function savePersonDatas($model);
    public function savePerson($model);
   public function getMobileNumberByUid($uid);
   public function getEmailByUid($uid);
   public function getAnniversaryDate($uid);
   public function saveAnniversaryDate($model);
   public function motherTongueByUid($uid);
   public function updateMotherTongue($model);
   public function saveOtherMobileByUid($model);
   public function saveOtherEmailByUid($model);
   public function saveOtherLanguageByUid($model);
   public function addWebLink($model);
   public function findExactPersonWithEmailAndMobile($email, $mobile);
   public function getDetailedAllPersonDataWithEmailAndMobile($email, $mobile);
}