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
use App\Models\Person;
use App\Models\PersonEmail;
use App\Models\PersonAddress;
use App\Models\PersonMobile;
use App\Models\BasicModels\Salutation;
use App\Models\BasicModels\State;
use App\Models\BasicModels\Gender;
use App\Models\BasicModels\BloodGroup;
use Illuminate\Support\Facades\DB;

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
    // public function get_stage($request)
    // {
    //     $mobile = $request['mobile'];
    //     if ($mobile) {
    //         $common = new Common();
    //         $stage = $common->check_temp_user_mobile($request['mobile']);
    //         $person_mobile = $common->check_users_mobile($request['mobile']);
    //         $user_mobile = $common->check_primary_user_mobile($request['mobile']);

    //         if ($person_mobile != 0 && $user_mobile != 0) {
    //             $uuid = $common->get_uuid_by_mobile($request['mobile']);
    //             if ($stage['stage'] === 0 && $uuid === 0) {
    //                 $temp_user = new TempUsers();

    //                 $temp_user->mobile = $request['mobile'];
    //                 $temp_user->ip_address = $request['ip'];
    //                 $temp_user->stage = 1;
    //                 $temp_user->save();
    //                 if ($temp_user->id > 0) {
    //                     $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
    //                     return response($response, 200);
    //                 } else {
    //                     $response = ["message" => 'Something Went Wrong'];
    //                     return response($response, 400);
    //                 }
    //             } else if ($uuid) {
    //                 $response = ["message" => 'OK', 'route' => '/login', "param" => ['m' => $request['mobile']]];
    //                 return response($response, 200);
    //             } else if ($stage['stage'] == '1') {
    //                 $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
    //                 return response($response, 200);
    //             } else if ($stage['stage'] == '2') {
    //                 $response = ["message" => 'OK', 'route' => 'stage3', "param" => ['mobile' => $request['mobile']]];
    //                 return response($response, 200);
    //             } else if ($stage['stage'] == '3') {
    //                 $response = ["message" => 'OK', 'route' => 'registration'];
    //                 return response($response, 200);
    //             }
    //         } else {
    //             $uuid = $common->get_person_uuid_by_mobile($request['mobile']);

    //             if ($uuid) {
    //                 $email = $common->get_person_email($uuid);
    //                 if ($email) {
    //                     $response = ["message" => 'OK', 'route' => 'person_confirmation', "param" => ['uid' => $uuid]];
    //                     return response($response, 200);
    //                 } else {
    //                     $response = ["message" => 'OK', 'route' => 'person_email', 'uid' => $uuid];
    //                     return response($response, 200);
    //                 }
    //             } else {
    //                 $uuid = $common->get_uuid_by_mobile($request['mobile']);

    //                 if ($stage['stage'] === 0 && $uuid === 0) {

    //                     $temp_user = new TempUsers();

    //                     $temp_user->mobile = $request['mobile'];
    //                     $temp_user->ip_address = $request['ip'];
    //                     $temp_user->stage = 1;
    //                     $temp_user->save();
    //                     if ($temp_user->id > 0) {
    //                         $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
    //                         return response($response, 200);
    //                     } else {
    //                         $response = ["message" => 'Something Went Wrong'];
    //                         return response($response, 400);
    //                     }
    //                 } else if ($uuid) {
    //                     // $response = ["message" => 'OK', 'route' => 'login', 'm' => $request['mobile']];
    //                     $response = ["message" => 'OK', 'route' => '/login', "param" => ['m' => $request['mobile']]];
    //                     return response($response, 200);
    //                 } else if ($stage['stage'] == '1') {
    //                     $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
    //                     return response($response, 200);
    //                 } else if ($stage['stage'] == '2') {
    //                     $response = ["message" => 'OK', 'route' => 'stage3', "param" => ['mobile' => $request['mobile']]];
    //                     return response($response, 200);
    //                 } else if ($stage['stage'] == '3') {
    //                     $response = ["message" => 'OK', 'route' => 'registration'];
    //                     return response($response, 200);
    //                 }
    //             }
    //         }
    //     } else {
    //         $response = ["message" => 'Parameter Missing'];
    //         return response($response, 400);
    //     }
    // }

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



    public function create_user($request)
    {
        $mobile = PersonMobile::where('uid', $request['uid'])->first();
        $email = PersonEmail::where('uid', $request['uid'])->first('email');
        $user = new User();
        $user->uid = $request['uid'];
        $user->primary_email = $email->email;
        $user->primary_mobile = $mobile->mobile;
        $user->password = Hash::make($request['password']);
        $user->save();
        $user_id = $user->id;
        if ($user_id > 0) {
            $response = ["message" => 'OK', 'route' => 'profile', 'param' => ['uid' => $request['uid'], 'mobile' => $mobile->mobile, 'password' => $request['password']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error Occured!!!'];
            return response($response, 400);
        }
    }

    public function upload_pic($request)
    {
        $person_details = new PersonDetails();
        $person_details->profile_pic = $request['file'];
        $affectedRows = PersonDetails::where("uid", $request['uid'])->update(["profile_pic" => $request['file']]);
        if ($affectedRows > 0) {
            $response = ["message" => 'OK', 'route' => 'edit_profile', 'param' => ['uid' => $request['uid']]];
            return response($response, 200);
        }
    }

    public function person_details_by_uid($request)
    {
        $details = PersonDetails::with('email', 'mobile', 'person', 'person_address')->where("uid", $request['uid'])->get();
        $result = $details->toArray();
        $states = State::where('country_id', 101)->get();
        if (!empty($result) && !empty($states)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['result' => $result, 'states' => $states]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error in getting Person Details Or States'];
            return response($response, 400);
        }
    }

    public function complete_profile($request)
    {
        if ($request['file']) {
            $affectedRows1 = PersonDetails::where("uid", $request['uid'])->update(["profile_pic" => $request['file']]);
        }

        $affectedRows2 = PersonDetails::where("uid", $request['uid'])->update(["first_name" => $request['first_name'], "dob" => $request['dob'], "family_name" => $request['family_name']]);
        $affectedRows3 = PersonEmail::where("uid", $request['uid'])->update(["email" => $request['email']]);
        $affectedRows4 = PersonMobile::where("uid", $request['uid'])->update(["mobile" => $request['mobile']]);
        if ($affectedRows2 > 0) {
            DB::table('person_address')->where('uid', $request['uid'])->delete();
            if ($request['home_address']) {
                $address_array = explode(',', $request['home_address']);

                $person_address = new PersonAddress();
                $person_address->uid = $request['uid'];
                $person_address->address_type = 1;
                $person_address->address = $request['home_address'] . '-' . $address_array[8];
                $person_address->door_no = $address_array[0];
                $person_address->bilding_name = $address_array[1];
                $person_address->land_mark = $address_array[2];
                $person_address->pincode = $address_array[7];
                $person_address->area = $address_array[3];
                $person_address->street = "-";
                $person_address->district = $address_array[4];
                $person_address->city = $address_array[6];
                $person_address->state = $address_array[5];
                $person_address->country = 101;
                $person_address->status = 1;
                $person_address->save();
            }

            if ($request['office_address']) {
                $person_address = new PersonAddress();
                $person_address->uid = $request['uid'];
                $person_address->address_type = 2;
                $person_address->address = $request['office_address'];
                $person_address->status = 1;
                $person_address->save();
            }

            $response = ["message" => 'OK', 'route' => 'organisation', 'param' => ['uid' => $request['uid']]];
            return response($response, 200);
        }
    }
}
