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
use Illuminate\Support\Facades\Log;

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
public function checkPersonByMobileNo($mobile)
{
    $mobile=PersonMobile::where('mobile', $mobile)->pluck('uid')->first();
  
    if($mobile){
        return $mobile;
    }
    else{
        return 0;
    }
    
}
public function checkPersonByEmail($email ,$uid)
{
    $email=PersonEmail::where(['uid'=>$uid ,'email'=>$email])->pluck('email')->first();
    if($email){
        return $email;      
    }
    else{
        return 0; 
    }
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

    public function getPersonMobileByUid($uid, $status, $mobile)
    {

        $query = PersonMobile::query();

        $query->when(request('uid', false), function ($q, $uid) {
            return $q->where('uid', $uid);
        });

        $query->when(request('status', false), function ($q, $status) {
            return $q->where('status', $status);
        });

        $query->when(request('mobile', false), function ($q, $mobile) {
            return $q->where('mobile', $mobile);
        });

        $model = $query->first();
        return $model;
    }



    public function getPersonEmailByUid($uid, $status, $email)
    {
        $query = PersonEmail::query();

        $query->when(request('uid', false), function ($q, $uid) {
            return $q->where('uid', $uid);
        });

        $query->when(request('status', false), function ($q, $status) {
            return $q->where('status', $status);
        });

        $query->when(request('email', false), function ($q, $email) {
            return $q->where('email', $email);
        });

        $model = $query->first();
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

    public function GetCompletePersonByUid($uid)
    {
        $details = PersonDetails::with('email', 'mobile', 'person', 'user', 'person_address_profile')->where("uid", $uid)->first();
        return $details;
    }

    public function getPersonAddressByUid($uid)
    {
        $address = PersonAddress::where("uid", $uid)->get()->toArray();
        return $address;
    }
    public function ProfileDetailByUid($uid)
    {
   
$profile=PersonDetails::where('uid', $uid)->first();
return $profile;
    }
    public function PersonAddressDetailsByUid($uid)
    {
        $person=PersonAddress::where('uid', $uid)->get();
        return $person;
    }
    public function UpdatedAddress($datas){
        log::info('PersonRepo->   wating '  .json_encode( $data));
       $datas->save();
       return $datas;
    }
public function UpdateProfileDetails($data){
    log::info('PersonRepo-> before  saved '  .json_encode( $data));
    $data->save();
    return $data;
    log::info('PersonRepo-> after saved '  .json_encode( $data));

}
    public function getPersonAddressByUidAndType($uid, $type)
    {
        $address = PersonAddress::where(['uid' => $uid, 'address_type' => $type, 'status' => 1])->first();
        return $address;
    }

    public function getAddressOf()
    {
        $address_off = Address_of::all();
        return $address_off;
    }

    public function savePersonAddress($addressModel)
    {
        $addressModel->save();
        return $addressModel;
    }
public function saveOtherMobileByUid($data){
    if(isset($data)){
    $data->save();
    return $data;
    }  
}
public function saveOtherEmailByUid($data){
    if(isset($email)){
    $data->save();
    return $data;
    }
}
    public function updateWebLink($uid, $link)
    {
        $affectedRows1 = PersonDetails::where("uid", $uid)->update([
            "web_link" => $link,
        ]);
        return $affectedRows1;
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

    public function updateUserPrimaryMobile($uid, $primary_mobile)
    {
        return User::where("uid", $uid)->update(["primary_mobile" => $primary_mobile]);
    }

    public function updateUserPrimaryEmail($uid, $email)
    {
        return User::where("uid", $uid)->update(["primary_email" => $email, "email_otp_verified" => 1]);
    }

    public function updatePersonEmail($uid, $primary)
    {
        return PersonEmail::where("uid", $uid)->update(["email" => $primary]);
    }

    public function makeMobileInactive($uid,$status,$mobile){
       return PersonMobile::where(["uid" => $uid, "status" => $status, "mobile" => $mobile])->update(["status" => 0]);
    }

    public function makeEmailInactive($uid,$other){
        return PersonEmail::where(["uid" => $uid, "email" => $other])->update(["status" => 0]);
    }

    public function findExactPersonWithEmailAndMobile($email, $mobile)
    {
        Log::info('PersonRepository>findExactPersonWithEmailAndMobile Function>Inside.');

        $model =  Person::select('*')
            ->leftjoin('person_mobiles', 'person_mobiles.uid', 'persons.uid')
            ->leftjoin('person_emails', 'person_emails.uid', 'persons.uid')            
            ->where('person_mobiles.mobile_no', $mobile)
            ->Where('person_emails.email', $email)
            ->whereIn('person_mobiles.mobile_cachet', [1, 2])
            ->whereIn('person_emails.email_cachet', [1, 2])
            ->first();

        Log::info('PersonRepository>findExactPersonWithEmailAndMobile Function>Return . ' . json_encode($model));
        return $model;
    }
    public function findUserWithInOrganization($uId, $orgId)
    {
        return UserAccount::where('u_id', $uId)->where('organization_id', $orgId)->first();
    }
    public function findExactDatasWithMobile($mobile,$email)
    {
    $model=PersonMobile::select('person_mobile.uid','person_mobile.mobile','person_email.email','person_details.first_name as name')
    ->leftjoin('person_email','person_email.uid','person_mobile.uid')
    ->leftjoin('person_details','person_details.uid','person_mobile.uid')
    ->where('mobile',$mobile)->orWhere('email' ,$email)
    ->get();
   
    return $model;
    }
}
