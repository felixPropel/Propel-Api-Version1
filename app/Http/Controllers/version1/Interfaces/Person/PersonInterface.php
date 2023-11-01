<?php

namespace App\Http\Controllers\version1\Interfaces\Person;

interface PersonInterface
{
    public function checkPersonByMobileNo($mobileNumber);
    public function storePerson($allModels);
    public function getPersonPrimaryDataByUid($uid);
    public function storeTempPerson($model);
    public function findTempPersonById($id);
    public function checkPersonEmailByUid($email,$uid);
    public function emailOtpValidation($uid);//re
    public function getPersonEmailByUid($uid);//re
    public function getPersonDatasByUid($uid);
    public function savePersonDatas($model);
    public function savePerson($model);
   public function getMobileNumberByUid($uid,$mobile);
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
   public function checkUserByUID($uid);
   public function personAddressByuid($uid);
   public function getPersonByUid($uid);
   public  function personSecondMobileAndEmailByUid($uid);
   public function findEmailByPersonEmail($email);
   public function getAllDatasInUser($uid);
   public function getPersonProfileByUid($uid);
   public function checkPersonByEmail($email);
   public function getPerviousPrimaryMobileNo($uid);
   public function addSecondaryMobileNoForUser($model);
   public function addSecondaryEmailForUser($model);
   public function getSecondaryMobileNoByUid($mobile,$uid);
   public function getSecondaryEmailByUid($email,$uid);
   public function secondaryMobileNoValidationId($id,$mobile);
   public function secondaryEmailValidationId($id,$email);
   public function storeTempEmail($model);
   public function resendOtpForSecondaryEmail($uid,$email,$otp);
   public function removeTempEmailById($id);
   public function addedEmailInPerson($model);
   public function checkSecondaryMobileNumberByUid($mobile,$uid);
   public function checkSecondaryEmailByUid($email,$uid);
   public function checkPerivousAddressById($addressId,$uid);
   public function getPrimaryMobileNumberByUid($uid);
   public function getPrimaryMobileAndEmailbyUid($uid);
   public function getPersonPicAndPersonName($uid);
   public function checkPersonExistence($uid);
   public function setStageInUser($uid);
   public function resendOtpForSecondaryMobileNo($uid,$mobile,$otp);
   public function setPirmaryMobileNo($model);
   public function setPirmaryEmail($model);
   public function getPersonMobileNoByUid($uid,$mobile);
   public function getPerviousPrimaryEmail($uid);
   public function deletedPersonEmailByUid($email,$uid);
   public function getMobileNoByUid($mobile,$uid);
   public function getPersonDataByMobileNo($mobile);
   public function getPersonDataByEmail($email);



}