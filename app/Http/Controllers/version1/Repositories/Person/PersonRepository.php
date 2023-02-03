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
use App\Models\PersonAddress;
use App\Models\PropertyAddress;
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
                $personEducationModel=$allModels['personEducationModel'];
                $personProfessionModel=$allModels['personProfessionModel'];
                $personCommonAddressModel=$allModels['personCommonAddressModel'];
                $personAddressId=$allModels['personAddressId'];
              


                
              
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
                for($i=0;$i<count($personEducationModel);$i++){
                    $personEducationModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personEducationModel[$i]->save();
                } 
                for($i=0;$i<count($personProfessionModel);$i++){
                    $personProfessionModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personProfessionModel[$i]->save();
                } 
                for($i=0;$i<count($personCommonAddressModel);$i++){               
                    $personCommonAddressModel[$i]->save();
                } 
                if(!empty($personCommonAddressModel[$i])){
                    $personAddressId->ParentPerson()->associate($personModel,'uid', 'uid');
                    $personAddressId->save();
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
    public function findEmailByPersonEmail ($email)
    {
        $model=  PersonEmail::where('email',$email)->whereIn('email_cachet', [1, 2])->get();
        if (count($model) == 0) {
            return NUll;
        } else {
            return $model;
        }
    }
    public function getPersonEmailByUid($uid)
    {

        return PersonEmail::where('uid', $uid)->first();
    }
    public function getPersonDatasByUid($uid)
    {
        return PersonDetails::where('uid', $uid)->first();
    }
    public function getPersonByUid($uid)
    {
        return Person::where('uid', $uid)->first();

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
    
        return   personAnniversary::where('uid', $uid)->first();
    
    }
    public function saveAnniversaryDate($model)
    {
        return $model->save();
    }
    public function motherTongueByUid($uid)
    {
    
            return PersonLanguage::where('uid', $uid)->get();
          
     
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
        $models = Person::select('persons.id as personId','persons.uid as personUid','person_details.first_name as personName','person_emails.email As emailId', 'person_mobiles.mobile_no as mobileId')
            ->leftjoin('person_mobiles', 'person_mobiles.uid', 'persons.uid')
            ->leftjoin('person_emails', 'person_emails.uid', 'persons.uid')
            ->leftjoin('person_details', 'person_details.uid', 'persons.uid')
            ->where('person_mobiles.mobile_no', $mobile)
            ->OrWhere('person_emails.email', $email)
            ->whereIn('person_mobiles.mobile_cachet', [1, 2])
            ->whereIn('person_emails.email_cachet', [1, 2])
            ->get();
            if (count($models) == true) {
                return $models;
            } else {
                return NULL;
            }
    }
    public function checkUserByUID($uid)
    {
        return User::where('uid',$uid)->first();
    }
    public function personAddressByuid($uid)
{
$models=PropertyAddress::select('*')
        ->leftjoin('person_addresses','person_addresses.property_address_id','com_property_addresses.id')
        ->where('person_addresses.uid',$uid)
        ->get(); 
        return $models;
}
public  function personSecondMobileAndEmailByUid($uid)
{
     $mobile=PersonMobile::where(['uid'=>$uid ,['mobile_cachet','!=','1']])->get();
     $email=PersonEmail::where(['uid'=>$uid , ['email_cachet','!=','1']])->get();
     $model['mobile']=$mobile;
     $model['email']=$email;
    return $model;
}
public function checkPersonByMobile($mobile) 
{
    return  PersonMobile::where(['mobile_no'=>$mobile,'mobile_cachet'=>1])->first();

}

}
