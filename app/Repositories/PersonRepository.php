<?php

namespace App\Repositories;


use App\Models\PersonDetails;
use App\Interfaces\PersonInterface;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

//use Your Model
use App\Models\Common;
use App\Models\TempUsers;
use App\Models\User;
use App\Models\City;
use App\Models\Person;
use App\Models\PersonEmail;
use App\Models\PersonAddress;
use App\Models\PersonMobile;
use App\Models\BasicModels\Salutation;
use App\Models\BasicModels\State;
use App\Models\BasicModels\Gender;
use App\Models\BasicModels\BloodGroup;
use App\Models\Address_of;
use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;
use Log;

/**
 * Class PersonRepository.
 */
class PersonRepository implements PersonInterface
{
    protected $person;

    public function __construct(User $user, Person $person, PersonDetails $person_details)
    {
        $this->user = $user;
        $this->person = $person;
        $this->person_details = $person_details;
    }
    public function getAllPersonDataWithEmailAndMobile($email, $mobile)
    {
        $models = $this->person_details::with('mobile', 'email')->get();
        return $models;
    }
    public function findTempUserDataById($id)
    {
        $model = TempUsers::where('uid', $id)->first();
        return $model;
    }

    public function saveTempUser($model)
    {
        $model->save();
        return $model;
    }

    public function saveHomeAddress($homeAddressModel)
    {
        $homeAddressModel->save();
        return $homeAddressModel;
    }

    public function saveOfficeAddress($officeAddressModel)
    {
        $officeAddressModel->save();
        return $officeAddressModel;
    }

    public function check_for_email($request)
    {
        $check_for_email = PersonEmail::where('email', $request['email'])->first();
        return $check_for_email;
    }

    public function findTempUserDataByMobile($mobile)
    {
        $model = TempUsers::where('mobile', $mobile)->first();
        return $model;
    }


    public function check_for_mobile($mobile)
    {
        $check_for_mobile = PersonMobile::where('mobile', $mobile)->first();
        return $check_for_mobile;
    }

    public function getPersonMobileByUid($uid)
    {
        $model = PersonMobile::where('uid', $uid)->first();
        return $model;
    }



    public function getPersonEmailByUid($uid)
    {
        $model = PersonEmail::where('uid', $uid)->first();
        return $model;
    }

    public function check_person_exist_by_uid($uid)
    {
        return Person::where('uid', $uid)->first();
    }

    public function savePerson($personModel)
    {
        $personModel->save();
        return $personModel;
    }

    public function savePersonEmail($personModel)
    {
        $personModel->save();
        return $personModel;
    }


    public function checkPersonByMobile($mobile)
    {
        return PersonMobile::where(['mobile' => $mobile, 'status' => 1])->exists();
    }

    public function getAllSaluations()
    {
        $saluations = Salutation::all();
        return $saluations;
    }

    public function check_person_exist_by_email($email)
    {
        return PersonEmail::where(['email' => $email, 'status' => 1])->exists();
    }

    public function savePersonMobile($personMobileModel)
    {
        $personMobileModel->save();
        return $personMobileModel;
    }

    public function savePersonDetails($personDetailsModel)
    {
        $personDetailsModel->save();
        return $personDetailsModel;
    }


    public function get_gender()
    {
        $gender = Gender::all();
        return $gender;
    }

    public function get_blood()
    {
        $blood = BloodGroup::all();
        return $blood;
    }

    public function getStates()
    {
        $states = State::where('country_id', 101)->get();
        return $states;
    }

    public function getCitiesByState($data)
    {
        $cities = City::where('state_id', $data)->get()->toArray();
        return $cities;
    }

    public function saveUser($userModel)
    {
        $userModel->save();
        return $userModel;
    }

    public function getPersonDetailsBasicUid($uid)
    {
        return PersonDetails::where("uid", $uid)->first();
    }

    public function getFullPersonDetailsByUid($uid)
    {
        $details = PersonDetails::with('email', 'mobile', 'person', 'person_address')->where("uid", $uid)->get();
        return $details;
    }

    public function GetCompletePersonByUid($uid){
        $details=PersonDetails::with('email', 'mobile', 'person', 'user', 'person_address_profile')->where("uid", $uid)->first();
        return $details;
    }

    public function getPersonAddressByUid($uid){
        $address=PersonAddress::where("uid", $uid)->get()->toArray();
        return $address;
    }

    public function getAddressOf(){
        $address_off=Address_of::all();
        return $address_off;
    }

    //writen by dhanaraj
    public function getDetailedAllPersonDataWithMobile($mobile)
    {
        $models = PersonMobile::with('PersonDetail')
            ->where('person_mobile.mobile', $mobile)
            ->whereIn('status', [1, 2])
            ->get()->toArray();
        return $models;
    }

    public function getDetailedAllPersonDataWithEmail($email)
    {
        $models = PersonEmail::with('PersonDetail')
            ->where('email', $email)
            ->whereIn('status', [1, 2])
            ->get()->toArray();
        return $models;
    }
    public function getDetailedAllPersonDataWithEmailAndMobile($email, $mobile)
    {
        $models = Person::select('person.id as personId', 'person_email.email As emailId', 'person_mobile.mobile as mobileId')
            ->leftjoin('person_mobile', 'person_mobile.uid', 'person.uid')
            ->leftjoin('person_email', 'person_email.uid', 'person.uid')            
            ->where('person_mobile.mobile', $mobile)
            ->OrWhere('person_email.email', $email)
            ->whereIn('person_mobile.status', [1, 2])
            ->whereIn('person_email.status', [1, 2])
            ->get();

        return $models;
    }

    public function checkUserByUID($uid)
    {
        return User::where("uid", $uid)->first();
    }

    public function findExactPersonWithEmailAndMobile($email, $mobile)
    {
        // Log::info('PersonRepository>findExactPersonWithEmailAndMobile Function>Inside.');

        // $model =  Person::select('*')
        //     ->leftjoin('person_mobile', 'person_mobile.uid', 'person.uid')
        //     ->leftjoin('person_email', 'person_email.uid', 'person.uid')            
        //     ->where('person_mobile.mobile', $mobile)
        //     ->Where('person_email.email', $email)
        //     ->whereIn('person_mobile.status', [1, 2])
        //     ->whereIn('person_email.status', [1, 2])
        //     ->first();

        // Log::info('PersonRepository>findExactPersonWithEmailAndMobile Function>Return . ' . json_encode($model));
        // return $model;
    }
    public function findUserWithInOrganization($uId, $orgId)
    {
        return UserAccount::where('u_id', $uId)->where('organization_id', $orgId)->first();
    }
}
