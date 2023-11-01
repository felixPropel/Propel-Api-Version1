<?php

namespace App\Http\Controllers\version1\Services\Person;

use App\Http\Controllers\version1\Interfaces\Common\SmsInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Http\Controllers\version1\Services\Common\SmsService;
use App\Models\IdDocumentType;
use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\personAnniversary;
use App\Models\PersonDetails;
use App\Models\PersonEducation;
use App\Models\PersonEmail;
use App\Models\PersonLanguage;
use App\Models\PersonMobile;
use App\Models\PersonProfession;
use App\Models\PersonProfilePic;
use App\Models\PropertyAddress;
use App\Models\TempPerson;
use App\Models\WebLink;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PersonService
{
    public function __construct(PersonInterface $personInterface, CommonService $commonService, UserInterface $userInterface, SmsService $smsService, SmsInterface $smsInterface)
    {
        $this->commonService = $commonService;
        $this->personInterface = $personInterface;
        $this->userInterface = $userInterface;
        $this->smsService = $smsService;
        $this->smsInterface = $smsInterface;
    }
    public function findMobileNumber($datas)
    {

        Log::info('PersonService > findMobileNumber function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $model = $this->userInterface->findUserByMobileNo($datas->mobileNumber);

        Log::info('PersonService > findMobileNumber function Return.' . json_encode($model));
        if ($model) {
            // dd($model);
            $userName = $model->personDetails->first_name;
            $userUid = $model->personDetails->uid;
            $userSatge = $model->pfm_stage_id;

            $result = [
                'type' => 1,
                'stage' => $userSatge,
                'userName' => $userName,
                'userUid' => $userUid,
                'mobileNumber' => $datas->mobileNumber,
                'status' => "UserOnly"];
        } else {
            $result = ['type' => 2,
                'mobileNumber' => $datas->mobileNumber,
                'status' => "checkingPerson"];
        }
        return $this->commonService->sendResponse($result, "");
    }
    public function findCredential($datas)
    {
        Log::info('PersonService > findCredential function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $checkPersonMobile = $this->personInterface->checkPersonByMobileNo($datas->mobileNumber);
        if (!empty($checkPersonMobile)) {
            $checkPersonEmail = $this->personInterface->checkPersonEmailByUid($datas->email, $checkPersonMobile->uid);
        }
        $personMobile = $this->personInterface->getPersonDataByMobileNo($datas->mobileNumber);
        $personEmail = $this->personInterface->getPersonDataByEmail($datas->email);

        if ($checkPersonMobile && $checkPersonEmail) {
            $result = ['type' => 1, 'personData' => $datas, 'uid' => $checkPersonMobile->uid, 'status' => 'ExactPerson'];
        } else if ($personMobile !== null || $personEmail!== null) {
            $personData=['personMobile'=>$personMobile->mobile,'personEmail'=>$personEmail->email];
            $result = ['type' => 2, 'personData' => $personData, 'status' => 'mappedPerson'];
        } else {
            $result = ['type' => 3, 'status' => 'freshUser'];
        }
        return $this->commonService->sendResponse($result, "");
    }
    public function storeTempPerson($datas)
    {

        Log::info('PersonService > storeTempPerson function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $tempId = isset($datas->tempId) ? $datas->tempId : 0;
        $model = $this->convertToTempPersonModel($datas, $tempId);
        $storeTempPerson = $this->personInterface->storeTempPerson($model);
        Log::info('PersonService > storeTempPerson function Return.' . json_encode($storeTempPerson));

        if ($storeTempPerson['message'] == "Success") {

            $responseModel = $storeTempPerson['data'];
            if ($responseModel->pfm_stage_id == 1) {
                $salutationModel = $this->commonService->getSalutation();
                $responseData = ['tempModel' => $storeTempPerson['data'], 'salutationModel' => $salutationModel];
            } else if ($responseModel->pfm_stage_id == 2) {
                $gender = $this->commonService->getAllGender();
                $bloodGroup = $this->commonService->getAllBloodGroup();
                $responseData = ['tempModel' => $responseModel, 'gender' => $gender, 'bloodGroup' => $bloodGroup];
            } elseif ($responseModel->pfm_stage_id == 3) {
                $temp = ['tempId' => $tempId];
                $storeTempPerson1 = $this->resendOtp($temp);
                log::info('personservice > ' . json_encode($storeTempPerson1));
                return $storeTempPerson1;

            }
            return $this->commonService->sendResponse($responseData, $storeTempPerson['message']);
        } else {
            return $this->commonService->sendError($storeTempPerson['data'], $storeTempPerson['message']);
        }
    }
    public function storePerson($datas, $type = null)
    {

        Log::info('PersonService > storePerson function Inside.' . json_encode($datas));

        $datas['personUid'] = isset($datas['personUid']) ? $datas['personUid'] : null;

        $datas = (object) $datas;

        $personModel = $this->convertToPersonModel($datas);

        $personDetailModel = $this->convertToPersonDetailModel($datas);
        $personEmailModel = $this->convertToPersonEmailModel($datas);
        $personMobileModel = $this->convertToPersonMobileModel($datas);
        $personProfileModel = $this->convertToPersonProfileModel($datas);
        $personAnniversaryDate = $this->convertToPersonAnniversaryDate($datas);

        $personAnotherEmailModel = array();

        if (isset($datas->secondEmail) && !in_array(null, $datas->secondEmail)) {
            $personAnotherEmailModel = $this->convertToPersonEmailModelAnother($datas);
        }
        $personAnotherMobileModel = array();
        if (isset($datas->secondNumber) && !in_array(null, $datas->secondNumber)) {
            $personAnotherMobileModel = $this->convertToPersonMobileModelAnother($datas);
        }
        $personWebLink = array();
        if (isset($datas->webLinks) && !in_array(null, $datas->webLinks)) {
            $personWebLink = $this->convertToPersonWebLink($datas);
        }
        $personOtherLanguage = array();
        if ((isset($datas->otherLanguage) && $datas->otherLanguage !== null) || isset($datas->motherLanguage) && !in_array(null, $datas->motherLanguage)) {
            $personOtherLanguage = $this->convertToPersonOtherLanguage($datas);
        }

        $personIdDocument = array();
        if ((isset($datas->idDocumentType) && $datas->idDocumentType !== null)) {
            $personIdDocument = $this->convertToPersonIdDocument($datas);
        }
        $personEducationModel = array();
        if (isset($datas->Qualification) && !in_array(null, $datas->Qualification)) {
            $personEducationModel = $this->convertToPersonEducation($datas);
        }
        $personProfessionModel = array();
        if (isset($datas->ProfessionDepartment) && !in_array(null, $datas->ProfessionDepartment)) {
            $personProfessionModel = $this->convertToPersonProfession($datas);
        }

        $personCommonAddressModel = array();
        $personAddressId = array();
        if ((isset($datas->addressOf) && $datas->addressOf !== null)) {
            $addressId = isset($datas->propertyAddressId) ? $datas->propertyAddressId : null;
            Log::info('PersonService > addressId function Inside.' . json_encode($addressId));
            if($addressId){
            for ($i = 0; $i < count($datas->propertyAddressId); $i++) {
                $perviousAddress = $this->personInterface->checkPerivousAddressById($datas->propertyAddressId[$i], $datas->personUid);
            }
        }
            $personCommonAddressModel = $this->convertToPersonCommonAddress($datas);
            $personAddressId = $this->convertToPersonAddressId($datas);
            Log::info('PersonService > personAddressId function Return.' . json_encode($personAddressId));

        }
        $allModels = [
            'personModel' => $personModel,
            'personDetailModel' => $personDetailModel,
            'personEmailModel' => $personEmailModel,
            'personMobileModel' => $personMobileModel,
            'personAnotherEmailModel' => $personAnotherEmailModel,
            'personAnotherMobileModel' => $personAnotherMobileModel,
            'personWebLink' => $personWebLink,
            'personOtherLanguage' => $personOtherLanguage,
            'personIdDocument' => $personIdDocument,
            'personEducationModel' => $personEducationModel,
            'personProfessionModel' => $personProfessionModel,
            'personCommonAddressModel' => $personCommonAddressModel,
            'personAddressId' => $personAddressId,
            'personAnniversaryDate' => $personAnniversaryDate,
            'personProfileModel' => $personProfileModel,

        ];
        $personData = $this->personInterface->storePerson($allModels);
        log::info('allModels' . json_encode($personData));

        Log::info('PersonService > storePerson function Return.' . json_encode($personData));
        if ($type) {
            return $personData;
        } else {
            if ($personData['message'] == "Success") {
                if (!$datas->personUid) {
                    $uid = $personData['data']->uid->toString();
                    $createTableBasedUid = $this->createPersonTableByUid($uid);
                }
                return $this->commonService->sendResponse($personData['data'], $personData['message']);
            } else {
                return $this->commonService->sendError($personData['data'], $personData['message']);
            }
        }
    }
    public function convertToPersonAnniversaryDate($datas)
    {
        if (isset($datas->anniversaryDate)) {
            Log::info('PersonService > PersonAnniversaryDate.' . json_encode($datas->personUid));
            $model = $this->personInterface->getAnniversaryDate($datas->personUid);
            if ($model) {
                $model->uid = $datas->personUid;
            } else {
                $model = new personAnniversary();
                $model->uid = $datas->personUid;
            }
            // $date = Carbon::createFromFormat('d-m-Y', $datas->anniversaryDate)->format('Y-m-d');
            $model->anniversary_date = '2000-08-18';
            $model->occasions_id = null;
            Log::info('PersonService > PersonAnniversaryDate .' . json_encode($model));
            return $model;
        }
    }
    public function convertToPersonProfileModel($datas)
    {
        if (isset($datas->personProfile)) {
            $personPic = $this->personInterface->getPersonProfileByUid($datas->personUid);
            if ($personPic) {
                $filePathToDelete = storage_path('app/public/Profiles/' . $personPic->profile_pic);
                if (File::exists($filePathToDelete)) {
                    File::delete($filePathToDelete);
                    $personPic->delete();
                }
            }
            $decodedImageContents = base64_decode($datas->personProfile);
            $uniqueFilename = date('YmdHis') . '_' . uniqid() . '.jpg';
            $savePath = storage_path('app/public/Profiles/' . $uniqueFilename);
            Log::info('PersonService >  savePath function Return.' . json_encode($savePath));
            File::put($savePath, $decodedImageContents);
            $model = new PersonProfilePic();
            $model->uid = $datas->personUid;
            $model->profile_pic = $uniqueFilename;
            $model->pfm_active_status_id = 1;
            $model->profile_cachet_id = 1;
            return $model;
        }
    }
    public function resendOtp($datas)
    {
        Log::info('PersonService > resendOtp function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $tempId = $datas->tempId;
        $otp = random_int(1000, 9999);
        $newDatas = ['otp' => $otp, 'stage' => 4];
        $newDatas = (object) $newDatas;
        $model = $this->convertToTempPersonModel($newDatas, $tempId);
        $storeTempPerson = $this->personInterface->storeTempPerson($model);
        Log::info('PersonService > findMobileNumber function Return.' . json_encode($storeTempPerson));
        if ($storeTempPerson['message'] == "Success") {
            return $this->commonService->sendResponse($storeTempPerson['data'], $storeTempPerson['message']);
        } else {
            return $this->commonService->sendError($storeTempPerson['data'], $storeTempPerson['message']);
        }
    }
    public function checkPersonEmail($datas)
    {
        Log::info('PersonService > checkPersonEmail function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $checkEmailByUid = $this->personInterface->checkPersonEmailByUid($datas->email, $datas->personUid);
        $findEmailByPereson = $this->personInterface->findEmailByPersonEmail($datas->email);
        Log::info('PersonService > checkPersonEmail function Return.' . json_encode($checkEmailByUid));
        if ($checkEmailByUid) {
            $result = ['type' => 1, 'personDatas' => $checkEmailByUid, 'mobileNumber' => $datas->mobileNumber, 'status' => "Email_In"];
        } elseif ($findEmailByPereson) {
            $result = ['type' => 2, 'personDatas' => $findEmailByPereson, 'status' => "mutipleperson"];
        } else {
            $result = ['type' => 0, 'personDatas' => '', 'status' => "Email Not Our System"];
        }
        return $this->commonService->sendResponse($result, '');
    }
    public function personOtpValidation($datas)
    {

        Log::info('PersonService > personOtpValidation function Inside.' . json_encode($datas));
        $datas = (object) $datas;
       
        $tempPersonModel = $this->personInterface->findTempPersonById($datas->tempId);

        Log::info('PersonService > personOtpValidation function Return.' . json_encode($tempPersonModel));
        if ($tempPersonModel) {
            if ($datas->otp == $tempPersonModel->otp) {
                $personalDatas = json_decode($tempPersonModel->personal_data, true);
                $mobileNumber = isset($tempPersonModel['mobile_no']) ? $tempPersonModel['mobile_no'] : null;
                $email = isset($tempPersonModel['email']) ? $tempPersonModel['email'] : null;
                $salutation = isset($personalDatas['salutation']) ? $personalDatas['salutation'] : null;
                $firstName = isset($personalDatas['firstName']) ? $personalDatas['firstName'] : null;
                $middleName = isset($personalDatas['middleName']) ? $personalDatas['middleName'] : null;
                $lastName = isset($personalDatas['lastName']) ? $personalDatas['lastName'] : null;
                $nickName = isset($personalDatas['nickName']) ? $personalDatas['nickName'] : null;
                $gender = isset($personalDatas['gender']) ? $personalDatas['gender'] : null;
                $bloodGroup = isset($personalDatas['bg']) ? $personalDatas['bg'] : null;
                $dob = isset($personalDatas['dob']) ? $personalDatas['dob'] : null;
                $personDatas = ['mobileNumber' => $mobileNumber, 'email' => $email, 'salutationId' => $salutation, 'firstName' => $firstName, 'middleName' => $middleName, 'lastName' => $lastName, 'nickName' => $nickName, 'genderId' => $gender, 'bloodGroup' => $bloodGroup, 'dob' => $dob];
              
                $personModel = $this->storePerson($personDatas);
                $tempPersonModel->delete();
                return $personModel;
            } else {
                return $this->commonService->sendError(['tempId' => $tempPersonModel->id, 'mobileNumber' => $tempPersonModel->mobile_no]);
            }
        } else {}
    }
    public function convertToPersonModel($datas)
    {
        Log::info('PersonService > uidByPerson.' . json_encode($datas->personUid));
        if ($datas->personUid) {
            $model = $this->personInterface->getPersonByUid($datas->personUid);
        } else {
            $model = new Person();
            $model->uid = Str::uuid();
        }
        $model->pfm_stage_id = 1;
        $model->pfm_origin_id = 1;
        $model->pfm_existence_id = 1;
        Log::info('PersonService > personUid .' . json_encode($model));
        return $model;
    }
    public function convertToTempPersonModel($datas, $id = null)
    {
        log::info('personService > ' . json_encode($datas));

        if ($id) {

            $model = TempPerson::findOrFail($id);
            log::info('findOrFail > ' . json_encode($model));
        } else {

            $model = new TempPerson();
        }
        if (isset($datas->mobileNumber)) {
            $model->mobile_no = isset($datas->mobileNumber) ? $datas->mobileNumber : "";
        }
        if (isset($datas->email)) {
            $model->email = isset($datas->email) ? $datas->email : "";
        }

        $salutation = isset($datas->salutation) ? $datas->salutation : "";
        if ($salutation) {
            $model['personal_data->salutation'] = $salutation;
        }

        $firstName = isset($datas->firstName) ? $datas->firstName : "";
        $middleName = isset($datas->middleName) ? $datas->middleName : "";
        $lastName = isset($datas->lastName) ? $datas->lastName : "";
        $nickName = isset($datas->nickName) ? $datas->nickName : "";
        $gender = isset($datas->gender) ? $datas->gender : "";
        $dob = isset($datas->dob) ? $datas->dob : "";
        $bloodGroup = isset($datas->bloodGroup) ? $datas->bloodGroup : "";
        $otp = isset($datas->otp) ? $datas->otp : "";
        $stage = isset($datas->stage) ? $datas->stage : "";
        if ($stage) {
            log::info('personService > stage' . json_encode($datas->stage));
            $model->pfm_stage_id = $stage;
        }

        if ($firstName) {
            $model['personal_data->firstName'] = $firstName;
        }
        if ($middleName) {
            $model['personal_data->middleName'] = $middleName;
        }
        if ($lastName) {
            $model['personal_data->lastName'] = $lastName;
        }
        if ($nickName) {
            $model['personal_data->nickName'] = $nickName;
        }
        if ($gender) {
            $model['personal_data->gender'] = $gender;
        }
        if ($bloodGroup) {
            $model['personal_data->bg'] = $bloodGroup;
        }
        if ($dob) {
            $model['personal_data->dob'] = $dob;
        }
        if ($otp) {
            log::info('personService > otp' . json_encode($datas->otp));
            $model->otp = $otp;
        }

        return $model;
    }
    public function convertToPersonDetailModel($datas)
    {
        Log::info('PersonService > convertToPersonDetailModel function Inside.' . json_encode($datas));
        if ($datas->personUid) {
            $model = $this->personInterface->getPersonDatasByUid($datas->personUid);
        } else {
            $model = new PersonDetails();
        }
    
        $model->pims_person_salutation_id = isset($datas->salutationId)? $datas->salutationId : null;
        $model->first_name = $datas->firstName;
        $model->middle_name = isset($datas->middleName) ? $datas->middleName : null;
        $model->last_name = isset($datas->lastName) ? $datas->lastName : null;
        $model->nick_name = isset($datas->nickName) ? $datas->nickName : null;
        // $date = Carbon::createFromFormat('d-m-Y', $datas->dob)->format('Y-m-d');
        $model->dob = '2000-08-18';
        $model->birth_place = isset($datas->birthCity) ? $datas->birthCity : null;
        $model->pims_person_marital_status_id = isset($datas->maritalStatus) ? $datas->maritalStatus : null;
        $model->pims_person_gender_id = isset($datas->genderId) ? $datas->genderId : null;
        $model->pims_person_blood_group_id = isset($datas->bloodGroup) ? $datas->bloodGroup : null;
        $model->pfm_survial_id = 1;
        Log::info('PersonService > convertToPersonDetailModel function Return.' . json_encode($model));

        return $model;
    }
    public function convertToPersonMobileModel($datas)
    {
        Log::info('PersonService > convertToPersonMobileModel function Inside.' . json_encode($datas));
        if ($datas->personUid) {
            $model = $this->personInterface->getPersonMobileNoByUid($datas->personUid, $datas->mobileNumber);
            $model->mobile_no = $datas->mobileNumber;
            $model->mobile_cachet_id = 1;
        } else {
            $model = new PersonMobile();
            $model->mobile_no = $datas->mobileNumber;
            $model->mobile_cachet_id = 1;
        }

        Log::info('PersonService > convertToPersonMobileModel function Return.' . json_encode($model));
        return $model;
    }
    public function convertToPersonEmailModel($datas)
    {
        Log::info('PersonService > convertToPersonEmailModel function Inside.' . json_encode($datas));
        if ($datas->personUid) {
            $model = $this->personInterface->getPersonEmailByUid($datas->personUid);
            $model->email = $datas->email;
            $model->email_cachet_id = 1;
        } else {
            $model = new PersonEmail();
            $model->email = $datas->email;
            $model->email_cachet_id = 1;
        }

        Log::info('PersonService > convertToPersonEmailModel function Return.' . json_encode($model));

        return $model;
    }
    public function convertToPersonEmailModelAnother($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonEmailModelAnother function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->secondEmail); $i++) {
            $checkEmail = $this->personInterface->checkSecondaryEmailByUid($datas->secondEmail[$i], $datas->personUid);
            if ($checkEmail) {
                $checkEmail->uid = $datas->personUid;
                $checkEmail->email = $datas->secondEmail[$i];
                $checkEmail->email_cachet_id = 2;
                $checkEmail->save();
            } else {
                $model[$i] = new PersonEmail();
                $model[$i]->email = $datas->secondEmail[$i];
                $model[$i]->email_cachet_id = 2;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonEmailModelAnother3 function Return.' . json_encode($orgModel));
    }
    public function convertToPersonMobileModelAnother($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonMobileModelAnother function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->secondNumber); $i++) {
            $checkMobile = $this->personInterface->checkSecondaryMobileNumberByUid($datas->secondNumber[$i], $datas->personUid);
            if ($checkMobile) {
                $checkMobile->uid = $datas->personUid;
                $checkMobile->mobile_no = $datas->secondNumber[$i];
                $checkMobile->mobile_cachet_id = 2;
                $checkMobile->save();
            } else {
                $model[$i] = new PersonMobile();
                $model[$i]->mobile_no = $datas->secondNumber[$i];
                $model[$i]->mobile_cachet_id = 2;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonMobileModelAnother function Return.' . json_encode($orgModel));
    }
    public function convertToPersonWebLink($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonWebLink function Inside.' . json_encode($datas));
        $link = $datas->webLinks;
        for ($i = 0; $i < count($link); $i++) {
            if ($link[$i]) {
                $model[$i] = new WebLink();
                $model[$i]->web_add = $link[$i];
                $model[$i]->web_cachet_id = 1;
                $model[$i]->pfm_active_status_id = 1;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonWebLinkEnd function Return.' . json_encode($orgModel));
    }
    public function convertToPersonOtherLanguage($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonOtherLanguage function Inside.' . json_encode($datas));
        if (isset($datas->otherLanguage)) {
            if ($datas->personUid) {
                $models = $this->personInterface->motherTongueByUid($datas->personUid);
            }
            if (isset($models) && count($models)) {
                foreach ($models as $model) {
                    $model->delete();
                }
            }
            for ($i = 0; $i < count($datas->otherLanguage); $i++) {
                if ($datas->otherLanguage[$i]) {
                    $result[$i] = new PersonLanguage();
                    $result[$i]->pims_com_language_id = $datas->otherLanguage[$i];
                    $result[$i]->is_mother_tongue = $datas->motherLanguage;
                    $result[$i]->pfm_active_status_id = 1;
                    array_push($orgModel, $result[$i]);
                }
            }
        }
        if ($datas->motherLanguage && empty($orgModel)) {
            $language = $datas->motherLanguage;
            if ($datas->personUid) {
                $models = $this->personInterface->motherTongueByUid($datas->personUid);
            }
            if (isset($models) && count($models)) {
                foreach ($models as $model) {
                    $model->delete();
                }
            }
            for ($i = 0; $i < count($language); $i++) {
                if ($language[$i]) {
                    $result[$i] = new PersonLanguage();
                    $result[$i]->is_mother_tongue = $language[$i];
                    $result[$i]->pfm_active_status_id = 1;
                    array_push($orgModel, $result[$i]);
                }
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonOtherLanguage123 function Return.' . json_encode($orgModel));
    }
    public function convertToPersonIdDocument($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonIdDocument function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->idDocumentType); $i++) {
            if ($datas->idDocumentType[$i]) {
                $model[$i] = new IdDocumentType();
                $model[$i]->pims_person_doc_type_id = $datas->idDocumentType[$i];
                $model[$i]->Doc_no = $datas->documentNumber[$i];
                $model[$i]->doc_validity = $datas->validTill[$i];
                $model[$i]->attachment = $datas->attachments[$i];
                $model[$i]->pfm_active_status_id = 1;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonIdDocument function Return.' . json_encode($orgModel));
    }
    public function convertToPersonEducation($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonEducation function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->Qualification); $i++) {
            if ($datas->Qualification[$i]) {
                $model[$i] = new PersonEducation();
                $model[$i]->pims_person_qualification_id = $datas->Qualification[$i];
                $model[$i]->year_of_pass = $datas->passedYear[$i];
                $model[$i]->Mark = $datas->mark[$i];
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonEducation function Return.' . json_encode($orgModel));
    }
    public function convertToPersonProfession($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonProfession function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->ProfessionDepartment); $i++) {
            if ($datas->ProfessionDepartment[$i]) {
                $model[$i] = new PersonProfession();
                $model[$i]->department_id = $datas->ProfessionDepartment[$i];
                $model[$i]->designation_id = $datas->Designation[$i];
                $model[$i]->org_id = $datas->organization[$i];
                // $model[$i]->doj=$datas->joinDate[$i];
                //  $model[$i]->dor=$datas->reliveDate[$i];
                $model[$i]->experience = $datas->experinceYear[$i];
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonProfession function Return.' . json_encode($orgModel));
    }
    public function convertToPersonCommonAddress($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonCommonAddress function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->addressOf); $i++) {
            if ($datas->addressOf[$i]) {
                $model[$i] = new PropertyAddress();
                $model[$i]->pims_com_address_type_id = $datas->addressOf[$i];
                $model[$i]->door_no = $datas->doorNo[$i];
                $model[$i]->building_name = $datas->buildingName[$i];
                $model[$i]->pin = $datas->pinCode[$i];
                $model[$i]->area = $datas->area[$i];
                $model[$i]->street = $datas->street[$i];
                $model[$i]->land_mark = $datas->landMark[$i];
                $model[$i]->pims_com_district_id = $datas->district[$i];
                $model[$i]->pims_com_city_id = $datas->city[$i];
                $model[$i]->pims_com_state_id = $datas->state[$i];
                $model[$i]->pfm_active_status_id = 1;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonCommonAddress function Return.' . json_encode($orgModel));
    }

    public function convertToPersonAddressId($datas)
    {
        $orgModel = [];
        for ($i = 0; $i < count($datas->addressOf); $i++) {
            $model[$i] = new PersonAddress();
            // $model[$i]->uid = $datas->personUid;
            $model[$i]->address_cachet_id = 1;
            array_push($orgModel, $model[$i]);
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonAddressId function Inside.' . json_encode($orgModel));
    }
    public function checkUserOrPerson($datas)
    {
        Log::info('PersonService > checkUserOrPerson function Inside.' . json_encode($datas));
        $personDatas = (object) $datas;
        $checkUser = $this->personInterface->checkUserByUID($personDatas->uid);
        if ($checkUser) {
            $personName = $this->personInterface->getPersonDatasByUid($personDatas->uid);
            return $this->commonService->sendResponse($personName, 'ExactUser');
        } else {
            $mobileOtp = $this->personMobileOtp($datas);
            return $mobileOtp;
        }
    }
    public function personMobileOtp($datas)
    {
        Log::info('PersonService > personMobileOtp function Inside.' . json_encode($datas));
        $personDatas = (object) $datas;
        $otp = random_int(1000, 9999);
        $otpMobile = $this->convertOtpMobileNumber($personDatas->uid, $otp);
        $smsTypeModel = $this->smsInterface->findSmsTypeByName('PersonToUser');
        $smsHistoryModel = $this->smsService->storeSms($personDatas->mobileNumber, $smsTypeModel->id, $otp, $personDatas->uid);
        Log::info('PersonService > personMobileOtp function Return.' . json_encode($datas));
        return $this->commonService->sendResponse($datas, 'OtpSuccesfully');
    }
    public function convertOtpMobileNumber($uid, $otp)
    {
        Log::info('PersonService > convertOtpMobileNumber function Inside.' . json_encode($uid));
        Log::info('PersonService > convertOtpMobileNumber function Inside.' . json_encode($otp));
        if ($uid) {
            $model = PersonMobile::where("uid", $uid)->update(['otp_received' => $otp]);
            Log::info('PersonService > convertOtpMobileNumber function Return.' . json_encode($model));
            return $model;
        }
    }

    public function personDatas($datas)
    {
        Log::info('PersonService > personDatas function Inside.' . json_encode($datas));
        $model = $this->personInterface->getPersonDatasByUid($datas);
        $salutation = $this->commonService->getSalutation();
        $result = ['personData' => $model, 'salutation' => $salutation];
        Log::info('PersonService > personDatas function Return.' . json_encode($model));
        return $this->commonService->sendResponse($result, '');
    }
    public function personUpdate($datas)
    {

        Log::info('PersonService > personUpdate function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $personData = $this->personInterface->getPersonDatasByUid($datas->uid);
        $personUpdate = $this->updatePerson($personData, $datas);
        $saveperson = $this->personInterface->savePersonDatas($personUpdate);
        $gender = $this->commonService->getAllGender();
        $bloodGroup = $this->commonService->getAllBloodGroup();
        $result = ['gender' => $gender, 'bloodGroup' => $bloodGroup, 'personData' => $personData];
        Log::info('PersonService > personUpdate function Return.' . json_encode($result));
        return $this->commonService->sendResponse($result, '');
    }
    public function updatePerson($personData, $datas)
    {
        Log::info('PersonService > updatePerson function Inside.' . json_encode($datas));
        Log::info('PersonService > updatePerson function Inside.' . json_encode($personData));
        if ($datas->uid) {
            $personData->uid = $datas->uid;
            $personData->pims_person_salutation_id = $datas->salutation;
            $personData->first_name = $datas->firstName;
            $personData->middle_name = $datas->middleName;
            $personData->last_name = $datas->lastName;
            $personData->nick_name = $datas->nickName;
            Log::info('PersonService > updatePerson function Return.' . json_encode($personData));
            return $personData;
        }
    }
    public function personToUser($datas)
    {
        Log::info('PersonService > personToUser function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $person = $this->personInterface->getPersonDatasByUid($datas->uid);
        $convertPerson = $this->convertPerson($person, $datas);
        $savePerson = $this->personInterface->savePerson($convertPerson);
        Log::info('PersonService > personToUser function Return.' . json_encode($datas->uid));
        return $this->commonService->sendResponse($person, '');
    }
    public function convertPerson($person, $datas)
    {
        Log::info('PersonService > convertPerson function Inside.' . json_encode($datas));
        Log::info('PersonService > convertPerson function Inside.' . json_encode($person));
        $person->uid = $datas->uid;
        $person->dob = $datas->dob;
        $person->pims_person_gender_id = $datas->gender;
        $person->pims_person_blood_group_id = $datas->bloodGroup;
        Log::info('PersonService > convertPerson function Return.' . json_encode($person));
        return $person;
    }
    public function generateEmailOtp($uid)
    {
        Log::info('PersonService > generateEmailOtp function Inside.' . json_encode($uid));
        $data = $this->personInterface->getPersonEmailByUid($uid);
        $otp = substr(str_shuffle("123456789"), 0, 5);
        $model = PersonEmail::where(["uid" => $uid, 'email' => $data->email])->update(["otp_received" => $otp]);
        Log::info('PersonService > generateEmailOtp function Return.' . json_encode($model));
        if ($model) {
            $getUserName = $this->personInterface->getPersonDatasByUid($uid);
            $response = ["message" => 'OK', 'route' => 'email_otp', "param" => ['uid' => $uid['uid'], 'email' => $data->email, 'personName' => $getUserName['first_name']]];
            return response($response, 200);
        } else {
            $response = ["message" => 'Mail Not Send'];
            return response($response, 400);
        }
    }
    public function emailOtpValidation($datas)
    {
        Log::info('PersonService > emailOtpValidation function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $uid = $datas->uid;
        $model = $this->personInterface->checkPersonEmailByUid($datas->email, $datas->uid);
        Log::info('PersonService > emailOtpValidation function Return.' . json_encode($model));
        if ($model->otp_received == $datas->otp) {
            $email = PersonEmail::where(['uid' => $datas->uid, 'email' => $datas->email])->update(['email_validation_id' => 1, 'validation_updated_on' => Carbon::now()]);
            $setSatge = $this->personInterface->setStageInUser($uid);
            $result = ['status' => 'Otp Verified', 'type' => 1, 'uid' => $uid];
        } else {
            $result = ['status' => 'Otp Verified Failed', 'type' => 2, 'uid' => $uid];
        }
        return $result;
    }
    public function personProfileDetails($datas)
    {

        Log::info('PersonService > personProfileDetails function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $personDetails = $this->personInterface->getPersonPrimaryDataByUid($datas->uid);
        $personAddressByUid = $this->personInterface->personAddressByuid($datas->uid);
        $personMasterData = $this->commonService->getPersonMasterData();
        $secondMobileAndEmail = $this->personInterface->personSecondMobileAndEmailByUid($datas->uid);
        Log::info('PersonService > personProfileDetails function Return.' . json_encode($personMasterData));
        return [
            'personDetail' => $personDetails,
            'personAddressByUid' => $personAddressByUid,
            'personMasterData' => $personMasterData,
            'secondMobileAndEmail' => $secondMobileAndEmail,
        ];}

    public function getDetailedAllPerson($datas)
    {

        Log::info('PersonService > getDetailedAllPerson function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $personMobile = $this->personInterface->getPersonDataByMobileNo($datas->mobileNumber);
        $personEmail = $this->personInterface->getPersonDataByEmail($datas->email);
        $personData=['personMobile'=>$personMobile->mobile,'personEmail'=>$personEmail->email];
        return $this->commonService->sendResponse($personData, '');

    }
    public function userProfileDatas($datas)
    {
        Log::info('PersonService > userProfileDatas function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $users = $this->personInterface->getAllDatasInUser($datas->uid);
        $personDetails = $users['personDetails'];
        $primaryMobile = $users['mobile'];
        $primaryEmail = $users['email'];
        $profilePic = $users['profilePic'];
        $personGender = $users['personDetails']['gender'];
        $personbloodGroup = $users['personDetails']['bloodGroup'];
        $primaryAddress = isset($users['personAddress']['ParentComAddress']) ? $users['personAddress']['ParentComAddress'] : '';
        $personEducation = $users['personEducation'];
        $personProfession = $users['personProfession'];

        $data = ['userDeatils' => $personDetails, 'primaryMobile' => $primaryMobile, 'primaryEmail' => $primaryEmail, 'profilePic' => $profilePic, 'userGender' => $personGender, 'userBloodGroup' => $personbloodGroup, 'primaryAddress' => $primaryAddress, 'UserEducation' => $personEducation, 'userProfession' => $personProfession];

        return $this->commonService->sendResponse($data, '');
    }
    public function sendingOtp()
    {
        $otp = random_int(1000, 9999);
        return $otp;
    }
    public function addSecondaryMobile($datas)
    {

        $datas = (object) $datas;
        Log::info('PersonService > addSecondaryMobile function Inside.' . json_encode($datas->mobileNo));
        $checkPrimaryMobile = $this->personInterface->checkPersonByMobileNo($datas->mobileNo);

        $checkMobile = $this->personInterface->checkSecondaryMobileNumberByUid($datas->mobileNo, $datas->personUid);
        if (empty($checkPrimaryMobile) && empty($checkMobile)) {
            $convertMobileNo = $this->convertSecondaryMobileNo($datas->mobileNo, $datas->personUid);
            $result = $this->personInterface->addSecondaryMobileNoForUser($convertMobileNo);

        } else {

            $result = $checkPrimaryMobile
            ? ['users' => 'This Number Is Already Exists in yours', 'type' => 2]
            : ['users' => 'This Number Is Already Exists in Other User', 'type' => 1];

        }
        return $result;
    }
    public function convertSecondaryMobileNo($mobile, $uid)
    {
        $model = new PersonMobile();
        $model->uid = $uid;
        $model->mobile_no = $mobile;
        $model->otp_received = $this->sendingOtp();
        $model->mobile_cachet_id = 2;
        return $model;
    }
    public function convertSecondaryEmail($email, $uid)
    {
        $model = new PersonEmail();
        $model->uid = $uid;
        $model->email = $email;
        $model->otp_received = $this->sendingOtp();
        $model->email_cachet_id = 2;
        return $model;
    }
    public function resendOtpForMobile($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->getPersonMobileNoByUid($datas->uid, $datas->mobile_no);
        if ($model) {
            $mobile = PersonMobile::where(['uid' => $datas->uid, 'mobile_no' => $datas->mobile_no])->update(['otp_received' => $this->sendingOtp(), 'mobile_validation' => null, 'validation_updated_on' => null]);
            $data = ['Message' => ' Resend OTP Successfully', 'type' => 1];
        } else {
            $data = ['Message' => 'Data Not Found', 'type' => 0];
        }
        return $this->commonService->sendResponse($data, '');
    }
    public function deleteForMobileNumberByUid($datas)
    {
        $datas = (object) $datas;
        Log::info('PersonService > deleteForMobileNumberByUid function Inside.' . json_encode($datas));
        $model = $this->personInterface->getMobileNumberByUid($datas->uid, $datas->mobile_no);
        return $this->commonService->sendResponse($model, '');
    }
    public function addSecondaryEmail($datas)
    {
        $datas = (object) $datas;
        $checkPrimaryEmail = $this->personInterface->checkPersonByEmail($datas->email);
        $checkEmail = $this->personInterface->checkSecondaryEmailByUid($datas->email, $datas->personUid);
        if (empty($checkPrimaryEmail) && empty($checkEmail)) {
            $convertEmail = $this->convertSecondaryEmail($datas->email, $datas->personUid);
            $result = $this->personInterface->addSecondaryEmailForUser($convertEmail);
        } else {
            $result = $checkPrimaryEmail
            ? ['users' => 'This email Is Already Exists in Other User', 'type' => 1]
            : ['users' => 'This email Is Already Exists in Your', 'type' => 2];
        }
        return $result;
    }
    public function resendOtpForEmail($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->checkPersonEmailByUid($datas->email, $datas->uid);
        if ($model) {
            $mobile = PersonEmail::where(['uid' => $datas->uid, 'email' => $datas->email])->update(['otp_received' => $this->sendingOtp(), 'email_validation_updated_on' => null]);
            $data = ['Message' => ' Resend OTP Successfully', 'type' => 1];
        } else {
            $data = ['Message' => 'Data Not Found', 'type' => 0];
        }
        return $this->commonService->sendResponse($data, '');
    }
    public function deleteForEmailByUid($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->deletedPersonEmailByUid($datas->email, $datas->uid);
        return $this->commonService->sendResponse($model, '');
    }
    public function makeAsPrimaryMobileOtpValidate($datas)
    {

        $otpValidate = $this->OtpValidateSecondaryMobileNo($datas);
        $datas = (object) $datas;
        if ($otpValidate == 1) {
            $perviousMobileNo = $this->personInterface->getPerviousPrimaryMobileNo($datas->personUid);
            $setprimaryMobileNo = $this->personInterface->setPirmaryMobileNo($datas);
            $message = ['status' => 'primary changed Successfully', 'type' => 1];
        } else {
            $message = ['status' => 'OTP Validation Failed ', 'type' => 2];
        }

        return $this->commonService->sendResponse($message, '');
    }

    public function makeAsPrimaryEmailOtpValidate($datas)
    {
        $otpValidate = $this->OtpValidateForSecondaryEmail($datas);
        $datas = (object) $datas;
        if ($otpValidate == 1) {
            $perviousEmail = $this->personInterface->getPerviousPrimaryEmail($datas->personUid);
            $setprimaryEmail = $this->personInterface->setPirmaryEmail($datas);
            $message = ['status' => 'primary changed Successfully', 'type' => 1];
        } else {
            $message = ['status' => 'OTP Validation Failed ', 'type' => 2];
        }

        return $this->commonService->sendResponse($message, '');

    }
    public function resendOtpForSecondaryMobile($datas)
    {
        $datas = (object) $datas;
        $otp = $this->sendingOtp();
        $resendOtpSecondaryMobile = $this->personInterface->resendOtpForSecondaryMobileNo($datas->uid, $datas->number, $otp);
        return $this->commonService->sendResponse($resendOtpSecondaryMobile, '');
    }
    public function OtpValidateSecondaryMobileNo($datas)
    {
        $datas = (object) $datas;
        $checkMobile = $this->personInterface->getSecondaryMobileNoByUid($datas->mobileNo, $datas->personUid);
        if ($checkMobile->otp_received == $datas->otp) {
            $result = $this->personInterface->secondaryMobileNoValidationId($checkMobile->uid, $checkMobile->mobile_no);
        } else {
            $result = ['message' => 'Failed', 'status' => 'OTP validation Failed'];
        }
        return $result;
    }
    public function otpValidationForMobile($datas)
    {

        $datas = (object) $datas;
        $checkMobile = $this->personInterface->getMobileNoByUid($datas->mobileNo, $datas->personUid);
        if ($checkMobile->otp_received == $datas->otp) {
            $result = $this->personInterface->secondaryMobileNoValidationId($checkMobile->uid, $checkMobile->mobile_no);
        } else {
            $result = ['message' => 'Failed', 'status' => 'OTP validation Failed'];
        }
        return $result;
    }
    public function OtpValidateForSecondaryEmail($datas)
    {
        $datas = (object) $datas;
        $checkEmail = $this->personInterface->getSecondaryEmailByUid($datas->email, $datas->personUid);

        if ($checkEmail->otp_received == $datas->otp) {
            $result = $this->personInterface->secondaryEmailValidationId($checkEmail->uid, $checkEmail->email);
        } else {
            $result = ['message' => 'Failed', 'status' => 'OTP validation Failed'];
        }
        return $result;
    }
    public function resendOtpForSecondaryEmail($datas)
    {

        $datas = (object) $datas;
        $otp = $this->sendingOtp();
        $resendOtpSecondaryEmail = $this->personInterface->resendOtpForSecondaryEmail($datas->personUid, $datas->email, $otp);
        return $this->commonService->sendResponse($resendOtpSecondaryEmail, '');
    }

    public function createPersonTableByUid($uid)
    {
        if ($uid) {
            Schema::create($uid, function ($table) {
                $table->id();
                $table->string('org_id');
                $table->integer('pfm_active_status_id')->nullable();
                $table->integer('deleted_flag')->nullable();
                $table->timestamps();
                $table->timestamp('deleted_at')->nullable();
            });
        }

    }
}
