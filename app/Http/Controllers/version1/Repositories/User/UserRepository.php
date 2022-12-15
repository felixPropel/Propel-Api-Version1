<?php

namespace App\Http\Controllers\version1\Repositories\User;

use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface
{
    public function findUserDataByMobileNumber($mobileNumber)
    {
        return User::where('primary_mobile', $mobileNumber)->first();
    }
    public function findUserDataByEmail($email)
    {
        return User::where('primary_email', $email)->first();
    }
    public function findUserDataByUid($uId)
    {
        return User::where('uid', $uId)->first();
    }
    public Function storeUser($model){
        try {
            $result = DB::transaction(function () use ($model) {

                $model->save();              
                return [
                    'message' => "Success",
                    'data' =>$model
                ];
            });

            return $result;
        } catch (\Exception $e) {


            return [

                'message' => "failed",
                'data' => $e
            ];
        }
    }
}
