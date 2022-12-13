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

    public function checkPersonByMobile($mobileNumber)
    {
        return Person::leftjoin('person_mobiles', 'person_mobiles.uid', '=', 'persons.uid')
            ->where('person_mobiles.mobile_no', $mobileNumber)
            ->first();
    }
    public function storeTempPerson($model)
    {
        
        try {
            $result = DB::transaction(function () use ($model) {

                $model->save();
                return [
                    'message' => "Success",
                    'data' => $model
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
                    'data' => $personModel
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
    public function getPersonPrimaryDataByUid($uid)
    {
        return Person::select('*')->leftjoin('person_mobiles', 'person_mobiles.uid', '=', 'persons.uid')
            ->leftjoin('person_emails', 'person_emails.uid', '=', 'persons.uid')
            ->where('person_mobiles.mobile_cachet', 1)
            ->where('person_emails.email_cachet', 1)
            ->where('persons.uid', $uid)
            ->first();
    }
}
