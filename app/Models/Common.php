<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TempUsers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Common extends Model
{
    use HasFactory;

    public function check_temp_user_mobile($mobile)
    {
        $user = DB::table('temp_users')
            ->where('mobile', '=', $mobile)               
            ->where('stage', '!=', '3')
            ->first();
        if ($user === null) {
            // user doesn't exist
            $array = array(
                'stage' => 0,
                'mobile' => 0,
            );
            log::info('ModelCommon > array ' .json_encode($array));
            return $array;
            
        } else {
            $stage = DB::table('temp_users')->where('mobile', $mobile)->pluck('stage')->first();
            log::info('ModelCommon > stage ' .json_encode($stage));
            $mobile = DB::table('temp_users')->where('mobile', $mobile)->pluck('mobile')->first();
            log::info('ModelCommon > Mobile ' .json_encode($mobile));

            $array = array(
                'stage' => $stage,
                'mobile' => $mobile,
            );
            return $array;
        }
    }

    public function check_users_mobile($mobile)
    {
        $user_mobile = DB::table('person_mobile')
            ->where('mobile', '=', $mobile)
            ->where('status', '!=', '0')
            ->first();
        if ($user_mobile) {
            return 1;
        } else {
            return 0;
        }
    }

    public function check_primary_user_mobile($mobile)
    {
        $user_mobile = DB::table('users')
            ->where('primary_mobile', '=', $mobile)
            ->first();
        if ($user_mobile) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_uuid_by_mobile($mobile)
    {
        $uuid = DB::table('users')
            ->where('primary_mobile', '=', $mobile)
            ->first();
        if ($uuid) {
            return $uuid->uid;
        } else {
            return 0;
        }
    }

    public function get_person_uuid_by_mobile($mobile)
    {
        $uuid = DB::table('person_mobile')
            ->where('mobile', '=', $mobile)
            ->first();
        if ($uuid) {
            return $uuid->mobile;
        } else {
            return 0;
        }
    }

    public function get_temp_mobile($ip)
    {
        $mobile = DB::table('temp_users')
            ->where('ip_address', $ip)
            ->where('stage', '!=', "3")
            ->pluck('mobile')->first();
        return $mobile;
    }

    public function get_temp_email($ip)
    {
        $email = DB::table('temp_users')
            ->where('ip_address', $ip)
            ->where('stage', 2)
            ->pluck('email')->first();
        return $email;
    }

    public function get_temp_email_by_mobile($mobile)
    {
        $email = DB::table('temp_users')
            ->where('mobile', $mobile)
            ->where('stage', 2)
            ->pluck('email')->first();
        return $email;
    }

    public function get_person_email($uuid)
    {
        $email = DB::table('person_email')
            ->where('uid', $uuid)
            ->where('status', 1)
            ->pluck('email')->first();
        return $email;
    }

    public function update_temp_user($mobile, $email)
    {
        $update = DB::table('temp_users')
            ->where('mobile', $mobile)
            //  ->where('stage', '1')
            //  ->orWhere('stage','2')
            ->update(['email' => $email, 'stage' => "2"]);
        return $update;
    }
    public function getUserName($uuid)
    {
        $name=DB::table('person_details')->where('uid',$uuid)->pluck('first_name')->first();
        return $name;
    }
}
