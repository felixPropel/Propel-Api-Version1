<?php

namespace App\Http\Controllers\version1\Repositories\Person;

use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\personAnniversary;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonLanguage;
use App\Models\PersonMobile;
use App\Models\PersonProfilePic;
use App\Models\PropertyAddress;
use App\Models\TempEmail;
use App\Models\TempMobile;
use App\Models\TempPerson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    public function storePerson($allModels)
    {

        try {

            $result = DB::transaction(function () use ($allModels) {

                $personModel = $allModels['personModel'];
                $personDetailModel = $allModels['personDetailModel'];
                $personEmailModel = $allModels['personEmailModel'];
                $personMobileModel = $allModels['personMobileModel'];
                $personAnotherEmailModel = $allModels['personAnotherEmailModel'];
                $personAnotherMobileModel = $allModels['personAnotherMobileModel'];
                $personWebLinkModel = $allModels['personWebLink'];
                $personOtherLanguage = $allModels['personOtherLanguage'];
                $personIdDocument = $allModels['personIdDocument'];
                $personEducationModel = $allModels['personEducationModel'];
                $personProfessionModel = $allModels['personProfessionModel'];
                $personCommonAddressModel = $allModels['personCommonAddressModel'];
                $personAddressId = $allModels['personAddressId'];
                $personAnniversaryDate = $allModels['personAnniversaryDate'];
                $personProfileModel = $allModels['personProfileModel'];
                $personModel->save();
                $personDetailModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                $personMobileModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                $personEmailModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                if ($personAnniversaryDate) {
                    $personAnniversaryDate->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personAnniversaryDate->save();
                }
                if ($personProfileModel) {
                    $personProfileModel->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personProfileModel->save();

                }
                $personDetailModel->save();
                $personMobileModel->save();
                $personEmailModel->save();

                for ($i = 0; $i < count($personAnotherEmailModel); $i++) {
                    $personAnotherEmailModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personAnotherEmailModel[$i]->save();
                }

                for ($i = 0; $i < count($personAnotherMobileModel); $i++) {
                    $personAnotherMobileModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personAnotherMobileModel[$i]->save();
                }

                for ($i = 0; $i < count($personWebLinkModel); $i++) {
                    $personWebLinkModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personWebLinkModel[$i]->save();
                }

                for ($i = 0; $i < count($personOtherLanguage); $i++) {
                    $personOtherLanguage[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personOtherLanguage[$i]->save();
                }
                for ($i = 0; $i < count($personIdDocument); $i++) {
                    $personIdDocument[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personIdDocument[$i]->save();
                }
                for ($i = 0; $i < count($personEducationModel); $i++) {
                    $personEducationModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personEducationModel[$i]->save();
                }
                for ($i = 0; $i < count($personProfessionModel); $i++) {
                    $personProfessionModel[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personProfessionModel[$i]->save();
                }
                for ($i = 0; $i < count($personCommonAddressModel); $i++) {
                    $personCommonAddressModel[$i]->save();
                }
                for ($i = 0; $i < count($personAddressId); $i++) {
                    $personAddressId[$i]->ParentComAddress()->associate($personCommonAddressModel[$i], 'com_property_address_id', 'id');
                    $personAddressId[$i]->ParentPerson()->associate($personModel, 'uid', 'uid');
                    $personAddressId[$i]->save();
                }
                return [
                    'message' => "Success",
                    'data' => $personProfileModel ?? $personDetailModel,
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

    public function checkPersonEmailByUid($email, $uid)
    {
        return PersonEmail::where(['uid' => $uid, 'email' => $email, 'email_cachet_id' => 1])->first();
    }

    public function emailOtpValidation($uid)
    {
        return PersonEmail::where('uid', $uid)->first();
    }
    public function findEmailByPersonEmail($email)
    {
        $model = PersonEmail::where('email', $email)->whereIn('email_cachet_id', [1, 2])->get();
        if (count($model) == 0) {
            return null;
        } else {
            return $model;
        }
    }
    public function getPersonEmailByUid($uid)
    {
        return PersonEmail::where(['uid' => $uid, ['email_cachet_id', '=', 1]])->first();
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
    public function getMobileNumberByUid($uid, $mobile)
    {
        $model = PersonMobile::where(['uid' => $uid, 'mobile_no' => $mobile])->update(['mobile_cachet_id' => 3, 'deleted_at' => Carbon::now()]);
        $data = ($model)
            ? ['Message' => 'MobileNumber is Deleted']
            : ['Message' => 'MobileNumber Not Found'];
        
        return $data;
        
    }
    public function deletedPersonEmailByUid($email, $uid)
    {
        $model = PersonEmail::where(['uid' => $uid, 'email' => $email])->update(['email_cachet_id' => 3, 'deleted_at' => Carbon::now()]);
        $data = ($model)
            ? ['Message' => 'Email is Deleted']
            : ['Message' => 'Email Not Found'];
        
        return $data;
        
    }
    public function getPersonPrimaryDataByUid($uid)
    {

        $model = Person::with('personDetails', 'email', 'mobile', 'profilePic', 'personLanguage', 'personAnniversaryDate')
            ->whereHas('mobile', function ($query) {
                $query->where('mobile_cachet_id', 1);
            })
            ->whereHas('email', function ($query) {
                $query->where('email_cachet_id', 1);
            })
            ->where('uid', $uid)
            ->first()->toArray();
        return $model;

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
        return Person::with(['mobile', 'email'])
        ->whereHas('mobile', function ($query) use ($mobile) {
            $query->where('mobile_no', $mobile)
                  ->whereIn('mobile_cachet_id', [1, 2]);
        })
        ->whereHas('email', function ($query) use ($email) {
            $query->where('email', $email)
                  ->whereIn('email_cachet_id', [1, 2]);
        })
        ->first();
    }
    public function getPersonDataByMobileNo($mobile)
    {
        return Person::with('mobile', 'existUser')
        ->whereHas('mobile', function ($query) use ($mobile) {
            $query->whereIn('mobile_cachet_id', [1, 2])
                ->where('mobile_no', $mobile);
        })
        ->whereHas('existUser', function ($query) use ($mobile) {
            $query->where('primary_mobile', '!=', $mobile);
        })
        ->first();
    
    }
    public function getPersonDataByEmail($email)
    {
        return Person::with('email', 'existUser')
        ->whereHas('email', function ($query) use ($email) {
            $query->whereIn('email_cachet_id', [1, 2])
                ->where('email', $email);
        })
        ->whereHas('existUser', function ($query) use ($email) {
            $query->where('primary_email', '!=', $email);
        })
        ->first();
    
    }
    public function getDetailedAllPersonDataWithEmailAndMobile($email, $mobile)
    {
      
        $mobile = Person::with('mobile')
            ->whereHas('mobile', function ($query) use ($mobile) {
                $query->whereIn('mobile_cachet_id', [1, 2])
                    ->where('mobile_no', $mobile)
                    ->select('uid');
            })->first();

        $email = Person::with('email')
            ->whereHas('email', function ($query) use ($email) {
                $query->whereIn('email_cachet_id', [1, 2])
                    ->where('email', $email)
                    ->select('uid');
            })
            ->first();
        $mobileUid = $mobile?->uid;
        $emailUid = $email?->uid;
       
        return [
            'mobile' => $mobileUid && !User::where('uid', $mobileUid)->exists() ? $this->personDataMapped($mobileUid) : null,
            'email' => $emailUid && !User::where('uid', $emailUid)->exists() ? $this->personDataMapped($emailUid) : null,
        ];
    }
    public function personDataMapped($uid)
    {

        return Person::select('persons.id as personId', 'persons.uid as personUid', 'person_details.first_name as personName', 'person_emails.email As emailId', 'person_mobiles.mobile_no as mobileId')
            ->leftjoin('person_mobiles', 'person_mobiles.uid', 'persons.uid')
            ->leftjoin('person_emails', 'person_emails.uid', 'persons.uid')
            ->leftjoin('person_details', 'person_details.uid', 'persons.uid')
            ->where('persons.uid', $uid)
            ->get();

    }
    public function checkUserByUID($uid)
    {
        return User::where('uid', $uid)->first();
    }
    public function personAddressByuid($uid)
    {
        return  PropertyAddress::with('ParentAddress')
            ->where('uid', $uid)
            ->get();
        
    }
    public function personSecondMobileAndEmailByUid($uid)
    {
        $mobile = PersonMobile::where(['uid' => $uid, ['mobile_cachet_id', '=', '2']])->get();
        $email = PersonEmail::where(['uid' => $uid, ['email_cachet_id', '=', '2']])->get();
        $model['mobile'] = $mobile;
        $model['email'] = $email;
        return $model;
    }
    public function checkPersonByMobileNo($mobile)
    {
        return PersonMobile::where(['mobile_no' => $mobile, ['mobile_cachet_id', '=', '1']])->first();
    }
    public function getAllDatasInUser($uid)
    {
        return Person::with('personDetails', 'email', 'mobile', 'profilePic', 'personDetails.gender', 'personDetails.bloodGroup', 'personAddress', 'personAddress.ParentComAddress', 'personEducation', 'personProfession', 'personLanguage')->where('uid', $uid)->first();
    }
    public function getPersonProfileByUid($uid)
    {
        return PersonProfilePic::where('uid', $uid)->first();
    }
    public function checkPersonByEmail($email)
    {
        return PersonEmail::where(['email' => $email, ['email_cachet_id', '=', '1']])->first();
    }
    public function getPrimaryMobileNumberByUid($uid)
    {
        return PersonMobile::where(['uid' => $uid, ['mobile_cachet_id', '=', '1']])->first();
    }
    public function getPerviousPrimaryMobileNo($uid)
    {
        return PersonMobile::updateOrInsert(
            ['uid' => $uid, 'mobile_cachet_id' => 1],
            ['mobile_cachet_id' => 2]
        );
        
    }
    public function getPerviousPrimaryEmail($uid)
    {
        return PersonEmail::updateOrInsert(
            ['uid' => $uid, 'email_cachet_id' => 1],
            ['email_cachet_id' => 2]
        );
    }
    public function addSecondaryMobileNoForUser($model)
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
                'message' => "Failed",
                'data' => $e,
            ];
        }
    }
    public function addSecondaryEmailForUser($model)
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
                'message' => "Failed",
                'data' => $e,
            ];
        }
    }
    public function getSecondaryMobileNoByUid($mobile,$uid)
    {
        return PersonMobile::where(['uid' => $uid, 'mobile_no' => $mobile])->whereNotIn('mobile_cachet_id', [1, 3])->first();
    }
    public function getMobileNoByUid($mobile,$uid)
    {
        return PersonMobile::where(['uid' => $uid, 'mobile_no' => $mobile,'mobile_cachet_id'=>1])->first();
    }
    public function getSecondaryEmailByUid($email,$uid)
    {
        return PersonEmail::where('uid', $uid)
        ->where('email', $email)
        ->whereNotIn('email_cachet_id', [1, 3])
        ->first();
        }
    public function secondaryMobileNoValidationId($uid,$mobile)
    {
        return   PersonMobile::where(['uid' => $uid, 'mobile_no' => $mobile])->update(['mobile_validation_id' => 1,'validation_updated_on'=>Carbon::now()]);
    }

    public function secondaryEmailValidationId($uid,$email)
    {
        return   PersonEmail::where(['uid' => $uid, 'email' => $email])->update(['email_validation_id' => 1,'validation_updated_on'=>Carbon::now()]);
    }
    public function removeTempEmailById($id)
    {
        return TempEmail::where('id', $id)->delete();
    }
   
    public function storeTempEmail($model)
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
                'message' => "Failed",
                'data' => $e,
            ];
        }
    }
    public function resendOtpForSecondaryEmail($uid, $email,$otp)
    {
        return   PersonEmail::where(['uid' => $uid, 'email' => $email])->update(['otp_received' =>$otp]);
    }
    public function addedEmailInPerson($model)
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
                'message' => "Failed",
                'data' => $e,
            ];
        }
    }
    public function checkSecondaryMobileNumberByUid($mobile, $uid)
    {
        return PersonMobile::where(['uid' => $uid, 'mobile_no' => $mobile, ['mobile_cachet_id', '=', '2']])->first();
    }
    public function checkSecondaryEmailByUid($email, $uid)
    {
        return PersonEmail::where(['uid' => $uid, 'email' => $email, ['email_cachet_id', '=', '2']])->first();

    }
    public function checkPerivousAddressById($addressId, $uid)
    {
        $porpertyAddress = PropertyAddress::where('id', $addressId)->delete();
        $personAddress = PersonAddress::where(['uid' => $uid, 'com_property_address_id' => $addressId])->delete();
        return true;
    }
    public function getPrimaryMobileAndEmailbyUid($uid)
    {
     return  Person::with(['mobile', 'email'])
        ->where('uid', $uid)
        ->whereHas('mobile', function ($query) {
            $query->whereIn('mobile_cachet_id', [1]);
        })
        ->whereHas('email', function ($query) {
            $query->whereIn('email_cachet_id', [1]);
        })
        ->first();

    }
    public function getPersonPicAndPersonName($uid) 
    {
        return personDetails::with('PersonPic')->where('uid', $uid)->first();
    }
    public function checkPersonExistence($uid)
    {
        return person::where(['uid' => $uid, 'pfm_existence_id' => 1])->first();

    }
    public function setStageInUser($uid)
    {
        return User::where('uid', $uid)->update(['pfm_stage_id' => 2]);
    }
    public function resendOtpForSecondaryMobileNo($uid,$mobile,$otp)
    {
        return   PersonMobile::where(['uid' => $uid, 'mobile_no' => $mobile])->update(['otp_received' =>$otp]);
    }
    public function setPirmaryMobileNo($model)
    {
        return   PersonMobile::where(['uid' => $model->personUid, 'mobile_no' => $model->mobileNo])->update(['mobile_cachet_id' => 1, 'mobileno_updated_on' => Carbon::now(), 'validation_updated_on' => Carbon::now(),'mobile_validation_id' =>1]);

    }
    public function setPirmaryEmail($model)
    {
        return   PersonEmail::where(['uid' => $model->personUid, 'email' => $model->email])->update(['email_cachet_id' => 1, 'email_updated_on' => Carbon::now(), 'validation_updated_on' => Carbon::now(),'email_validation_id' =>1]);

    }
    public function getPersonMobileNoByUid($uid,$mobile)
    {
        return   PersonMobile::where(['uid' => $uid, 'mobile_no' => $mobile])->first();
    }
}
