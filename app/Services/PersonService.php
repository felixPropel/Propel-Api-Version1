<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Interfaces\PersonInterface;
use App\Models\Common;
use App\Models\TempUsers;
use App\Models\Person;
use App\Models\PersonEmail;
use App\Models\PersonAddress;
use App\Models\PersonDetails;
use App\Models\PersonMobile;
use App\Models\User;
use App\Models\BasicModels\Salutation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PersonService
{
    protected $personInterface;

    public function __construct(PersonInterface $personInterface)
    {
        $this->personInterface = $personInterface;
    }

    public function getAllPersonDataWithEmailAndMobile($email, $mobile)
    {
        $models = $this->personInterface->getAllPersonDataWithEmailAndMobile($email, $mobile);
    }

    public function get_stage($request)
    {
        // $response=$this->personInterface->get_stage($data);
        // return $response;
        $mobile = $request['mobile'];
        if ($mobile) {
            $common = new Common();
            $stage = $common->check_temp_user_mobile($request['mobile']);
            $person_mobile = $common->check_users_mobile($request['mobile']);
            $user_mobile = $common->check_primary_user_mobile($request['mobile']);
            if ($person_mobile != 0 && $user_mobile != 0) {
                $uuid = $common->get_uuid_by_mobile($request['mobile']);
                if ($stage['stage'] === 0 && $uuid === 0) {
                    $temp_user_model = $this->convertToTempUserModel($request);
                    $temp_user = $this->personInterface->saveTempUser($temp_user_model);
                    if ($temp_user->id > 0) {
                        $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
                        return response($response, 200);
                    } else {
                        $response = ["message" => 'Something Went Wrong'];
                        return response($response, 400);
                    }
                } else if ($uuid) {
                    $response = ["message" => 'OK', 'route' => '/login', "param" => ['m' => $request['mobile']]];
                    return response($response, 200);
                } else if ($stage['stage'] == '1') {
                    $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
                    return response($response, 200);
                } else if ($stage['stage'] == '2') {
                    $response = ["message" => 'OK', 'route' => 'stage3', "param" => ['mobile' => $request['mobile']]];
                    return response($response, 200);
                } else if ($stage['stage'] == '3') {
                    $response = ["message" => 'OK', 'route' => 'registration'];
                    return response($response, 200);
                }
            } else {
                $uuid = $common->get_person_uuid_by_mobile($request['mobile']);

                if ($uuid) {
                    $email = $common->get_person_email($uuid);
                    if ($email) {
                        $response = ["message" => 'OK', 'route' => 'person_confirmation', "param" => ['uid' => $uuid]];
                        return response($response, 200);
                    } else {
                        $response = ["message" => 'OK', 'route' => 'person_email', 'uid' => $uuid];
                        return response($response, 200);
                    }
                } else {
                    $uuid = $common->get_uuid_by_mobile($request['mobile']);

                    if ($stage['stage'] === 0 && $uuid === 0) {

                        $temp_user_model = $this->convertToTempUserModel($request);
                        $temp_user = $this->personInterface->saveTempUser($temp_user_model);

                        if ($temp_user->id > 0) {
                            $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
                            return response($response, 200);
                        } else {
                            $response = ["message" => 'Something Went Wrong'];
                            return response($response, 400);
                        }
                    } else if ($uuid) {
                        // $response = ["message" => 'OK', 'route' => 'login', 'm' => $request['mobile']];
                        $response = ["message" => 'OK', 'route' => '/login', "param" => ['m' => $request['mobile']]];
                        return response($response, 200);
                    } else if ($stage['stage'] == '1') {
                        $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
                        return response($response, 200);
                    } else if ($stage['stage'] == '2') {
                        $response = ["message" => 'OK', 'route' => 'stage3', "param" => ['mobile' => $request['mobile']]];
                        return response($response, 200);
                    } else if ($stage['stage'] == '3') {
                        $response = ["message" => 'OK', 'route' => 'registration'];
                        return response($response, 200);
                    }
                }
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function convertToTempUserModel($data, $id = "")
    {
        if ($id) {
            $temp_user = $this->personInterface->findTempUserDataById($id);
        } else {
            $temp_user = new TempUsers();
        }
        $temp_user->mobile = $data['mobile'];
        $temp_user->ip_address = $data['ip'];
        $temp_user->stage = 1;
        return $temp_user;
    }

    public function convertToTempUserModel1($data)
    {
        $temp_user = $this->personInterface->findTempUserDataByMobile($data['mobile']);
        $temp_user->mobile = $data['mobile'];
        $temp_user->email = $data['email'];
        $temp_user->stage = 2;
        return $temp_user;
    }

    public function convertToPersonEmailModel($personData, $uid, $status, $email)
    {
        if ($uid) {
            $person_email = $this->personInterface->getPersonEmailByUid($uid, $status, $email);
        } else {
            $person_email = new PersonEmail();
        }
        $person_email->email = $personData['email'];
        $person_email->uid = $personData['uid'];
        $person_email->status = $personData['status'];
        return $person_email;
    }

    public function convertToPersonModel($person_datas)
    {
        $person = new Person();
        $person->uid = $person_datas['person_uid'];
        $person->dependency = $person_datas['dependency'];
        return $person;
    }
    public function convertToPersonModel1($personData)
    {
        if ($personData['uid']) {
            $person = $this->personInterface->check_person_exist_by_uid($personData['uid']);
        } else {
            $person = new TempUsers();
        }
        $person->uid = $personData['uid'];
        $person->otp = $personData['otp'];
        return $person;
    }

    public function convertToPersonMobileModel($person_datas, $uid, $status, $mobile)
    {
        if ($uid != "") {
            $person_mobile = $this->personInterface->getPersonMobileByUid($uid, $status, $mobile);
        } else {
            $person_mobile = new PersonMobile();
        }
        $person_mobile->mobile = $person_datas['mobile'];
        $person_mobile->uid = $person_datas['uid'];
        $person_mobile->status = $person_datas['status'] ? $person_datas['status'] : 0;
        return $person_mobile;
    }

    public function convertToPersonDetailsModel($data, $id)
    {
        if ($id != "") {
            $person_details = $this->personInterface->getPersonDetailsBasicUid($id);
            $person_details->uid = $data['uid'];
            $person_details->profile_pic = $data['profile_pic'];

            $person_details->saluation = $data['saluation'] ? $data['saluation'] : "";
            $person_details->first_name = $data['first_name'] ? $data['first_name'] : "";
            $person_details->middle_name = $data['middle_name'] ? $data['middle_name'] : "";
            $person_details->last_name = $data['last_name'] ? $data['last_name'] : "";
            $person_details->nick_name = $data['nick_name'] ? $data['nick_name'] : "";
            $person_details->gender = $data['gender'] ? $data['gender'] : "";
            $person_details->dob = $data['dob'] ? $data['dob'] : "";
            $person_details->blood_group = $data['blood_group'] ? $data['blood_group'] : "";
            $person_details->martial_status = $data['martial_status'] ? $data['martial_status'] : "";
            $person_details->aniversary_date = $data['aniversary_date'] ? $data['aniversary_date'] : "";
            $person_details->mother_tongue = $data['mother_tongue'] ? $data['mother_tongue'] : "";
            $person_details->other_language = $data['other_language'] ? $data['other_language'] : "";
            $person_details->profile_pic = $data['profile_pic'] ? $data['profile_pic'] : "";
            $person_details->birth_city = $data['birth_city'] ? $data['birth_city'] : "";
        } else {
            $person_details = new PersonDetails();
            $person_details->uid = $data['uid'];
            $person_details->saluation = $data['saluation'];
            $person_details->first_name = $data['first_name'];
            $person_details->last_name = $data['last_name'];
            $person_details->nick_name = $data['nick_name'];
            $person_details->middle_name = $data['middle_name'];
        }

        return $person_details;
    }

    public function convertToPersonDetailsModel1($data, $id = "")
    {
        if ($id) {
            $person_details = $this->personInterface->getPersonDetailsBasicUid($id);
            $person_details->first_name = $data['first_name'];
            $person_details->dob = $data['dob'];
            $person_details->family_name = $data['family_name'];
            $person_details->first_name = $data['first_name'];
        } else {
            $person_details = new PersonDetails();
            $person_details->gender = $data['gender'];
            $person_details->blood_group = $data['blood_group'];
            $person_details->dob = $data['dob'];
            $person_details->uid = $data['uid'];
        }

        return $person_details;
    }

    public function convertToUserModel($data, $id, $type)
    {
        if ($id != '') {
            $user = $this->personInterface->checkUserByUID($id);
            if ($type == 1) {
                $user->primary_mobile = $data['primary_mobile'];
            } else if ($type == 1) {
                $user->primary_mobile = $data['primary_mobile'];
            }
        } else {
            $user = new User();
            $user->uid = $data['uid'];
            $user->primary_email = $data['primary_email'];
            $user->primary_mobile = $data['primary_mobile'];
            $user->password = $data['password'];
        }
        return $user;
    }

    public function convertToHomeAddressModel($data)
    {
        $person_address = new PersonAddress();
        $person_address->uid = $data['uid'];
        $person_address->address_type = 1;
        $person_address->address = $data['address'];
        $person_address->door_no = $data['door_no'];
        $person_address->bilding_name =  $data['bilding_name'];
        $person_address->land_mark =  $data['land_mark'];
        $person_address->pincode =  $data['pincode'];
        $person_address->area =  $data['area'];
        $person_address->street =  $data['street'];
        $person_address->district =  $data['district'];
        $person_address->city =  $data['city'];
        $person_address->state =  $data['state'];
        $person_address->country =  $data['country'];
        $person_address->status =  $data['status'];
        return $person_address;
    }

    public function convertToOfficeAddressModel($data)
    {
        $person_address = new PersonAddress();
        $person_address->uid = $data['uid'];
        $person_address->address_type = $data['address_type'];
        $person_address->address = $data['address'];
        $person_address->status = $data['status'];
        return $person_address;
    }

    public function convertToPersonAddressModel($data, $uid, $address_of)
    {
        if ($uid != "" && $address_of != "") {
            $person_address = $this->personInterface->getPersonAddressByUidAndType($uid, $address_of);
            $person_address->uid = $data['uid'];
            $person_address->address_type = $address_of;
            $person_address->address = $data['address'];
            $person_address->door_no = $data['door_no'];
            $person_address->bilding_name = $data['bilding_name'];
            $person_address->street = $data['street'];
            $person_address->land_mark = $data['land_mark'];
            $person_address->pincode = $data['pincode'];
            $person_address->city = $data['city'];
            $person_address->state = $data['state'];
            $person_address->district = $data['district'];
            $person_address->area = $data['area'];
        } else {
            $person_address = new PersonAddress();
            $person_address->uid = $data['uid'];
            $person_address->address_type = 3;
            $person_address->address = $data['address'];
            $person_address->door_no = $data['door_no'];
            $person_address->bilding_name = $data['bilding_name'];
            $person_address->street = $data['street'];
            $person_address->land_mark = $data['land_mark'];
            $person_address->pincode = $data['pincode'];
            $person_address->city = $data['city'];
            $person_address->state = $data['state'];
            $person_address->district = $data['district'];
            $person_address->area = $data['area'];
            $person_address->status = 1;
        }
        return $person_address;
    }

    public function check_for_email($data)
    {
        $check_for_email = $this->personInterface->check_for_email($data);
        if (!empty($check_for_email)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['checked_email' => $check_for_email]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Email Not Found'];
            return response($response, 400);
        }
    }

    public function temp_update($data)
    {
        if ($data['mobile'] && $data['email']) {
            $tempModel = $this->convertToTempUserModel1($data);
            $tempUser = $this->personInterface->saveTempUser($tempModel);
            if ($tempUser) {
                $response = ["message" => 'OK', 'route' => 'confirmation', 'param' => ['email' => $data['email'], 'mobile' => $data['mobile']]];
                return response($response, 200);
            } else {
                $response = ["message" => 'This Email Already Exists,Try New One', 'route' => 'stage2', 'param' => ['mobile' => $data['mobile']]];
                return response($response, 400);
            }
        } else {
            $response = ["message" => 'Parameter Missing', 'route' => 'stage2'];
            return response($response, 400);
        }
    }

    public function update_person_details($data)
    {
        // $response = $this->personInterface->update_person_details($data);

        $uuid = Str::uuid();
        $person = new Person();
        $mobile_person_id = '';
        $email_person_id = '';
        $person_id = '';
        $person_euid = '';
        $person_uid = '';

        $is_person = $this->personInterface->checkPersonByMobile($data['mobile']);

        if ($is_person) {
            $person_m = $this->personInterface->check_for_mobile($data['mobile']);
            $person_uid = $person_m['uid'];
            $check_person = $this->personInterface->check_person_exist_by_uid($person_uid);
            if ($check_person['uid'] == '') {
                $person_data = array(
                    'person_uid' => $person_uid,
                    'dependency' => $data['dependency']
                );
                $personModel = $this->convertToPersonModel($person_data);
                $person = $this->personInterface->savePerson($personModel);
            }
        } else {
            $person_data = array(
                'mobile' => $data['mobile'],
                'uid' =>  $uuid
            );

            $personMobileModel = $this->convertToPersonMobileModel($person_data, "", "", "");
            $person = $this->personInterface->savePersonMobile($personMobileModel);
        }
        $check_person_email = $this->personInterface->check_person_exist_by_email($data['email']);

        if ($check_person_email) {
            $person_e = $this->personInterface->check_for_email($data);
            $person_euid = $person_e['uid'];
            $check_person = $this->personInterface->check_person_exist_by_uid($person_euid);
            if ($check_person['uid'] == '') {
                $person_data = array(
                    'person_uid' => $person_euid,
                    'dependency' => $data['dependency']
                );
                $personModel = $this->convertToPersonModel($person_data);
                $person = $this->personInterface->savePerson($personModel);
            }
        } else {
            $person_email = array(
                'email' => $data['email'],
                'uid' => $uuid,
                'status' => 1
            );
            $personModel = $this->convertToPersonEmailModel($person_email, "", "", "");
            $person = $this->personInterface->savePersonEmail($personModel);
        }

        if ($person_uid == '' || $person_euid == '') {
            $person_data = array(
                'person_uid' => $uuid,
                'dependency' => $data['dependency']
            );
            $personModel = $this->convertToPersonModel($person_data);
            $person_id = $this->personInterface->savePerson($personModel);
        }

        if ($person_id || $person_uid != '' || $person_euid != '') {
            if ($person_euid != '') {
                $uid = $person_euid;
            } else if ($person_uid != '') {
                $uid = $person_uid;
            } else {
                $uid = $uuid;
            }

            $saluations = $this->personInterface->getAllSaluations();
            $response = ["message" => 'OK', 'route' => 'registration_account', 'param' => ['uid' => $uid, 'saluations' => $saluations]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Registration failed', 'route' => 'registration', 'param' => ['mobile' => $data['mobile'], 'email' => $data['email']]];
            return response($response, 400);
        }
    }

    public function person_details_stage1($data)
    {
        $personDetailsModel = $this->convertToPersonDetailsModel($data, "");
        $personDetails = $this->personInterface->savePersonDetails($personDetailsModel);
        if ($personDetails) {
            $response = ["message" => 'OK', 'route' => 'registration_basic', 'param' => ['uid' => $data['uid']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Registration failed'];
            return response($response, 400);
        }
    }

    public function get_gender_and_blood_group($data)
    {
        $gender = $this->personInterface->get_gender();
        $blood = $this->personInterface->get_blood();
        if (!empty($gender) && !empty($blood)) {
            $response = ["message" => 'OK', 'route' => 'registration_basic', 'param' => ['blood' => $blood, 'gender' => $gender]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error in getting Blood Group or Gender'];
            return response($response, 400);
        }
    }

    public function person_details_stage2($data)
    {
        $otp = rand(0, 99999);
        $personArray = array(
            'uid' => $data['uid'],
            'otp' => $otp
        );
        $detailsArray = array(
            'uid' => $data['uid'],
            "gender" => $data['gender'],
            "blood_group" => $data['blood_group'],
            "dob" => $data['dob']
        );
        $personModel = $this->convertToPersonModel1($personArray);
        $person_id = $this->personInterface->savePerson($personModel);
        $personDetailsModel = $this->convertToPersonDetailsModel1($detailsArray);
        $affectedRows = $this->personInterface->savePersonDetails($personDetailsModel);
        if ($affectedRows) {
            $mobile = $this->personInterface->getPersonMobileByUid($data['uid'], 1, "", "");
            $response = ["message" => 'OK', 'route' => 'registration_otp', 'param' => ['uid' => $data['uid'], 'mobile' => $mobile]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Update Error!'];
            return response($response, 400);
        }
    }

    public function get_person_mobile($data)
    {
        $mobile = $this->personInterface->getPersonMobileByUid($data['uid'], 1, "");
        if (!empty($mobile)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['mobile' => $mobile]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Mobile Not Found'];
            return response($response, 400);
        }
    }

    public function create_user($data)
    {
        $mobile = $this->personInterface->getPersonMobileByUid($data['uid'], 1, "");
        $email = $this->personInterface->getPersonEmailByUid($data['uid'], "","");
        $userArray = array(
            'uid' => $data['uid'],
            'primary_email' => $email->email,
            'primary_mobile' => $mobile->mobile,
            'password' => Hash::make($data['password']),
        );
        $userModel = $this->convertToUserModel($userArray, "", "");
        $user = $this->personInterface->saveUser($userModel);
        if ($user) {
            $response = ["message" => 'OK', 'route' => 'profile', 'param' => ['uid' => $data['uid'], 'mobile' => $mobile->mobile, 'password' => $data['password']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error Occured!!!'];
            return response($response, 400);
        }
    }

    public function upload_pic($data)
    {
        $detailsArray = array(
            'profile_pic' => $data['file'],
            'uid' => $data['uid'],
        );
        $personDetailsModel = $this->convertToPersonDetailsModel($detailsArray, $data['uid']);
        $person_details = $this->personInterface->savePersonDetails($personDetailsModel);
        if ($person_details) {
            $response = ["message" => 'OK', 'route' => 'edit_profile', 'param' => ['uid' => $data['uid']]];
            return response($response, 200);
        }
    }

    public function person_details_by_uid($data)
    {
        $details = $this->personInterface->getFullPersonDetailsByUid($data['uid']);
        $result = $details->toArray();
        $states = $this->personInterface->getStates();
        if (!empty($result) && !empty($states)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['result' => $result, 'states' => $states]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error in getting Person Details Or States'];
            return response($response, 400);
        }
    }

    public function get_cities_by_state($data)
    {
        $states = $this->personInterface->getCitiesByState($data);
        if (!empty($states)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['states' => $states]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error in getting  States'];
            return response($response, 400);
        }
    }

    public function complete_profile($data)
    {
        // $response = $this->personInterface->complete_profile($data);
        // return $response;

        if ($data['file']) {
            $detailsArray = array(
                'profile_pic' => $data['file'],
                'uid' => $data['uid'],
            );
            $personDetailsModel = $this->convertToPersonDetailsModel($detailsArray, $data['uid']);
            $person_details = $this->personInterface->savePersonDetails($personDetailsModel);
        }

        $detailsArray1 = array(
            "first_name" => $data['first_name'],
            "dob" => $data['dob'],
            "family_name" => $data['family_name'],
            'uid' => $data['uid'],
        );
        $personDetailsModel1 = $this->convertToPersonDetailsModel1($detailsArray1, $data['uid']);
        $person_details1 = $this->personInterface->savePersonDetails($personDetailsModel1);

        if ($person_details1) {
            DB::table('person_address')->where('uid', $data['uid'])->delete();
            if ($data['home_address']) {
                $address_array = explode(',', $data['home_address']);

                $homeAddress = array(
                    'uid' => $data['uid'],
                    'address_type' => 1,
                    'address' => $data['home_address'] . '-' . $address_array[8],
                    'door_no' => $address_array[0],
                    'bilding_name' => $address_array[1],
                    'land_mark' => $address_array[2],
                    'pincode' => $address_array[7],
                    'area' => $address_array[3],
                    'street' => '-',
                    'district' => $address_array[4],
                    'city' => $address_array[6],
                    'state' => $address_array[5],
                    'country' => 101,
                    'status' => 1,
                );
                $homeAddressModel = $this->convertToHomeAddressModel($homeAddress);
                $home = $this->personInterface->saveHomeAddress($homeAddressModel);
            }

            if ($data['office_address']) {
                $officeAddress = array(
                    'uid' => $data['uid'],
                    'address_type' => 2,
                    'address' => $data['office_address'],
                    'status' => 1,
                );
                $officeAddressModel = $this->convertToOfficeAddressModel($officeAddress);
                $office = $this->personInterface->saveOfficeAddress($officeAddressModel);
            }

            $response = ["message" => 'OK', 'route' => 'organisation', 'param' => ['uid' => $data['uid']]];
            return response($response, 200);
        }
    }

    public function getProfileDetails($data)
    {
        $gender =  $this->personInterface->get_gender();
        $blood = $this->personInterface->get_blood();
        $saluation = $this->personInterface->getAllSaluations();
        $details = $this->personInterface->GetCompletePersonByUid($data['uid']);
        $address = $this->personInterface->getPersonAddressByUid($data['uid']);
        $states = $this->personInterface->getStates();
        $address_of = $this->personInterface->getAddressOf();
        $addressData = $details->person_address_profile;
        if (!empty($details)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['uid' => $data['uid'], 'result' => $details, 'addressData' => $addressData, 'gender' => $gender, 'blood' => $blood, 'saluations' => $saluation, 'states' => $states, 'address_of' => $address_of, 'address' => $address]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Details Not Found'];
            return response($response, 400);
        }
    }

    public function PersonDetailsUpdate($data)
    {
        $details_array = array(
            "saluation" => $data['saluation'],
            "first_name" => $data['first_name'],
            "middle_name" => $data['middle_name'],
            "last_name" => $data['last_name'],
            "nick_name" => $data['nick_name'],
            "gender" => $data['gender'],
            "dob" => $data['dob'],
            "blood_group" => $data['blood_group'],
            "martial_status" => $data['martial_status'],
            "aniversary_date" => $data['aniversary_date'],
            "mother_tongue" => $data['mother_tongue'],
            "other_language" => $data['other_language'],
            "profile_pic" => $data['profile_pic'],
            "birth_city" => $data['birth_city'],
            "uid" => $data['uid']
        );
        $personDetailsModel = $this->convertToPersonDetailsModel($details_array, $data['uid']);
        $person_details = $this->personInterface->savePersonDetails($personDetailsModel);
        if ($person_details) {
            $response = ["message" => 'OK', 'route' => 'profile', 'param' => ['uid' => $data['uid']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Update Error!'];
            return response($response, 400);
        }
    }

    public function PersonDetailsUpdateExtra($data)
    {
        $person_address = $this->personInterface->getPersonAddressByUidAndType($data['uid'], $data['address_of']);

        if ($person_address) {
            $address_array = array(
                'uid' => $data['uid'],
                "address_type" => 3,
                "address" => $data['address_of'],
                "door_no" => $data['door_no'],
                "bilding_name" => $data['bilding_name'],
                "street" => $data['street'],
                "land_mark" => $data['land_mark'],
                "pincode" => $data['pincode'],
                "city" => $data['city'],
                "state" => $data['state'],
                "district" => $data['district'],
                "area" => $data['area'],
            );
            $addressModel = $this->convertToPersonAddressModel($address_array, $data['uid'], $data['address_of']);

            $address = $this->personInterface->savePersonAddress($addressModel);
        } else {
            $address_array = array(
                'uid' => $data['uid'],
                "address_type" => 3,
                "address" => $data['address_of'],
                "door_no" => $data['door_no'],
                "bilding_name" => $data['bilding_name'],
                "street" => $data['street'],
                "land_mark" => $data['land_mark'],
                "pincode" => $data['pincode'],
                "city" => $data['city'],
                "state" => $data['state'],
                "district" => $data['district'],
                "area" => $data['area'],
                "status" => 1,
            );
            $addressModel = $this->convertToPersonAddressModel($address_array, "", "");
            $address = $this->personInterface->savePersonAddress($addressModel);
        }
        $affectedRows1 = $this->personInterface->updateWebLink($data['uid'], $data['web_link']);

        if ($address) {
            $response = ["message" => 'OK', 'route' => 'profile', 'param' => ['uid' => $data['uid']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Update Error!'];
            return response($response, 400);
        }
    }


    public function storeMobile($data)
    {
        if ($data['mobile_type'] == '1') {
            $mobile_array = array(
                'uid' => $data['uid'],
                'primary_mobile' => $data['mobile'],
            );
            $userModel = $this->convertToUserModel($mobile_array, $data['uid'], 1);
            $user = $this->personInterface->saveUser($userModel);
            $mobile = $this->personInterface->getPersonMobileByUid($data['uid'], 1, "");
            return $mobile;

            if (!empty($mobile)) {
                $personMobileArr = array(
                    "mobile" => $data['mobile'],
                );
                $mobileModel = $this->convertToPersonMobileModel($personMobileArr, $data['uid'], 1, $mobile[0]);
                $personMobile = $this->personInterface->savePersonMobile($mobileModel);
                if ($personMobile) {
                    $personMobileArr1 = array(
                        "uid" => $data['uid'],
                        "mobile" => $mobile[0],
                        "status" => 0,
                    );
                    $mobileModel = $this->convertToPersonMobileModel($personMobileArr1, "", "", "");
                    $person = $this->personInterface->savePersonMobile($mobileModel);
                    $response = ["message" => 'OK'];
                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            } else {
                $personMobileArr2 = array(
                    "uid" => $data['uid'],
                    "mobile" => $data['mobile'],
                    "status" => 1,
                );
                $mobileModel = $this->convertToPersonMobileModel($personMobileArr2, "", "", "");
                $personMobile = $this->personInterface->savePersonMobile($mobileModel);
                if ($personMobile) {
                    $response = ["message" => 'OK'];
                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            }
        } else if ($data['mobile_type'] == '2') {

            $mobile = $this->personInterface->getPersonMobileByUid($data['uid'], 2, "");
            if (!empty($mobile)) {
                $personMobileArr = array(
                    "mobile" =>  $data['mobile'],
                );
                $mobileModel = $this->convertToPersonMobileModel($personMobileArr, $data['uid'], 2, $mobile[0]);
                $personMobile = $this->personInterface->savePersonMobile($mobileModel);
                if ($personMobile) {
                    $personMobileArr2 = array(
                        "uid" => $data['uid'],
                        "mobile" => $mobile[0],
                        "status" => 0,
                    );
                    $mobileModel = $this->convertToPersonMobileModel($personMobileArr2, "", "", "");
                    $personMobile = $this->personInterface->savePersonMobile($mobileModel);
                    $response = ["message" => 'OK'];

                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            } else {
                $personMobileArr2 = array(
                    "uid" => $data['uid'],
                    "mobile" => $data['mobile'],
                    "status" => 2,
                );
                $mobileModel = $this->convertToPersonMobileModel($personMobileArr2, "", "", "");
                $personMobile = $this->personInterface->savePersonMobile($mobileModel);
                if ($personMobile) {
                    $response = ["message" => 'OK'];
                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            }
        }
    }

    public function makePrimary($data)
    {
        $uid = $data['uid'];
        $primary = $data['primary'];
        $other = $data['other'];
        if ($uid && $primary && $other) {
            $affectedRows = $this->personInterface->updateUserPrimaryMobile($data['uid'], $other);
            $personMobileArr2 = array(
                "uid" => $data['uid'],
                "mobile" => $primary,
                "status" => 1,
            );
            $mobileModel = $this->convertToPersonMobileModel($personMobileArr2, $data['uid'], 1, "");
            $personMobile = $this->personInterface->savePersonMobile($mobileModel);
            if ($personMobile) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function makeEmailPrimary($data)
    {
        $uid = $data['uid'];
        $email = $data['email'];
        if ($uid && $email) {
            $affectedRows = $this->personInterface->updateUserPrimaryEmail($data['uid'], $email);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function makeEmailSecondary($data)
    {
        $email = $this->personInterface->getPersonEmailByUid($data['uid'], 2, "");
        if (!empty($email)) {

            $person_email = array(
                "uid" => $data['uid'],
                "status" => 2,
                "email" => $data['email']
            );
            $personModel = $this->convertToPersonEmailModel($person_email, $data['uid'], 2, $email['email']);
            $person_email = $this->personInterface->savePersonEmail($personModel);
            if ($person_email) {
                $person_email = array(
                    "uid" => $data['uid'],
                    "status" => 0,
                    "email" => $email['email']
                );
                $personModel = $this->convertToPersonEmailModel($person_email, "", "", "");
                $person_email = $this->personInterface->savePersonEmail($personModel);

                $response = ["message" => 'OK'];
                return response($response, 200);
            } else {
                $response = ["message" => 'Update error'];
                return response($response, 400);
            }
        } else {

            $person_email = array(
                "uid" => $data['uid'],
                "status" => 2,
                "email" => $data['email']
            );
            $personModel = $this->convertToPersonEmailModel($person_email, "", "", "");
            $person_email = $this->personInterface->savePersonEmail($personModel);

            if ($person_email) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            } else {
                $response = ["message" => 'Update error'];
                return response($response, 400);
            }
        }
    }

    public function makeEmailPrimarySecondary($data){
        $uid = $data['uid'];
        $primary = $data['primary_email'];
        $other = $data['other_email'];
        if ($uid && $primary && $other) {
            $affectedRows = $this->personInterface->updateUserPrimaryEmail($data['uid'], $other);
            $affectedRows1 = $this->personInterface->updatePersonEmail($data['uid'], $primary);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }
    

    public function deleteOther($data){
        $mobile = $this->personInterface->getPersonMobileByUid($data['uid'], 2, "");
        if (!empty($mobile)) {
            $affectedRows = $this->personInterface->makeMobileInactive($data['uid'], 2, $data['other']);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            } else {
                $response = ["message" => 'Update error'];
                return response($response, 400);
            }
        }
    }

    public function deleteOtherEmail($data){
        $uid = $data['uid'];
        $other = $data['other'];
        if ($uid && $other) {
            $affectedRows =  $affectedRows = $this->personInterface->makeEmailInactive($data['uid'],$other);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }



    //Written Dhana Function Started
    //@developer Dhana
    public function findExactPersonWithEmailAndMobile($datas)
    {
        Log::info('PersonService>findExactPersonWithEmailAndMobile Function>Inside. ');
        $datas = (object)$datas;
        $email = $datas->email;
        $mobile = $datas->mobile;
        $response = $this->personInterface->findExactPersonWithEmailAndMobile($email, $mobile);
        Log::info('PersonService>findExactPersonWithEmailAndMobile Function>Return.' . json_encode($response));
        return response($response, 200);
    }
    //Written Dhana Function Ended
}
