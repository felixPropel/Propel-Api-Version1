<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BasicModels\Gender;
use App\Models\BasicModels\BloodGroup;
use App\Models\Person;
use App\Models\BasicModels\State;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\PersonDetails;
use App\Models\PersonAddress;
use App\Models\Organisation;
use App\Models\Organisation_address;
use App\Models\Organisation_details;
use App\Models\OrganisationEmail;
use App\Models\OrganisationPhone;
use App\Models\OrganisationWebaddress;
use App\Models\OrganisationIdentities;
use App\Models\OrganisationAdmin;
use App\Models\TempUsers;
use App\Models\TempOrganisation;
use App\Models\TempOrganisationEmail;
use App\Models\TempOrganisation_address;
use App\Models\TempOrganisationAdmin;
use App\Models\Address_of;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Common;
use Illuminate\Support\Facades\DB;
use App\Models\BasicModels\Salutation;
use App\Models\TempOrganisation_details;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

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
        $uid=$user->uid;
        $user_name=PersonDetails::where('uid',$uid)->pluck('first_name')->first();
       
     
        if ($user) {
            if (Hash::check($request->password, $user->password)) { 
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch",'username' =>$user_name,'uid'=>$uid];
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




    public function check_confirmation(Request $request)
    {
        $mobile = $request->mobile;
        $common = new Common();
        $email = $common->get_temp_email_by_mobile($mobile);
        if ($email) {
            $response = ["message" => 'OK', 'route' => 'confirmation', 'param' => ['email' => $email, 'mobile' => $request['mobile']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Email Not Found', 'route' => 'stage2', 'param' => ['mobile' => $request['mobile']]];
            return response($mobile, 400);
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
        Log::info('ApiAuthController>update_password Function>Inside.');
        $mobile = PersonMobile::where('uid', $request->uid)->first();
        $email = PersonEmail::where('uid', $request->uid)->first('email');
        $user = User::where('uid', $request->uid)->first();
        if ($user) {
            $password = Hash::make($request->password);
            $affectedRows = User::where("uid", $request->uid)->update(["password" => $password]);
            if ($affectedRows > 0) {
                $user_id = $request->uid;
            }
        } else {
            $user = new User();
            $user->uid = $request->uid;
            $user->primary_email = $email->email;
            $user->primary_mobile = $mobile->mobile;
            $user->password = Hash::make($request->password);
            $user->save();
            $user_id = $user->id;
            Log::info('ApiAuthController>update_password Function>else .');
        }
        if ($user_id) {
            $details = PersonDetails::with('email', 'mobile', 'person', 'person_address')->where("uid", $request->uid)->get();
            $result = $details->toArray();
            $states = State::where('country_id', 101)->get();
            DB::table('temp_users')->where('mobile', $mobile->mobile)->delete();
            $response = ["message" => 'OK', 'route' => 'edit_profile', "param" => ['uid' => $request->uid, 'result' => $result, "states" => $states]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error Occured !!!'];
            return response($response, 400);
        }
    }


    function generateEmailOtp(Request $request)
    {
        Log::info('ApiAuthController > generateEmailOtp function Inside.' . json_encode($request->all()));
        $uid = $request->uid;
        $person_email = PersonEmail::where('uid', $uid)->first('email');
        $email = $person_email->toArray();
        $otp = substr(str_shuffle("0123456789"), 0, 5);
        $mail_email = $email['email'];
        $affectedRows = PersonEmail::where("uid", $uid)->update(["otp_received" => $otp, "email_validation_status" => 0]);
        $template_data = ['email' => $email, 'otp' => $otp];
        Log::info('ApiAuthController > generateEmailOtp function Return.' . json_encode($template_data));
        Mail::send(
            ['html' => 'email.email_otp'],
            $template_data,
            function ($message) use ($mail_email) {
                $message->to($mail_email)
                    ->from('propelsoft@gmail.com', 'Email OTP')
                    ->subject('Password Reset');
            }
        );
        
        if ($affectedRows) {
            
           
            $response = ["message" => 'OK', 'route' => 'email_otp', "param" => ['uid' => $uid, 'email' => $email['email']]];
            return response($response, 200);
        } else {
          
            $response = ["message" => 'Mail Not Send'];
            return response($response, 400);
        }
    }

    public function get_user_data(Request $request)
    {
        log::info('ApiAuthController > ' . json_encode($request->all()));
        $user = auth()->guard('api')->user();
        return response($user, 200);
    }

    public function store_mobile(Request $request)
    {
        if ($request->mobile_type == '1') {
            // 
            // if ($affectedRows > 0) {
            //     $response = ["message" => 'OK'];
            //     return response($response, 200);
            // }

            $affectedRows = User::where("uid", $request->uid)->update(["primary_mobile" => $request->mobile]);
            $mobile = PersonMobile::where(['uid' => $request->uid, "status" => 1])->pluck('mobile')->toArray();
            if (!empty($mobile)) {
                $affectedRows = PersonMobile::where(["uid" => $request->uid, "status" => 1, "mobile" => $mobile[0]])->update(["mobile" => $request->mobile]);
                if ($affectedRows > 0) {

                    $person_mobile = new PersonMobile();
                    $person_mobile->mobile = $mobile[0];
                    $person_mobile->uid = $request->uid;
                    $person_mobile->status = 0;
                    $person_mobile->save();
                    $id = $person_mobile->id;
                    $response = ["message" => 'OK'];

                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            } else {
                $person_mobile = new PersonMobile();
                $person_mobile->mobile = $request->mobile;
                $person_mobile->uid = $request->uid;
                $person_mobile->status = 1;
                $person_mobile->save();
                $id = $person_mobile->id;
                if ($id > 0) {
                    $response = ["message" => 'OK'];
                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            }
        } else if ($request->mobile_type == '2') {

            $mobile = PersonMobile::where(['uid' => $request->uid, "status" => 2])->pluck('mobile')->toArray();
            if (!empty($mobile)) {
                $affectedRows = PersonMobile::where(["uid" => $request->uid, "status" => 2, "mobile" => $mobile[0]])->update(["mobile" => $request->mobile]);
                if ($affectedRows > 0) {

                    $person_mobile = new PersonMobile();
                    $person_mobile->mobile = $mobile[0];
                    $person_mobile->uid = $request->uid;
                    $person_mobile->status = 0;
                    $person_mobile->save();
                    $id = $person_mobile->id;
                    $response = ["message" => 'OK'];

                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            } else {
                $person_mobile = new PersonMobile();
                $person_mobile->mobile = $request->mobile;
                $person_mobile->uid = $request->uid;
                $person_mobile->status = 2;
                $person_mobile->save();
                $id = $person_mobile->id;
                if ($id > 0) {
                    $response = ["message" => 'OK'];
                    return response($response, 200);
                } else {
                    $response = ["message" => 'Update error'];
                    return response($response, 400);
                }
            }
            // $affectedRows = PersonMobile::where("uid", $request->uid)->update(["mobile" => $request->mobile]);
        }
    }

    public function make_primary(Request $request)
    {
        $uid = $request->uid;
        $primary = $request->primary;
        $other = $request->other;
        if ($uid && $primary && $other) {
            $affectedRows = User::where("uid", $request->uid)->update(["primary_mobile" => $other]);
            $affectedRows1 = PersonMobile::where("uid", $request->uid)->update(["mobile" => $primary]);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function make_email_primary(Request $request)
    {
        $uid = $request->uid;
        $email = $request->email;
        if ($uid && $email) {
            $affectedRows = User::where("uid", $request->uid)->update(["primary_email" => $email, "email_otp_verified" => 1]);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function make_email_primary_secondary(Request $request)
    {
        $uid = $request->uid;
        $primary = $request->primary_email;
        $other = $request->other_email;
        if ($uid && $primary && $other) {
            $affectedRows = User::where("uid", $request->uid)->update(["primary_email" => $other]);
            $affectedRows1 = PersonEmail::where("uid", $request->uid)->update(["email" => $primary]);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }

    public function make_email_secondary(Request $request)
    {
        $email = PersonEmail::where(['uid' => $request->uid, "status" => 2])->pluck('email')->toArray();
        if (!empty($email)) {
            $affectedRows = PersonEmail::where(["uid" => $request->uid, "status" => 2, "email" => $email[0]])->update(["email" => $request->email]);
            if ($affectedRows > 0) {

                $person_email = new PersonEmail();
                $person_email->email = $email[0];
                $person_email->uid = $request->uid;
                $person_email->status = 0;
                $person_email->save();
                $id = $person_email->id;

                $response = ["message" => 'OK'];
                return response($response, 200);
            } else {
                $response = ["message" => 'Update error'];
                return response($response, 400);
            }
        } else {
            $person_email = new PersonEmail();
            $person_email->email = $request->email;
            $person_email->uid = $request->uid;
            $person_email->status = 2;
            $person_email->save();
            $id = $person_email->id;
            if ($id > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            } else {
                $response = ["message" => 'Update error'];
                return response($response, 400);
            }
        }
    }

    public function temp_organisation_stage_one(Request $request)
    {
        $organisation_name = $request->organisation_name;
        $organisation_email = $request->organisation_email;
        $uid = $request->uid;
        $temp_email = TempOrganisationEmail::where(['email' => $organisation_email, "status" => 1])->pluck('email')->toArray();
        $email = OrganisationEmail::where(['email' => $organisation_email, "status" => 1])->pluck('email')->toArray();
        if (empty($temp_email)) {
            if (!empty($email)) {
                $response = ["message" => 'Organisation Email Already Exists'];
                return response($response, 400);
            } else {
                $temp_organisation = new TempOrganisation();
                $temp_organisation->uid = $uid;
                $temp_organisation->authorization = 1;
                $temp_organisation->status = 1;
                $temp_organisation->created_by = $uid;
                $temp_organisation->last_modified_by = $uid;
                $temp_organisation->temp_stage = 0;
                $temp_organisation->save();
                $id = $temp_organisation->id;

                if ($id > 0) {

                    $temp_organisation_email = new TempOrganisationEmail();
                    $temp_organisation_email->oid = $id;
                    $temp_organisation_email->uid = $uid;
                    $temp_organisation_email->email = $organisation_email;
                    $temp_organisation_email->email_verification = 1;
                    $temp_organisation_email->status = 1;
                    $temp_organisation_email->created_by = $uid;
                    $temp_organisation_email->last_modified_by = $uid;
                    $temp_organisation_email->save();

                    $affectedRows = TempOrganisation::where(["uid" => $request->uid, "status" => 1, "id" => $id])->update(["temp_stage" => 1]);

                    $temp_organisation_details = new TempOrganisation_details();
                    $temp_organisation_details->oid = $id;
                    $temp_organisation_details->uid = $request->uid;
                    $temp_organisation_details->organisation_name = $request->organisation_name;
                    $temp_organisation_details->created_by    = $request->uid;
                    $temp_organisation_details->last_modifed_by = $request->uid;

                    $temp_organisation_details->save();
                }

                $response = ["message" => 'OK', "param" => ["temp_stage" => 1, 'temp_id' => $id]];
                return response($response, 200);
            }
        } else {
            if (!empty($email)) {
                $response = ["message" => 'OK', "param" => $email, "stage" => "live"];
                return response($response, 200);
            } else {
                $temp_stage = TempOrganisation::where(['uid' => $uid, "status" => 1])->pluck('temp_stage')->toArray();
                $details = TempOrganisation::with('temp_mobile', 'temp_email', 'temp_details', 'temp_address', 'temp_identities', 'temp_web')->where("uid", $uid)->get();
                $result = $details->toArray();
                $response = ["message" => 'OK', "param" => ['email' => $temp_email, "stage" => "temp", 'temp_stage' => $temp_stage, 'result' => $result],];
                return response($response, 200);
            }
        }
    }


    public function temp_organisation_stage_two(Request $request)
    {
        $temp_organisation_address = new TempOrganisation_address();
        $temp_organisation_address->oid = $request->temp_id;
        $temp_organisation_address->uid = $request->uid;
        $temp_organisation_address->door_no = $request->door_no;
        $temp_organisation_address->bld_name = $request->building_name;
        $temp_organisation_address->street = $request->street;
        $temp_organisation_address->landmark = $request->landmark;
        $temp_organisation_address->pincode = $request->pincode;
        $temp_organisation_address->state = $request->state;
        $temp_organisation_address->city = $request->city;
        $temp_organisation_address->district = $request->district;
        $temp_organisation_address->area = $request->area;
        $temp_organisation_address->district = $request->district;
        $temp_organisation_address->district = $request->district;
        $temp_organisation_address->save();
        $id = $temp_organisation_address->id;

        if ($id > 0) {
            $affectedRows = TempOrganisation::where(["uid" => $request->uid, "status" => 1, "id" => $request->temp_id])->update(["temp_stage" => 2]);
            $response = ["message" => 'OK', 'param' => ["temp_stage" => 2, "temp_id" => $request->temp_id]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error', "temp_stage" => 1];
            return response($response, 400);
        }
    }


    public function temp_organisation_stage_three(Request $request)
    {
        $temp_organisation_admin = new TempOrganisationAdmin();
        $temp_organisation_admin->oid = $request->temp_id;
        $temp_organisation_admin->uid = $request->uid;
        $temp_organisation_admin->pid = 0;
        $temp_organisation_admin->administration_type_id = $request->organisation_admin;
        $temp_organisation_admin->administration_verification = 0;
        $temp_organisation_admin->status = 1;
        $temp_organisation_admin->created_by = $request->uid;
        $temp_organisation_admin->last_modified_by = $request->uid;
        $temp_organisation_admin->save();
        $id = $temp_organisation_admin->id;

        if ($id > 0) {
            $affectedRows = TempOrganisation::where(["uid" => $request->uid, "status" => 1, "id" => $request->temp_id])->update(["temp_stage" => 3]);
            $response = ["message" => 'OK', 'param' => ["temp_stage" => 3, "temp_id" => $request->temp_id]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error', "temp_stage" => 3];
            return response($response, 400);
        }
    }


    public function temp_organisation_stage_five(Request $request)
    {
        $details = TempOrganisation_details::where(['oid' => $request->temp_id])->pluck('organisation_name')->toArray();
        if (!empty($details)) {
            $affectedRows = TempOrganisation_details::where(["oid" => $request->temp_id])->update(["organisation_gst" => $request->gst, "organisation_pan" => $request->pan]);
            $affectedRows1 = TempOrganisation::where(["uid" => $request->uid, "status" => 1, "id" => $request->temp_id])->update(["temp_stage" => 5]);
            $response = ["message" => 'OK', 'param' => ["temp_stage" => 5, "temp_id" => $request->temp_id]];
            return response($response, 200);
        } else {
            $temp_organisation_details = new TempOrganisation_details();
            $temp_organisation_details->oid = $request->temp_id;
            $temp_organisation_details->uid = $request->uid;
            $temp_organisation_details->organisation_name = $request->organisation_name;
            $temp_organisation_details->organisation_gst = $request->gst;
            $temp_organisation_details->organisation_pan = $request->pan;
            $temp_organisation_details->created_by    = $request->uid;
            $temp_organisation_details->last_modifed_by = $request->uid;

            $temp_organisation_details->save();
            $id = $temp_organisation_details->id;

            if ($id > 0) {
                $affectedRows = TempOrganisation::where(["uid" => $request->uid, "status" => 1, "id" => $request->temp_id])->update(["temp_stage" => 5]);
                $response = ["message" => 'OK', 'param' => ["temp_stage" => 5, "temp_id" => $request->temp_id]];
                return response($response, 200);
            } else {
                $response = ["message" => 'Error', "temp_stage" => 3];
                return response($response, 400);
            }
        }
    }


    public function temp_organisation_stage_four(Request $request)
    {

        $affectedRows = TempOrganisation::where(["uid" => $request->uid, "status" => 1, "id" => $request->temp_id])->update(["temp_stage" => 6]);
        if ($affectedRows > 0) {
            $response = ["message" => 'OK', 'param' => ["temp_stage" => 6, "temp_id" => $request->temp_id]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error', "temp_stage" => 4];
            return response($response, 400);
        }
    }


    public function delete_other(Request $request)
    {

        $mobile = PersonMobile::where(['uid' => $request->uid, "status" => 2])->pluck('mobile')->toArray();
        if (!empty($mobile)) {
            $affectedRows = PersonMobile::where(["uid" => $request->uid, "status" => 2, "mobile" => $request->other])->update(["status" => 0]);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            } else {
                $response = ["message" => 'Update error'];
                return response($response, 400);
            }
        }
    }

    public function delete_other_email(Request $request)
    {
        $uid = $request->uid;
        $other = $request->other;
        if ($uid && $other) {
            // $affectedRows1 = PersonEmail::where("uid", $request->uid)->update(["previous_email" => $other]);

            // $person_email = new PersonEmail();
            // $person_email->email = $other;
            // $person_email->uid = $uid;
            // $person_email->status = 0;
            // $person_email->save();

            $affectedRows = PersonEmail::where(["uid" => $request->uid, "email" => $other])->update(["status" => 0]);
            if ($affectedRows > 0) {
                $response = ["message" => 'OK'];
                return response($response, 200);
            }
        } else {
            $response = ["message" => 'Parameter Missing'];
            return response($response, 400);
        }
    }


    public function submit_organisation(Request $request)
    {
        Log::info('Inside submit_organisation' . json_encode($request->all()));

        $organisation = new Organisation();
        $organisation->uid = $request->uid;
        $organisation->authorization = 1;
        $organisation->status = 1;
        $organisation->created_by = $request->uid;
        $organisation->last_modified_by = $request->uid;
        $organisation->db_name=$request->organisation_name;
        $organisation->save();
        $id = $organisation->id;

        Log::info('submit_organisation DB Id' . $id);
        $DbName = "Org_" . $id;
        Log::info('submit_organisation DB Name' . json_encode($DbName));
        $dbgenarate = $this->DBGenarate($DbName);
        Log::info('submit_organisation DB Result ' . json_encode($dbgenarate));
        Log::info('submit_organisation get DB Connections Result ' . json_encode(Config::get('database.connections')));
        Artisan::call('cache:clear');
        $ndb = DB::connection('mysql')->getDatabaseName();
        Log::info('submit_organisation DB User Result ' . json_encode($ndb));

        $userD = User::where('uid', $request->uid)->first();

        Log::info('submit_organisation DB User Result ' . json_encode($userD));

        if ($id > 0) {

            $organisation_details = new Organisation_details();
            $organisation_details->setConnection('mysql');
            $organisation_details->oid = $id;
            $organisation_details->uid = $request->uid;
            $organisation_details->organisation_name = $request->organisation_name;
            $organisation_details->status = 1;
            $organisation_details->organisation_gst = $request->organisation_gstin;
            $organisation_details->organisation_pan = $request->organisation_pan;
            $organisation_details->save();

            $organisation_address = new Organisation_address();

            $organisation_address->oid = $id;
            $organisation_address->uid = $request->uid;
            $organisation_address->door_no = $request->door_no;
            $organisation_address->bld_name = $request->building_name;
            $organisation_address->street = $request->street;
            $organisation_address->landmark = $request->landmark;
            $organisation_address->pincode = $request->pincode;
            $organisation_address->phone = $request->phone;
            $organisation_address->google_location = $request->google_location;
            $organisation_address->state = $request->state;
            $organisation_address->city = $request->city;
            $organisation_address->created_by = $request->uid;
            $organisation_address->last_modified_by = $request->uid;
            // $organisation_address->district = $request->district;
            $organisation_address->area = $request->area;
            $organisation_address->save();

            if ($request->email) {
                $organisation_email = new OrganisationEmail();
                $organisation_email->oid = $id;
                $organisation_email->uid = $request->uid;
                $organisation_email->email = $request->email;
                $organisation_email->email_verification = 1;
                $organisation_email->status = 1;
                $organisation_email->created_by = $request->uid;
                $organisation_email->last_modified_by = $request->uid;
                $organisation_email->save();
            }


            if ($request->phone_no) {
                $organisation_phone = new OrganisationPhone();
                $organisation_phone->oid = $id;
                $organisation_phone->uid = $request->phone;
                $organisation_phone->country_code = $request->country_code;
                $organisation_phone->std_code = $request->std_code;
                $organisation_phone->phone_no = $request->phone_no;
                $organisation_phone->status = 1;
                $organisation_phone->created_by = $request->uid;
                $organisation_phone->last_modified_by = $request->uid;
                $organisation_phone->save();
            }

            if ($request->organisation_website) {
                $organisation_webaddress = new OrganisationWebaddress();
                $organisation_webaddress->oid = $id;
                $organisation_webaddress->uid = $request->uid;
                $organisation_webaddress->web_address = $request->organisation_website;
                $organisation_webaddress->status = 1;
                $organisation_webaddress->created_by = $request->uid;
                $organisation_webaddress->last_modified_by = $request->uid;
                $organisation_webaddress->save();
            }

            if ($request->doc_type) {
                $organisation_identities = new OrganisationIdentities();
                $organisation_identities->oid = $id;
                $organisation_identities->uid = $request->uid;
                $organisation_identities->doc_type = $request->doc_type;
                $organisation_identities->doc_no = $request->doc_no;
                $organisation_identities->doc_validity = $request->doc_validity;
                $organisation_identities->attachment = $request->attachment;
                $organisation_identities->status = 1;
                $organisation_identities->created_by = $request->uid;
                $organisation_identities->last_modified_by = $request->uid;
                $organisation_identities->save();
            }

            if ($request->organisation_admin == 1) {
                $organisation_administation = new OrganisationAdmin();
                $organisation_administation->oid = $id;
                $organisation_administation->pid = 0;
                $organisation_administation->uid = $request->uid;
                $organisation_administation->administration_type_id = 1;
                $organisation_administation->administration_verification = 1;
                $organisation_administation->status = 1;
                $organisation_administation->created_by = $request->uid;
                $organisation_administation->last_modified_by = $request->uid;
                $organisation_administation->save();
            }

            //Setting Dynamic Connection//
            $path = config_path('database.php');
            //GET Database Connection file 
            $arr = include $path;
            // load the array from the file
            $db_name=$request->organisation_name;
            $new_connection = [
                'driver'    => 'mysql',
                'host'      => env('DB_HOST'),
                'database'  => $db_name,
                'username'  => env('COMMON_USERNAME'),
                'password'  => env('COMMON_PASS'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict' => false
            ];
            // modify the array
            $arr['connections'][$db_name] = $new_connection;
            // write it back to the file
            file_put_contents($path, "<?php  return " . var_export($arr, true) . ";");
            //Setting Dynamic Env//
            $path = base_path('.env');
            $new_env = "
          DB_CONNECTION_$db_name=mysql
          DB_HOST_$db_name=127.0.0.1
          DB_PORT_$db_name=3306
          DB_DATABASE_$db_name=$db_name,
          DB_USERNAME_$db_name=" . env('COMMON_USERNAME') . "
          DB_PASSWORD_$db_name=" . env('COMMON_PASS') . "
          REPLACE_DB_HERE";
            if (file_exists($path)) {
                file_put_contents($path, str_replace('REPLACE_DB_HERE', $new_env, file_get_contents($path)));
            }

            //Creating Dynamic DB//
            $preDatabase = Config::get('database.connections.mysql.database');
            DB::statement("CREATE DATABASE IF NOT EXISTS $db_name");
            $new = Config::set('database.connections.mysql.database', $db_name);
            DB::purge('mysql');
            DB::reconnect('mysql');
            $database_path = database_path();
            \Artisan::call('migrate', ['--path' => $database_path . '/migrations/organization/db', '--force' => true]);
            Config::set('database.connections.mysql.database', $preDatabase);
            return true;

            $response = ["message" => 'OK'];
            return response($response, 200);
        } else {
            $response = ["message" => 'Insert error'];
            return response($response, 400);
        }
    }
    public function DBGenarate($DbName)
    {
        Log::info('Inside DBGenerate' . json_encode($DbName));

        $preDatabase = Config::get('database.connections.mysql.database');
        Log::info('Inside DBGenerate main DB NAme ' . json_encode($preDatabase));
        DB::statement("CREATE DATABASE IF NOT EXISTS $DbName");

        $new = Config::set('database.connections.mysql.database', $DbName);
        Log::info('Inside DBGenerate New DB NAme ' . json_encode($new));
        DB::purge('mysql');
        DB::reconnect('mysql');
        \Artisan::call('migrate');
        DB::disconnect('mysql');
        Config::set('database.connections.mysql.database', $preDatabase);
        Config::set('database.connections.mysql2.database', $DbName);
        Artisan::call('cache:clear');
        Log::info('Inside DbGenerate Return');
        return true;
    }

    //Dynamic DB Divakar//

    public function GenerateDB(Request $request)
    {

        $db_name = $_GET['db_name'];

        //Setting Dynamic Connection//
        $path = config_path('database.php');
        //GET Database Connection file 
        $arr = include $path;
        // load the array from the file
        $new_connection = [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST'),
            'database'  => $db_name,
            'username'  => env('COMMON_USERNAME'),
            'password'  => env('COMMON_PASS'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict' => false
        ];
        // modify the array
        $arr['connections'][$db_name] = $new_connection;
        // write it back to the file
        file_put_contents($path, "<?php  return " . var_export($arr, true) . ";");
        //Setting Dynamic Env//
        $path = base_path('.env');
        $new_env = "
        DB_CONNECTION_$db_name=mysql
        DB_HOST_$db_name=127.0.0.1
        DB_PORT_$db_name=3306
        DB_DATABASE_$db_name=$db_name,
        DB_USERNAME_$db_name=" . env('COMMON_USERNAME') . "
        DB_PASSWORD_$db_name=" . env('COMMON_PASS') . "

        REPLACE_DB_HERE
        ";
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'REPLACE_DB_HERE',
                $new_env,
                file_get_contents($path)
            ));
        }

        //Creating Dynamic DB//

        $preDatabase = Config::get('database.connections.mysql.database');
        DB::statement("CREATE DATABASE IF NOT EXISTS $db_name");

        $new = Config::set('database.connections.mysql.database', $db_name);
        DB::purge('mysql');
        DB::reconnect('mysql');
        $database_path = database_path();
        \Artisan::call('migrate', ['--path' => $database_path . '/migrations/organization/db', '--force' => true]);

        Config::set('database.connections.mysql.database', $preDatabase);

        //Test Return//
        return dd('create database and user data');
    }

    public function GetGSTDetails()
    {
        $gst = $_GET['gst'];
        //LIVE URL:https://kyc-api.aadhaarkyc.io/api/v1/corporate/gstin
        //SAND BOX:https://sandbox.aadhaarkyc.io/api/v1/corporate/gstin
        $response = $this->get_web_page("https://kyc-api.aadhaarkyc.io/api/v1/corporate/gstin", $gst);
        $resArr = array();
        $resArr = json_decode($response);
        echo "<pre>";
        print_r($resArr);
        echo "</pre>";
    }

    function get_web_page($url, $gst)
    {
        $raw = '{
            "id_number": "30AAACR5055K1ZK",
            "filing_status_get": true
        }';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $raw);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer application/json'));
        $result = curl_exec($ch);

        return $result;
    }





    public function get_account_details(Request $request)
    {
        $family_name = PersonDetails::where('uid', $request->uid)->first('family_name');
        $first_name = PersonDetails::where('uid',  $request->uid)->first('first_name');
        $mobile = PersonMobile::where('uid',  $request->uid)->first('mobile');
        DB::table('temp_users')->where('mobile', $mobile->mobile)->delete();
        if (!isset($family_name) && !isset($first_name)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['family_name' => $family_name, 'first_name' => $first_name, 'mobile' => $mobile]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error in Finding Account Details'];
            return response($response, 400);
        }
    }

    public function get_states(Request $request)
    {
        $states = State::where('country_id', 101)->get();
        if (!empty($result) && !empty($states)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['states' => $states]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Error in getting States'];
            return response($response, 400);
        }
    }





    public function get_email(Request $request)
    {
        $person_email = PersonEmail::where('uid', $request->uid)->first('email');
        if (!empty($person_email)) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ['email' => $person_email]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Email Not Found'];
            return response($response, 400);
        }
    }


    public function update_otp(Request $request)
    {
        $affectedRows = User::where("uid", $request->uid)->update(["email_otp" => $request->otp, "email_otp_verified" => 0]);
        if ($affectedRows) {
            $response = ["message" => 'OK', 'route' => '', 'param' => ["email_otp" => $request->otp, "email_otp_verified" => 0]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Update Error!!!'];
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
