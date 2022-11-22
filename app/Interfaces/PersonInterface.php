<?php

namespace App\Interfaces;
use Log;
interface PersonInterface
{
    // public function get_stage($data); 
    public function check_for_email($data);
    public function check_for_mobile($data);
    public function getPersonDetailsBasicUid($uid);
    public function getFullPersonDetailsByUid($uid);
    public function GetCompletePersonByUid($uid);
    public function getPersonAddressByUid($uid);
    public function getPersonAddressByUidAndType($uid,$type);
    public function getAllPersonDataWithEmailAndMobile($email, $mobile);
    public function findTempUserDataById($id);
    public function saveTempUser($model);
    public function checkPersonByMobile($mobile);
    public function check_person_exist_by_uid($uid);
    public function savePerson($personModel);
    public function savePersonEmail($personModel);
    public function updatePersonEmail($uid, $primary);
    public function check_person_exist_by_email($email);
    public function savePersonMobile($personMobileModel);
    public function findTempUserDataByMobile($mobile);
    public function savePersonDetails($personDetailsModel);
    public function savePersonAddress($addressModel);
    public function getPersonMobileByUid($uid,$status,$mobile);
    public function updateUserPrimaryMobile($uid,$primary_mobile);
    public function updateUserPrimaryEmail($uid, $email);
    public function getPersonEmailByUid($uid,$status,$email);
    public function saveUser($userModel);
    public function saveHomeAddress($homeAddressModel);
    public function saveOfficeAddress($officeAddressModel);
    public function updateWebLink($uid,$link);
    public function getCitiesByState($data);
    public function makeMobileInactive($uid,$status,$mobile);
    public function makeEmailInactive($uid,$other);
    public function get_gender();
    public function get_blood();
    public function getStates();
    public function getAllSaluations();
    public function getAddressOf();
    public function ProfileDetailByUid($data);
    public function UpdateProfileDetails($data);
    public function saveOtherMobileByUid($data);
    public function saveOtherEmailByUId($data);
    public function PersonAddressDetailsByUid($data);
  public function checkPersonByMobileNo($mobile);
  public function checkPersonByEmail($email,$uid);
    // public function UpdatedAddress($data);
    //writen by dhanaraj
    public function getDetailedAllPersonDataWithMobile($mobile);
    public function getDetailedAllPersonDataWithEmail($email);
    public function checkUserByUID($uid);
    public function getDetailedAllPersonDataWithEmailAndMobile($email, $mobile);
    public function findExactPersonWithEmailAndMobile($email, $mobile);
    public function findUserWithInOrganization($uId,$orgId);
    public function findExactDatasWithMobile($mobile,$email);
}
