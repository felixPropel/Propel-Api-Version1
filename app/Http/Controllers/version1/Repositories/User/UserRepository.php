<?php

namespace App\Http\Controllers\version1\Repositories\User;

use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface
{

    public function findUserByMobileNo($mobileNo)
    {
      
       return User::with('personDetails')->where('primary_mobile', $mobileNo)->first();
  

    }

   
    public function findUserDataByEmail($email)
    {
        return User::where('primary_email', $email)->first();
    }
    public function findUserDataByUid($uId)
    {
        return User::where('uid', $uId)->first();
    }
    public function storeUser($model)
    {
        try {
            $result = DB::transaction(function () use ($model) {

                $model->save();
                return [
                    'message' => "Success",
                    'data' => $model,
                ];
            });

            return $result;
        } catch (\Exception $e) {

            return [

                'message' => "failed",
                'data' => $e,
            ];
        }
    }
    public function savedUser($model)
    {
        return $model->save();
    }
    public function verifyUserForMobile($datas)
    {
        return  User::where('primary_email', $datas->userName)
        ->orWhere('primary_mobile', $datas->userName)
        ->first();

    }
}
