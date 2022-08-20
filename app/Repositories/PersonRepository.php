<?php

namespace App\Repositories;


use App\Models\PersonDetails;
use App\Interfaces\PersonInterface;

use Illuminate\Support\Str;

//use Your Model
use App\Models\Common;
use App\Models\TempUsers;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonEmail;
use App\Models\PersonAddress;
use App\Models\PersonMobile;
use App\Models\BasicModels\Salutation;

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

    public function get_stage($request)
    {
        $mobile = $request['mobile'];
        if ($mobile) {
            $common = new Common();
            $stage = $common->check_temp_user_mobile($request['mobile']);
            $person_mobile = $common->check_users_mobile($request['mobile']);
            $user_mobile = $common->check_primary_user_mobile($request['mobile']);

            if ($person_mobile != 0 && $user_mobile != 0) {
                $uuid = $common->get_uuid_by_mobile($request['mobile']);
                if ($stage['stage'] === 0 && $uuid === 0) {
                    $temp_user = new TempUsers();

                    $temp_user->mobile = $request['mobile'];
                    $temp_user->ip_address = $request['ip'];
                    $temp_user->stage = 1;
                    $temp_user->save();
                    if ($temp_user->id > 0) {
                        $response = ["message" => 'OK', 'route' => 'stage2', "param" => ['mobile' => $request['mobile']]];
                        return response("dsa", 200);
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

                        $temp_user = new TempUsers();

                        $temp_user->mobile = $request['mobile'];
                        $temp_user->ip_address = $request['ip'];
                        $temp_user->stage = 1;
                        $temp_user->save();
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

    public function check_for_email($request)
    {
        $check_for_email = PersonEmail::where('email', $request['email'])->first('email');
        if (!empty($check_for_email)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['checked_email' => $check_for_email]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Email Not Found'];
            return response($response, 400);
        }
    }

    public function update_person_details($request)
    {

        $uuid = Str::uuid();
        $person = new Person();
        $mobile_person_id = '';
        $email_person_id = '';
        $person_id = '';
        $person_euid = '';
        $person_uid = '';
        if (PersonMobile::where(['mobile' => $request['mobile'], 'status' => 1])->exists()) {
            $person_m = PersonMobile::where('mobile', $request['mobile'])->first('uid');
            $person_uid = $person_m['uid'];
            $check_person = Person::where('uid', $person_uid)->first('uid');
            if ($check_person['uid'] == '') {
                $person->uid = $person_uid;
                $person->dependency = $request['dependency'] ? $request['dependency'] : 1;
                $person->save();
                $mobile_person_id = $person->id;
            }
        } else {
            $person_mobile = new PersonMobile();
            $person_mobile->mobile = $request['mobile'];
            $person_mobile->uid = $uuid;
            $person_mobile->status = 1;
            $person_mobile->save();
        }

        if (PersonEmail::where(['email' => $request['email'], 'status' => 1])->exists()) {
            $person_e = PersonEmail::where('email', $request['email'])->first('uid');
            $person_euid = $person_e['uid'];
            $check_person = Person::where('uid', $person_euid)->first('uid');
            if ($check_person['uid'] == '') {
                $person->uid = $person_euid;
                $person->dependency = $request['dependency'] ? $request['dependency'] : 1;
                $person->save();
                $email_person_id = $person->id;
            }
        } else {
            $person_email = new PersonEmail();
            $person_email->email = $request['email'];
            $person_email->uid = $uuid;
            $person_email->status = 1;
            $person_email->save();
        }

        if ($person_uid == '' || $person_euid == '') {
            $person->uid = $uuid;
            $person->dependency = $request['dependency'] ? $request['dependency'] : 1;
            $person->save();
            $person_id = $person->id;
        }

        if ($person_id > 0 || $person_uid != '' || $person_euid != '') {
            if ($person_euid != '') {
                $uid = $person_euid;
            } else if ($person_uid != '') {
                $uid = $person_uid;
            } else {
                $uid = $uuid;
            }
            $saluations = Salutation::all();
            $response = ["message" => 'OK', 'route' => 'registration_account', 'param' => ['uid' => $uid, 'saluations' => $saluations]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Registration failed', 'route' => 'registration', 'param' => ['mobile' => $request['mobile'], 'email' => $request['email']]];
            return response($response, 400);
        }
    }

    public function person_details_stage1($request)
    {
        $person_details = new PersonDetails();
        $person_details->saluation = $request['saluation'];
        $person_details->first_name = $request['first_name'];
        $person_details->last_name = $request['last_name'];
        $person_details->nick_name = $request['nick_name'];
        $person_details->middle_name = $request['middle_name'];
        $person_details->uid = $request['uid'];
        $person_details->save();
        $detais_id = $person_details->id;
        if ($detais_id > 0) {
            $response = ["message" => 'OK', 'route' => 'registration_basic', 'param' => ['uid' => $request['uid']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Registration failed'];
            return response($response, 400);
        }
    }


    public function person_details_stage2($request)
    {
        $person_details = new PersonDetails();
        $otp = rand(0, 99999);
        $otp_update = Person::where("uid", $request['uid'])->update(["otp" => $otp]);
        $affectedRows = PersonDetails::where("uid", $request['uid'])->update(["gender" => $request['gender'], "blood_group" => $request['blood_group'], "dob" => $request['dob']]);
        if ($affectedRows > 0) {
            $mobile = PersonMobile::where('uid', $request['uid'])->first();
            $response = ["message" => 'OK', 'route' => 'registration_otp', 'param' => ['uid' => $request['uid'], 'mobile' => $mobile]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Update Error!'];
            return response($response, 400);
        }
    }
}
