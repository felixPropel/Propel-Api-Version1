<?php

namespace App\Http\Controllers\version1\Repositories\Person;

use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Models\Category;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\TempPerson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PersonLanguage;
use App\Models\personAnniversary;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class PersonRepository implements PersonInterface
{
    public function __construct()
    {
        $orgDB = Session::get('orgDb');
        Config::set('database.connections.mysql_external.database', $orgDB);
    }
    public function checkPersonByMobile($mobileNumber)
    {
        return Person::leftjoin('person_mobiles', 'person_mobiles.uid', '=', 'persons.uid')
            ->where('person_mobiles.mobile_no', $mobileNumber)
            ->first();
    }
    public function findTempPersonById($id)
    {

        return TempPerson::findOrFail($id);
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
    public function storePerson($allModels)
    {
        try {

            $result = DB::transaction(function () use ($allModels) {

                $personModel = $allModels['personModel'];
                $personDetailModel = $allModels['personDetailModel'];
                $personEmailModel = $allModels['personEmailModel'];
                $personMobileModel = $allModels['personMobileModel'];
                $personAnotherEmailModel=$allModels['personAnotherEmailModel'];
                $personAnotherMobileModel=$allModels['personAnotherMobileModel'];
                $personWebLinkModel=$allModels['personWebLink'];
                $personOtherLanguage=$allModels['personOtherLanguage'];
                $personIdDocument=$allModels['personIdDocument'];
              
                $personModel->save();
                $personDetailModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                $personMobileModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                $personEmailModel->ParentPerson()->associate($personModel, 'uid', 'uid');

                $personDetailModel->save();
                $personMobileModel->save();
                $personEmailModel->save();

                for($i=0;$i<count($personAnotherEmailModel);$i++){
                    $personAnotherEmailModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personAnotherEmailModel[$i]->save();
                }   
                for($i=0;$i<count($personAnotherMobileModel);$i++){
                    $personAnotherMobileModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personAnotherMobileModel[$i]->save();
                }  
                for($i=0;$i<count($personWebLinkModel);$i++){
                    $personWebLinkModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personWebLinkModel[$i]->save();
                }  
                for($i=0;$i<count($personOtherLanguage);$i++){
                    $personOtherLanguage[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personOtherLanguage[$i]->save();
                } 
                for($i=0;$i<count($personIdDocument);$i++){
                    $personIdDocument[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personIdDocument[$i]->save();
                } 

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

    public function checkPersonEmailByUid($email, $uid)
    {
        return PersonEmail::where(['uid' => $uid, 'email' => $email])->first();
    }
    public function getOtpByUid($uid)
    {
        return PersonMobile::where('uid', $uid)->first();
    }
    public function emailOtpValidation($uid)
    {

        return PersonEmail::where('uid', $uid)->first();
    }
    public function getPersonEmailByUid($uid)
    {

        return PersonEmail::where('uid', $uid)->first();
    }
    public function getPersonDatasByUid($uid)
    {
        return PersonDetails::where('uid', $uid)->first();
    }
    public function savePersonDatas($model)
    {

        return $model->save();
    }
    public function savePerson($model)
    {

        return $model->save();
    }
    public function getMobileNumberByUid($uid)
    {
        return  PersonMobile::where('uid', $uid)->first();
    }
    public function getEmailByUid($uid)
    {
        return PersonEmail::where('uid', $uid)->first();
    }
    public function getPersonPrimaryDataByUid($uid)
    {

        return Person::select('*')->leftjoin('person_mobiles', 'person_mobiles.uid', '=', 'persons.uid')
            ->leftjoin('person_emails', 'person_emails.uid', '=', 'persons.uid')
            ->leftjoin('person_details', 'person_details.uid', '=', 'persons.uid')
            ->where('person_mobiles.mobile_cachet', 1)
            ->where('person_emails.email_cachet', 1)
            ->where('persons.uid', $uid)
            ->first();
    }

    public function getAnniversaryDate($uid)
    {
        return personAnniversary::where('uid', $uid)->first();
    }
    public function saveAnniversaryDate($model)
    {
        return $model->save();
    }
    public function motherTongueByUid($uid)
    {
        return PersonLanguage::where('uid', $uid)->first();
    }
    public function updateMotherTongue($model)
    {
        return $model->save();
    }
    public function saveOtherMobileByUid($model)
    {
        if (isset($model)) {
            return $model->save();
        }
    }
    public function saveOtherEmailByUid($model)
    {
        if (isset($model)) {
            return $model->save();
        }
    }
    public function saveOtherLanguageByUid($model)
    {
        if (isset($model)) {
            return $model->save();
        }
    }
    public function addWebLink($model)
    {
        if (isset($model)) {
            return $model->save();
        }
    }
    public function findExactPersonWithEmailAndMobile($email, $mobile)
    {
        Log::info('PersonRepository>findExactPersonWithEmailAndMobile Function>Inside.');

        $model =  Person::select('*')
            ->leftjoin('person_mobiles', 'person_mobiles.uid', 'persons.uid')
            ->leftjoin('person_emails', 'person_emails.uid', 'persons.uid')
            ->where('person_mobiles.mobile_no', $mobile)
            ->Where('person_emails.email', $email)
            ->whereIn('person_mobiles.mobile_cachet', [1, 2])
            ->whereIn('person_emails.email_cachet', [1, 2])
            ->first();

        Log::info('PersonRepository>findExactPersonWithEmailAndMobile Function>Return . ' . json_encode($model));
        return $model;
    }
    public function getDetailedAllPersonDataWithEmailAndMobile($email, $mobile)
    {
        $models = Person::select('persons.id as personId', 'person_emails.email As emailId', 'person_mobiles.mobile_no as mobileId')
            ->leftjoin('person_mobiles', 'person_mobiles.uid', 'persons.uid')
            ->leftjoin('person_emails', 'person_emails.uid', 'persons.uid')
            ->where('person_mobiles.mobile_no', $mobile)
            ->OrWhere('person_emails.email', $email)
            ->whereIn('person_mobiles.mobile_cachet', [1, 2])
            ->whereIn('person_emails.email_cachet', [1, 2])
            ->get();

        return $models;
    }
}
