<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Common;
use App\Models\TempUsers;
use App\Models\Person;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\PersonDetails;
use App\Models\PersonAddress;
use App\Models\BasicModels\Salutation;
use App\Models\BasicModels\BloodGroup;
use App\Models\BasicModels\Gender;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Exception;

class WizardController extends Controller
{
    // public function __construct() { 
    //     $this->middleware('preventBackHistory'); 
    //     $this->middleware('auth'); 
    // }

    function temp_stage1(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
        ]);
        $stage = Common::check_temp_user_mobile($request['mobile']);
        $person_mobile = Common::check_users_mobile($request['mobile']);
        $user_mobile = Common::check_primary_user_mobile($request['mobile']);
       
        if ($person_mobile != 0 && $user_mobile != 0) {
            $uuid = Common::get_uuid_by_mobile($request['mobile']);
            if ($stage['stage'] === 0 && $uuid === 0) {
                $session_array = array(
                    'ip_address' => $request->ip(),
                    'stage' => 1,
                    'mobile' => $request['mobile'],
                );
                Session::put('reg', $session_array);

                $temp_user = new TempUsers();

                $temp_user->mobile = $request['mobile'];
                $temp_user->ip_address = $request->ip();
                $temp_user->stage = 1;
                $temp_user->save();
                if ($temp_user->id > 0) {
                    return redirect()->route('stage2', ['mobile' => $request['mobile']]);
                } else {
                    return redirect()->back()->withErrors(['mobile' => 'Something Went Wrong']);
                }
            } else if ($uuid) {
                return redirect()->route('/login', ['m' => $request['mobile']]);
            } else if ($stage['stage'] == '1') {
                return redirect()->route('stage2', ['mobile' => $request['mobile']]);
            } else if ($stage['stage'] == '2') {
                return redirect()->route('stage3');
            } else if ($stage['stage'] == '3') {
                return redirect()->route('registration');
            }
        } else {
            $uuid = Common::get_person_uuid_by_mobile($request['mobile']);
           
            if ($uuid) {          
                $email = Common::get_person_email($uuid);
                if ($email) {
                    return redirect()->route('person_confirmation', ['uid' => $uuid]);
                } else {
                    return redirect()->route('person_email', ['uid' => $uuid]);
                }
            } else {
                $uuid = Common::get_uuid_by_mobile($request['mobile']);
              
                if ($stage['stage'] === 0 && $uuid === 0) {
                    
                    $session_array = array(
                        'ip_address' => $request->ip(),
                        'stage' => 1,
                        'mobile' => $request['mobile'],
                    );
                    Session::put('reg', $session_array);

                    $temp_user = new TempUsers();

                    $temp_user->mobile = $request['mobile'];
                    $temp_user->ip_address = $request->ip();
                    $temp_user->stage = 1;
                    $temp_user->save();
                    if ($temp_user->id > 0) {
                        return redirect()->route('stage2', ['mobile' => $request['mobile']]);
                    } else {
                        return redirect()->back()->withErrors(['mobile' => 'Something Went Wrong']);
                    }
                } else if ($uuid) {
                    return redirect()->route('/login', ['m' => $request['mobile']]);
                } else if ($stage['stage'] == '1') {
                    return redirect()->route('stage2', ['mobile' => $request['mobile']]);
                } else if ($stage['stage'] == '2') {
                    return redirect()->route('stage3');
                } else if ($stage['stage'] == '3') {
                    return redirect()->route('registration');
                }
            }
        }
    }

    function person_email(Request $request)
    {
        $uid = $request->uid;
        return view("wizard.person_email_page", ['uid' => $uid]);
    }

    function person_confirmation($uid)
    {
        return view("wizard.person_confirmation", ['uid' => $uid]);
    }

    function update_email(Request $request)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
            ]);
            $person_email = new PersonEmail();
            $person_email->uid = $request['uid'];
            $person_email->email = $request['email'];
            $person_email->save();
            $id = $person_email->id;
            if ($id) {
                return view("wizard.person_confirmation", ['uid' => $request['uid']]);
            } else {
                return redirect()->back()->withErrors(['email' => ['Inappropriate Submisssion']]);
            }
        } else {
            return redirect()->back()->withErrors(['email' => ['Inappropriate Submisssion']]);
        }
    }

    public function person_otp(Request $request)
    {
        $mobile = PersonMobile::where('uid', $request['uid'])->first();
        return view("wizard.person_registration_otp", ['uid' => $request['uid'], 'mobile' => $mobile]);
    }

    public function person_details_update(Request $request)
    {
        $uid = $request->uid;
        return view("wizard.person_password", ['uid' => $uid]);
    }

    public function update_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
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
                DB::table('temp_users')->where('mobile', $mobile->mobile)->delete();
            }
            $details = PersonDetails::with('email', 'mobile', 'person', 'person_address',)->get();
            $result = $details->toArray();
            // echo "<pre>";
            // print_r($result);
            // die();
            return view("wizard.edit_profile", ['uid' => $request['uid'], 'result' => $result]);
        } else {
            return view("wizard.person_password", ['uid' => $request['uid']]);
        }
    }

    function temp_stage2($mobile)
    {
        return view("wizard.email_page", ['mobile' => $mobile]);
    }

    function temp_stage3(Request $request)
    {
        $ip_address = $request->ip();
        $email = Common::get_temp_email($ip_address);
        if ($email) {
            $mobile = Common::get_temp_mobile($ip_address);
            return view("wizard.confirmation", ['email' => $email, 'mobile' => $mobile]);
        } else {
            $this->userservice->temp_stage2();
        }
    }


    function temp_stage_3(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
            ]);
            $update = Common::update_temp_user($request['mobile'], $request['email']);
            if ($update) {
                return view("wizard.confirmation", ['email' => $request['email'], 'mobile' => $request['mobile']]);
            } else {
                return redirect()->route('stage2', ['mobile' => $request['mobile']])->withErrors(['email' => ['This Email Already Exists,Try New One']]);
            }
        } else {
            return redirect()->back()->withErrors(['email' => ['Inappropriate Submisssion']]);
        }
    }




    function check(Request $request)
    {
        //validation
        $request->validate([
            'username' => [
                'required', function ($attribute, $value, $fail) {
                    if (!(DB::table('users')->where('primary_mobile', $value)->exists() || DB::table('users')->where('primary_email', $value)->exists())) {
                        return $fail("The provided $attribute is not valid.");
                    }
                }
            ],
            'password' => 'required|min:5|max:30',
        ]);

        if ($this->attemptLogin($request)) {
            return $this->successfulLogin($request);
        }
        return $this->failedLogin($request);
    }

    protected function attemptLogin(Request $request)
    {
        //Try with email AND username fields
        if (
            Auth::guard('web')->attempt([
                'primary_mobile' => $request['username'],
                'password' => $request['password']
            ], $request->has('remember'))
            || Auth::guard('web')->attempt([
                'primary_email' => $request['username'],
                'password' => $request['password']
            ], $request->has('remember'))
        ) {
            return true;
        }
        return false;
    }

    protected function successfulLogin(Request $request)
    {
        return redirect()->route('/dashboard');
    }

    protected function failedLogin(Request $request)
    {
        return redirect()->back()->withErrors(['password' => 'Incorrect password']);
    }
    public function create_user(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|exists:users,email',
            'mobile' => 'required|exists:users,mobile',
        ], [
            'email.exists' => 'Email Already Registered',
            'mobile.exists' => 'Mobile Already Registered'
        ]);
    }

    public function registration(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request['email'];
            $mobile = $request['mobile'];
            return view("wizard.registration", ['email' => $email, 'mobile' => $mobile]);
        } else {
            return redirect()->back()->withErrors(['error' => ['Inappropriate Submisssion']]);
        }
    }

    public function confirmation(Request $request)
    {
        if ($request->isMethod('post')) {
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
                return view("wizard.registration_account", ['uid' => $uid, 'saluations' => $saluations]);
            } else {
                return redirect()->back()->withErrors(['mobile' => 'Registration failed']);
            }
        } else {
            return redirect()->back()->withErrors(['email' => ['Inappropriate Submisssion']]);
        }
    }


    public function basic_details(Request $request)
    {
        if ($request->isMethod('post')) {
            $person_details = new PersonDetails();
            $person_details->saluation = $request['saluation'];
            $person_details->first_name = $request['first_name'];
            $person_details->last_name = $request['last_name'];
            $person_details->nick_name = $request['nick_name'];
            $person_details->uid = $request['uid'];
            $person_details->save();
            $detais_id = $person_details->id;
            if ($detais_id > 0) {
                $gender = Gender::all();
                $blood = BloodGroup::all();
                return view("wizard.registration_basic", ['gender' => $gender, 'blood' => $blood, 'uid' => $request['uid']]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['Inappropriate Submisssion']]);
        }
    }


    public function basic_details1(Request $request)
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
                return view("wizard.registration_otp", ['uid' => $request['uid'], 'mobile' => $mobile]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['Inappropriate Submisssion']]);
        }
    }

    public function basic_details2(Request $request)
    {
        $uid = $request->uid;
        return view("wizard.registration_password", ['uid' => $uid]);
    }

    public function form_submit(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
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
                //DB::table('temp_users')->where('mobile', $mobile->mobile)->delete();
            }

            return view("wizard.profile", ['uid' => $request['uid']]);
        } else {
            return view("wizard.registration_password", ['uid' => $request['uid']]);
        }
    }

    public function upload_pic(Request $request)
    {
        if ($request->hasfile('profilePhoto')) {
            $this->validate($request, [
                'profilePhoto' => 'required',
                'profilePhoto.*' => 'mimetypes:image/jpg'
            ]);
            $image = $request->file('profilePhoto');
            $extension = strtolower($image->getClientOriginalExtension());
            $uniqueName = md5($image . time());
            $uploadSuccess = $image->move(base_path()."/public/assets/profile/", $uniqueName . '.' . $extension);
            if ($uploadSuccess) {
                $file =  url('/').'/assets/profile/'.$uniqueName . '.' . $extension;
                $person_details = new PersonDetails();
                $person_details->profile_pic = $file;
                $affectedRows = PersonDetails::where("uid", $request['uid'])->update(["profile_pic" => $file]);
                if ($affectedRows > 0) {
                    return redirect()->route('edit_profile', ['uid' => $request['uid']]);
                }
            }
        } else {
            print_r("dsa");
            // return redirect()->route('edit_profile', ['uid' => $request['uid']]);
        }
    }

    public function edit_profile($uid)
    {
       
        $details = PersonDetails::with('email', 'mobile', 'person')->where("uid", $uid)->get();
        
        $result = $details->toArray();
        return view("wizard.profile_update", ['uid' => $uid, 'result' => $result]);
    }

    public function complete_profile(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required',
                'mobile' => 'required',
                'email' => 'required',
            ]);
            if ($request->hasfile('profilePhoto')) {
                $this->validate($request, [
                    'profilePhoto' => 'required',
                    'profilePhoto.*' => 'mimetypes:image/jpg'
                ]);
                $image = $request->file('profilePhoto');
                $extension = strtolower($image->getClientOriginalExtension());
                $uniqueName = md5($image . time());
                $uploadSuccess = $image->move(storage_path("app/upload"), $uniqueName . '.' . $extension);
                if ($uploadSuccess) {
                    $file = storage_path("app/upload") . '/' . $uniqueName . '.' . $extension;
                    $person_details = new PersonDetails();
                    $person_details->profile_pic = $file;
                    $affectedRows1 = PersonDetails::where("uid", $request['uid'])->update(["profile_pic" => $file]);
                }
            }
            $affectedRows2 = PersonDetails::where("uid", $request['uid'])->update(["first_name" => $request->name, "dob" => $request->dob, "family_name" => $request->family_name]);
            $affectedRows3 = PersonEmail::where("uid", $request['uid'])->update(["email" => $request->email]);
            $affectedRows4 = PersonMobile::where("uid", $request['uid'])->update(["mobile" => $request->mobile]);
            if ($affectedRows2 > 0) {
                   DB::table('person_address')->where('uid', $request['uid'])->delete();
                if ($request->home_address) {
                    $person_address = new PersonAddress();
                    $person_address->uid = $request['uid'];
                    $person_address->address_type=1;
                    $person_address->address = $request->home_address;
                    $person_address->status = 1;
                    $person_address->save();
                }

                if ($request->office_address) {
                    $person_address = new PersonAddress();
                    $person_address->uid = $request['uid'];
                    $person_address->address_type=2;
                    $person_address->address = $request->office_address;
                    $person_address->status = 1;
                    $person_address->save();
                }

                return redirect()->route('account', ['uid' => $request['uid']]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['Inappropriate Submisssion']]);
        }
    }

    function account($uid)
    {
        $family_name = PersonDetails::where('uid', $uid)->first('family_name');
        $first_name = PersonDetails::where('uid', $uid)->first('first_name');
        $mobile = PersonMobile::where('uid', $uid)->first('mobile');
        DB::table('temp_users')->where('mobile', $mobile->mobile)->delete();
        return view("wizard.choose_account", ['uid' => $uid, 'family_name' => $family_name, 'first_name' => $first_name, 'mobile' => $mobile]);
    }

    function forgot_password(Request $request)
    {
        $uid = PersonMobile::where('mobile', $request->mobile)->first('uid');
        $uuid = $uid->toArray();
        $person_email = PersonEmail::where('uid', $uuid['uid'])->first('email');
        $email = $person_email->toArray();
        $otp = substr(str_shuffle("0123456789"), 0, 5);
        $mail_email = $email['email'];

        $affectedRows = User::where("uid", $uuid['uid'])->update(["email_otp" => $otp, "email_otp_verified" => 0]);

        $template_data = ['email' => $email, 'otp' => $otp];
        //             print_r($template_data);
        // die();
        //send verification code
        Mail::send(
            ['html' => 'email.email_otp'],
            $template_data,
            function ($message) use ($mail_email) {
                $message->to("dhivakarmm@gmail.com")
                    ->from('propelsoft@gmail.com', 'Email OTP')
                    ->subject('Password Reset');
            }
        );

        return view("wizard.email_otp", ['uid' => $uuid['uid'], 'email' => $email['email'], 'error' => '', 'success' => '']);
    }

    public function validate_otp(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'otp' => 'required',
            ]);
            $db_user = User::where('uid', $request['uid'])->first();
            $otp = $db_user->toArray();
            $db_otp = $otp['email_otp'];
            if ($db_otp == $request['otp']) {
                return redirect()->route('reset_password', ['uid' => $request['uid']]);
            } else {
                return view("wizard.email_otp", ['uid' => $request['uid'], 'email' => $request['email'], 'error' => 'OTP NOT VERIFIED', 'success' => '']);
            }
            //return view("wizard.profile", ['uid' => $request['uid']]);
        }
    }

    function reset_password($uid)
    {
        return view("wizard.reset_password", ['uid' => $uid]);
    }

    function set_pasword(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            $password = Hash::make($request['password']);
            $affectedRows = User::where("uid", $request['uid'])->update(["password" => $password]);
            if ($affectedRows > 0) {
                $mobile = PersonMobile::where('uid', $request['uid'])->first();
                return redirect()->route('/login')->withErrors(["success" => 'Password updated successfully']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['Inappropriate Submisssion']]);
        }
    }

    public function resend_email_otp(Request $request)
    {
        $uid = $request->uid;
        $email = $request->email;
        $person_email = PersonEmail::where('uid', $uid)->first('email');
        $email = $person_email->toArray();
        $otp = substr(str_shuffle("0123456789"), 0, 5);
        $mail_email = $email['email'];
        $affectedRows = User::where("uid", $uid)->update(["email_otp" => $otp, "email_otp_verified" => 0]);
        $template_data = ['email' => $email, 'otp' => $otp];
        //send verification code
        Mail::send(
            ['html' => 'email.email_otp'],
            $template_data,
            function ($message) use ($mail_email) {
                $message->to("dhivakarmm@gmail.com")
                    ->from('propelsoft@gmail.com', 'Email OTP')
                    ->subject('Password Reset');
            }
        );
        return view("wizard.email_otp", ['uid' => $uid, 'email' => $mail_email, 'error' => '', 'success' => 'OTP SEND SUCCESSFULLY']);
    }

    function logout()
    {
        // Auth::guard('web')->logout();
        // Auth::guard('auth')->logout();
        // Auth::logout();
        // return redirect('/');
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }
}
