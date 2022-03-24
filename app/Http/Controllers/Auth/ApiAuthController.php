<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\PersonDetails;
use App\Models\PersonAddress;
use App\Models\TempUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Common;
use Illuminate\Support\Facades\DB;
use App\Models\BasicModels\Salutation;
use Laravel\Passport\HasApiTokens;

class ApiAuthController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'primary_mobile' => 'required|string|max:255',
            'primary_email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        //dd($request->toArray());
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }


    public function login(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('primary_email', $request->username)->orWhere('primary_mobile', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }

    public function check_person(Request $request)
    {
        $mobile = $request->mobile;
        if ($mobile) {
            $person_mobile = PersonMobile::where(['mobile' => $mobile, 'status' => 1])->first();
            if ($person_mobile) {
                return response($person_mobile, 200);
            } else {
                $response = ["message" => 'Mobile does not exist'];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function check_person_email(Request $request)
    {
        $email = $request->email;
        if ($email) {
            $person_email = PersonEmail::where(['email' => $email, 'status' => 1])->first();
            if ($person_email) {
                return response($person_email, 200);
            } else {
                $response = ["message" => 'Email does not exist'];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function get_temp_status(Request $request)
    {
        $mobile = $request->mobile;
        if ($mobile) {
            $temp_users = TempUsers::where('mobile', $mobile)->first();
            if ($temp_users) {
                return response($temp_users, 200);
            } else {
                $response = ["message" => 'Temp User does not exist'];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }


    public function check_user(Request $request)
    {
        $mobile = $request->mobile;
        if ($mobile) {
            $user = User::where('primary_mobile', $mobile)->first();
            if ($user) {
                return response($user, 200);
            } else {
                $response = ["message" => 'User does not exist'];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function temp_user_mobile(Request $request)
    {
        $mobile = $request->mobile;
        if ($mobile) {
            $check_user = TempUsers::where('mobile', $mobile)->first();
            if ($check_user->mobile) {
                $response = ["message" => 'User Already Exist', "Details" => $check_user];
                return response($response, 400);
            } else {
                $user = new TempUsers();
                $user->mobile = $mobile;
                $user->ip_address = $request->ip();
                $user->stage = 1;
                $user->save();
                $user_id = $user->id;
                if ($user_id) {
                    return response($user_id, 200);
                } else {
                    $response = ["message" => 'Insert Error'];
                    return response($response, 400);
                }
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }


    public function update_temp_user_email(Request $request)
    {
        $temp_user_id = $request->temp_user_id;
        $email = $request->email;
        if ($temp_user_id && $email) {
            $affectedRows = TempUsers::where("id", $temp_user_id)->update(["email" => $email, "stage" => 2]);
            if ($affectedRows > 0) {
                $response = ["message" => 'Update Success'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function get_stage(Request $request)
    {
        $mobile = $request->mobile;
        if ($mobile) {
            $stage = Common::check_temp_user_mobile($request['mobile']);
            $person_mobile = Common::check_users_mobile($request['mobile']);
            $user_mobile = Common::check_primary_user_mobile($request['mobile']);

            if ($person_mobile != 0 && $user_mobile != 0) {
                $uuid = Common::get_uuid_by_mobile($request['mobile']);
                if ($stage['stage'] === 0 && $uuid === 0) {
                    $temp_user = new TempUsers();

                    $temp_user->mobile = $request['mobile'];
                    $temp_user->ip_address = $request->ip();
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
                $uuid = Common::get_person_uuid_by_mobile($request['mobile']);

                if ($uuid) {
                    $email = Common::get_person_email($uuid);
                    if ($email) {
                        $response = ["message" => 'OK', 'route' => 'person_confirmation', "param" => ['uid' => $uuid]];
                        return response($response, 200);
                    } else {
                        $response = ["message" => 'OK', 'route' => 'person_email', 'uid' => $uuid];
                        return response($response, 200);
                    }
                } else {
                    $uuid = Common::get_uuid_by_mobile($request['mobile']);

                    if ($stage['stage'] === 0 && $uuid === 0) {

                        $temp_user = new TempUsers();

                        $temp_user->mobile = $request['mobile'];
                        $temp_user->ip_address = $request->ip();
                        $temp_user->stage = 1;
                        $temp_user->save();
                        if ($temp_user->id > 0) {
                            $response = ["message" => 'OK', 'route' => 'stage2', "param" =>['mobile' => $request['mobile']]];
                            return response($response, 200);
                        } else {
                            $response = ["message" => 'Something Went Wrong'];
                            return response($response, 400);
                        }
                    } else if ($uuid) {
                        $response = ["message" => 'OK', 'route' => 'login', 'm' => $request['mobile']];
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

    function temp_update(Request $request)
    {
        if ($request['mobile'] && $request['email']) {
            $request->validate([
                'email' => 'required|email',
            ]);
            $update = Common::update_temp_user($request['mobile'], $request['email']);
            if ($update) {
                $response = ["message" => 'OK', 'route' => 'confirmation', 'param' => ['email' => $request['email'], 'mobile' => $request['mobile']]];
                return response($response, 200);
            } else {
                $response = ["message" => 'This Email Already Exists,Try New One', 'route' => 'stage2', 'param' => ['mobile' => $request['mobile']]];
                return response($response, 400);
            }
        } else {
            $response = ["message" => 'Parameter Missing', 'route' => 'stage2'];
            return response($response, 400);
        }
    }

    public function check_confirmation(Request $request)
    {
        $mobile = $request->mobile;
        $email = Common::get_temp_email_by_mobile($mobile);
        if ($email) {
            $response = ["message" => 'OK', 'route' => 'confirmation', 'param' => ['email' => $email, 'mobile' => $request['mobile']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Email Not Found', 'route' => 'stage2', 'param' => ['mobile' => $request['mobile']]];
            return response($mobile, 400);
        }
    }

    public function update_person_details(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required'
        ]);
        $uuid = Str::uuid();
        $person = new Person();
        $mobile_person_id = '';
        $email_person_id = '';
        $person_id = '';
        $person_euid = '';
        $person_uid = '';
        if (PersonMobile::where(['mobile' => $request->mobile, 'status' => 1])->exists()) {
            $person_m = PersonMobile::where('mobile', $request->mobile)->first('uid');
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

        if (PersonEmail::where(['email' => $request->email, 'status' => 1])->exists()) {
            $person_e = PersonEmail::where('email', $request->email)->first('uid');
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


    public function person_details_stage1(Request $request)
    {
        if ($request->isMethod('post')) {
            $person_details = new PersonDetails();
            $person_details->saluation = $request->saluation;
            $person_details->first_name = $request->first_name;
            $person_details->last_name = $request->last_name;
            $person_details->nick_name = $request->nick_name;
            $person_details->uid = $request->uid;
            $person_details->save();
            $detais_id = $person_details->id;
            if ($detais_id > 0) {
                $response = ["message" => 'OK', 'route' => 'registration_basic', 'param' => ['uid' => $request->uid]];
                return response($response, 200);
            } else {
                $response = ["message" => 'Registration failed'];
                return response($response, 400);
            }
        } else {
            $response = ["message" => 'Inappropriate Submission'];
            return response($response, 400);
        }
    }

    public function person_details_stage2(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'gender' => 'required',
                'blood_group' => 'required',
                'dob' => 'required',

            ]);
            $person_details = new PersonDetails();
            $otp = rand(0, 99999);
            $otp_update = Person::where("uid", $request['uid'])->update(["otp" => $otp]);
            $affectedRows = PersonDetails::where("uid", $request['uid'])->update(["gender" => $request['gender'], "blood_group" => $request['blood_group'], "dob" => $request['dob']]);
            if ($affectedRows > 0) {
                $mobile = PersonMobile::where('uid', $request['uid'])->first();
                $response = ["message" => 'OK', 'route' => 'registration_otp', 'param' => ['uid' => $request->uid, 'mobile' => $mobile]];
                return response($response, 200);
            } else {
                $response = ["message" => 'Update Error!'];
                return response($response, 400);
            }
        } else {
            $response = ["message" => 'Inappropriate Submission'];
            return response($response, 400);
        }
    }

    public function create_user(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        $mobile = PersonMobile::where('uid', $request->uid)->first();
        $email = PersonEmail::where('uid', $request->uid)->first('email');
        $user = new User();
        $user->uid = $request->uid;
        $user->primary_email = $email->email;
        $user->primary_mobile = $mobile->mobile;
        $user->password = Hash::make($request->password);
        $user->save();
        $user_id = $user->id;
        if ($user_id > 0) {
            $response = ["message" => 'OK', 'route' => 'profile', 'param' => ['uid' => $request->uid]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error Occured!!!'];
            return response($response, 400);
        }
    }

    public function upload_pic(Request $request)
    {
        $person_details = new PersonDetails();
        $person_details->profile_pic = $request->file;
        $affectedRows = PersonDetails::where("uid", $request->uid)->update(["profile_pic" => $request->file]);
        if ($affectedRows > 0) {
            $response = ["message" => 'OK', 'route' => 'edit_profile', 'param' => ['uid' => $request->uid]];
            return response($response, 200);
        }
    }

    public function complete_profile(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->file) {
                $affectedRows1 = PersonDetails::where("uid", $request->uid)->update(["profile_pic" => $request->file]);
            }

            $affectedRows2 = PersonDetails::where("uid", $request->uid)->update(["first_name" => $request->first_name, "dob" => $request->dob, "family_name" => $request->family_name]);
            $affectedRows3 = PersonEmail::where("uid", $request->uid)->update(["email" => $request->email]);
            $affectedRows4 = PersonMobile::where("uid", $request->uid)->update(["mobile" => $request->mobile]);
            if ($affectedRows2 > 0) {
                DB::table('person_address')->where('uid', $request->uid)->delete();
                if ($request->home_address) {
                    $person_address = new PersonAddress();
                    $person_address->uid = $request->uid;
                    $person_address->address_type = 1;
                    $person_address->address = $request->home_address;
                    $person_address->status = 1;
                    $person_address->save();
                }

                if ($request->office_address) {
                    $person_address = new PersonAddress();
                    $person_address->uid = $request->uid;
                    $person_address->address_type = 2;
                    $person_address->address = $request->office_address;
                    $person_address->status = 1;
                    $person_address->save();
                }

                $response = ["message" => 'OK', 'route' => 'account', 'param' => ['uid' => $request->uid]];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Inappropriate Submisssion'];
            return response($response, 400);
        }
    }

    public function person_registration_otp(Request $request)
    {
        $mobile = PersonMobile::where('uid', $request['uid'])->first();
        if ($mobile) {
            $response = ["message" => 'OK', 'route' => 'person_registration_otp', "param" => ['uid' => $request->uid, 'mobile' => $mobile->mobile]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Mobile Not Found'];
            return response($response, 400);
        }
    }

    public function update_password(Request $request)
    {
        $mobile = PersonMobile::where('uid', $request->uid)->first();
        $email = PersonEmail::where('uid', $request->uid)->first('email');
        $user = new User();
        $user->uid = $request->uid;
        $user->primary_email = $email->email;
        $user->primary_mobile = $mobile->mobile;
        $user->password = Hash::make($request->password);
        $user->save();
        $user_id = $user->id;
        if ($user_id > 0) {
            DB::table('temp_users')->where('mobile', $mobile->mobile)->delete();
            $response = ["message" => 'OK', 'route' => 'edit_profile', "param" => ['uid' => $request->uid]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error Occured !!!'];
            return response($response, 400);
        }
    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
