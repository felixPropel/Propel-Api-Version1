<?php
namespace App\Interfaces;

interface PersonInterface
{
    // public function get_stage($data);
    public function check_for_email($data);
    public function check_for_mobile($data);
    public function getPersonDetailsBasicUid($uid);
    Public function getFullPersonDetailsByUid($uid);
    public function getAllPersonDataWithEmailAndMobile($email,$mobile);
    public function findTempUserDataById($id);
    public function saveTempUser($model);
    public function checkPersonByMobile($mobile);
    public function check_person_exist_by_uid($uid);
    public function savePerson($personModel);
    public function savePersonEmail($personModel);
    public function getAllSaluations();
    public function check_person_exist_by_email($email);
    public function savePersonMobile($personMobileModel);
    public function findTempUserDataByMobile($mobile);
    public function savePersonDetails($personDetailsModel);
    public function getPersonMobileByUid($uid);
    public function getPersonEmailByUid($uid);
    public function saveUser($userModel);
    public function saveHomeAddress($homeAddressModel);
    public function saveOfficeAddress($officeAddressModel);
    public function getCitiesByState($data);
    public function get_gender();
    public function get_blood();
    public function getStates();
}
