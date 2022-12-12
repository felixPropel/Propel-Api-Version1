<?php

namespace App\Http\Controllers\version1\Repositories\Person;

use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use Illuminate\Support\Facades\DB;

class PersonRepository implements PersonInterface
{
    public function findUserDataByMobileNumber($mobileNumber)
    {
        return User::where('primary_mobile', $mobileNumber)->first();
    }
    public function findUserDataByEmail($email)
    {
        return User::where('primary_email', $email)->first();
    }
    public function storePerson($personModel, $personDetailModel, $personEmailModel, $personMobileModel)
    {


        try {
            $result = DB::transaction(function () use ($personModel, $personDetailModel, $personEmailModel, $personMobileModel) {



                $personModel->save();
                $personDetailModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                $personMobileModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                $personEmailModel->ParentPerson()->associate($personModel, 'uid', 'uid');

                $personDetailModel->save();
                $personMobileModel->save();
                $personEmailModel->save();
                return [
                    'message' => "Success",
                    'data' => "Added Successfully."
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
