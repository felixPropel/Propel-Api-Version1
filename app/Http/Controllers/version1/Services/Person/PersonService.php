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
use Illuminate\Support\Facades\Log;
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
        $model = $this->userInterface->findUserDataByMobileNumber($datas->mobileNumber); // check user data
        $personModel = $this->personInterface->checkPersonByMobile($datas->mobileNumber);
        Log::info('PersonService > findMobileNumber function Return.' . json_encode($personModel));
        if ($model) {
            $personDatas = $this->personInterface->getPersonPrimaryDataByUid($model->uid);
            $result = ['type' => 1, 'personDatas' => $personDatas, 'model' => $model, 'mobileNumber' => $datas->mobileNumber, 'status' => "UserOnly"];
        } else {
            $result = ['type' => 0, 'model' => "", 'mobileNumber' => $datas->mobileNumber, 'status' => "checkingPerson"];
        }
        return $this->commonService->sendResponse($result, "");
    }

    public function findCredential($datas)
    {
        Log::info('PersonService > findCredential function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $checkPersonMobile = $this->personInterface->checkPersonByMobile($datas->mobileNumber);
        if (!empty($checkPersonMobile)) {
            $checkPersonEmail = $this->personInterface->checkPersonEmailByUid($datas->email, $checkPersonMobile->uid);
        }
        $personAllDetails = $this->personInterface->getDetailedAllPersonDataWithEmailAndMobile($datas->email, $datas->mobileNumber);
        if ($checkPersonMobile && $checkPersonEmail) {
            $result = ['type' => 1, 'personData' => $datas, 'uid' => $checkPersonMobile->uid, 'status' => 'ExactPerson'];
        } else if (!empty($personAllDetails)) {
            $result = ['type' => 2, 'personData' => $personAllDetails, 'status' => 'MappedPerson'];
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
            if ($responseModel->stage == 1) {
                $salutationModel = $this->commonService->getSalutation();
                $responseData = ['tempModel' => $storeTempPerson['data'], 'salutationModel' => $salutationModel];
            } else if ($responseModel->stage == 2) {
                $gender = $this->commonService->getAllGender();
                $bloodGroup = $this->commonService->getAllBloodGroup();
                $responseData = ['tempModel' => $responseModel, 'gender' => $gender, 'bloodGroup' => $bloodGroup];
            } elseif ($responseModel->stage == 3) {
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
        //    dd($datas);
        $datas['personUid'] = isset($datas['personUid']) ? $datas['personUid'] : null;

        $datas = (object) $datas;

        $personModel = $this->convertToPersonModel($datas);
        $personDetailModel = $this->convertToPersonDetailModel($datas);
        $personEmailModel = $this->convertToPersonEmailModel($datas);
        $personMobileModel = $this->convertToPersonMobileModel($datas);
        $personProfileModel = $this->convertTopersonProfileModel($datas);

        $personAnotherEmailModel = array();

        if (!empty($datas->secondEmail)) {
            $personAnotherEmailModel = $this->convertToPersonEmailModelAnother($datas);
        }
        $personAnotherMobileModel = array();
        if (!empty($datas->secondNumber)) {
            $personAnotherMobileModel = $this->convertToPersonMobileModelAnother($datas);
        }
        $personWebLink = array();
        if (!empty($datas->webLinks)) {
            $personWebLink = $this->convertToPersonWebLink($datas);
        }
        $personOtherLanguage = array();
        if (!empty($datas->otherLanguage)) {
            $personOtherLanguage = $this->convertToPersonOtherLanguage($datas);
        }
        $personIdDocument = array();
        if (!empty($datas->idDocumentType)) {
            $personIdDocument = $this->convertToPersonIdDocumnet($datas);
        }
        $personEducationModel = array();
        if (!empty($datas->Qualification)) {
            $personEducationModel = $this->convertToPersonEducation($datas);
        }
        $personProfessionModel = array();
        if (!empty($datas->ProfessionDepartment)) {
            $personProfessionModel = $this->convertToPersonProfession($datas);
        }

        $personCommonAddressModel = array();

        if (!empty($datas->addressOf)) {
            $personCommonAddressModel = $this->convertToPersonCommonAddress($datas);
        }
        $personAddressId = array();
        if (!empty($datas->addressOf)) {
            $personAddressId = $this->convertToPersonAddressId();
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

        ];
        $personData = $this->personInterface->storePerson($allModels);
        log::info('allModels' . json_encode($personData));

        Log::info('PersonService > storePerson function Return.' . json_encode($personData));
        if ($type) {
            return $personData;
        } else {
            if ($personData['message'] == "Success") {
                return $this->commonService->sendResponse($personData['data'], $personData['message']);
            } else {
                return $this->commonService->sendError($personData['data'], $personData['message']);
            }
        }
    }

    public function convertTopersonProfileModel($datas)
    {
        if ($datas->profilePhoto) {
            Log::info('PersonService > convertTopersonProfileModel function Inside.' . json_encode($datas->profilePhoto));
            $image = $datas->profilePhoto;
            $file = null;
            \File::put(public_path() . '\assets\\profile\\' . $image, $file);
            if ($datas->personUid) {
                $model = $this->personInterface->getPersonProfileByUid($datas->personUid);
            }
            if ($model) {
                $model->profile_pic = $image;
                $model->status = 1;
                $model->profile_cachet = 1;
                $model->save();
                return $model;
            } else {
                $model = new PersonProfilePic();
                $model->uid = $datas->personUid;
                $model->profile_pic = $image;
                $model->status = 1;
                $model->profile_cachet = 1;
                $model->save();
                return $model;
            }

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

                $mobileNumber = isset($tempPersonModel['mobile_no']) ? $tempPersonModel['mobile_no'] : "";
                $email = isset($tempPersonModel['email']) ? $tempPersonModel['email'] : "";
                $salutation = isset($personalDatas['salutation']) ? $personalDatas['salutation'] : "";
                $firstName = isset($personalDatas['firstName']) ? $personalDatas['firstName'] : "";
                $middleName = isset($personalDatas['middleName']) ? $personalDatas['middleName'] : "";
                $lastName = isset($personalDatas['lastName']) ? $personalDatas['lastName'] : "";
                $nickName = isset($personalDatas['nickName']) ? $personalDatas['nickName'] : "";
                $gender = isset($personalDatas['gender']) ? $personalDatas['gender'] : "";
                $bloodGroup = isset($personalDatas['bg']) ? $personalDatas['bg'] : "";
                $dob = isset($personalDatas['dob']) ? $personalDatas['dob'] : "";
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
        $model->stage = 1;
        $model->origin = 1;
        $model->existence = 1;
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
            $model->stage = $stage;
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
        $model->salutation_id = $datas->salutationId;
        $model->first_name = $datas->firstName;
        $model->middle_name = isset($datas->middleName) ? $datas->middleName : '';
        $model->last_name = isset($datas->lastName) ? $datas->lastName : '';
        $model->nick_name = isset($datas->nickName) ? $datas->nickName : '';
        // $model->dob = $datas->dob;
        $model->birth_place = isset($datas->birthCity) ? $datas->birthCity : '';
        $model->marital_id = isset($datas->maritalStatus) ? $datas->maritalStatus : null;
        $model->gender_id = isset($datas->genderId) ? $datas->genderId : '';
        $model->blood_group_id = isset($datas->bloodGroup) ? $datas->bloodGroup : '';

        Log::info('PersonService > convertToPersonDetailModel function Return.' . json_encode($model));

        return $model;
    }
    public function convertToPersonMobileModel($datas)
    {
        Log::info('PersonService > convertToPersonMobileModel function Inside.' . json_encode($datas));
        if ($datas->personUid) {
            $model = $this->personInterface->getMobileNumberByUid($datas->personUid, $datas->mobileNumber);
            $model->mobile_no = $datas->mobileNumber;
            $model->mobile_cachet = 1;
        } else {
            $model = new PersonMobile();
            $model->mobile_no = $datas->mobileNumber;
            $model->mobile_cachet = 1;
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
            $model->email_cachet = 1;
        } else {
            $model = new PersonEmail();
            $model->email = $datas->email;
            $model->email_cachet = 1;
        }

        Log::info('PersonService > convertToPersonEmailModel function Return.' . json_encode($model));

        return $model;
    }
    public function convertToPersonEmailModelAnother($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonEmailModelAnother function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->secondEmail); $i++) {
            if ($datas->secondEmail[$i]) {
                $model[$i] = new PersonEmail();
                $model[$i]->email = $datas->secondEmail[$i];
                $model[$i]->email_cachet = 2;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonEmailModelAnother function Return.' . json_encode($orgModel));
    }
    public function convertToPersonMobileModelAnother($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonMobileModelAnother function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->secondNumber); $i++) {
            if ($datas->secondNumber[$i]) {
                $model[$i] = new PersonMobile();
                $model[$i]->mobile_no = $datas->secondNumber[$i];
                $model[$i]->mobile_cachet = 2;
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
        for ($i = 0; $i < count($datas->webLinks); $i++) {
            if ($datas->webLinks[$i]) {
                $model[$i] = new WebLink();
                $model[$i]->web_add = $datas->webLinks[$i];
                $model[$i]->web_cachet = 1;
                $model[$i]->status = 1;
                array_push($orgModel, $model[$i]);
            }
        }

        return $orgModel;
        Log::info('PersonService > convertToPersonWebLink function Return.' . json_encode($orgModel));
    }
    public function convertToPersonOtherLanguage($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonOtherLanguage function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->otherLanguage); $i++) {
            if ($datas->otherLanguage[$i]) {
                $model[$i] = new PersonLanguage();
                $model[$i]->language_id = $datas->otherLanguage[$i];
                $model[$i]->mother_tongue = $datas->motherLanguage;
                $model[$i]->status = 1;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonOtherLanguage function Return.' . json_encode($orgModel));
    }
    public function convertToPersonIdDocumnet($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonIdDocumnet function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->idDocumentType); $i++) {
            if ($datas->idDocumentType[$i]) {
                $model[$i] = new IdDocumentType();
                $model[$i]->person_doc_types = $datas->idDocumentType[$i];
                $model[$i]->Doc_no = $datas->documentNumber[$i];
                $model[$i]->doc_validity = $datas->validTill[$i];
                $model[$i]->attachment = $datas->attachments[$i];
                $model[$i]->status = 1;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonIdDocumnet function Return.' . json_encode($orgModel));
    }
    public function convertToPersonEducation($datas)
    {
        $orgModel = [];
        Log::info('PersonService > convertToPersonEducation function Inside.' . json_encode($datas));
        for ($i = 0; $i < count($datas->Qualification); $i++) {
            if ($datas->Qualification[$i]) {
                $model[$i] = new PersonEducation();
                $model[$i]->qualification = $datas->Qualification[$i];
                $model[$i]->education_place = $datas->university[$i];
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
                $model[$i]->department = $datas->ProfessionDepartment[$i];
                $model[$i]->designation = $datas->Designation[$i];
                $model[$i]->organization = $datas->organization[$i];
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
                $model[$i]->address_type = $datas->addressOf[$i];
                $model[$i]->door_no = $datas->doorNo[$i];
                $model[$i]->building_name = $datas->buildingName[$i];
                $model[$i]->pin = $datas->pinCode[$i];
                $model[$i]->area = $datas->area[$i];
                $model[$i]->street = $datas->street[$i];
                $model[$i]->land_mark = $datas->landMark[$i];
                $model[$i]->district = $datas->district[$i];
                $model[$i]->city_id = $datas->city[$i];
                $model[$i]->state_id = $datas->state[$i];
                $model[$i]->status = 1;
                array_push($orgModel, $model[$i]);
            }
        }
        return $orgModel;
        Log::info('PersonService > convertToPersonCommonAddress function Return.' . json_encode($orgModel));
    }
    public function convertToPersonAddressId()
    {
        $model = new PersonAddress();
        $model->address_cachet = 1;
        return $model;
        Log::info('PersonService > convertToPersonAddressId function Inside.' . json_encode($model));
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
    public function otpValidationForMobile($datas)
    {
        Log::info('PersonService > otpValidationForMobile function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $model = $this->personInterface->getOtpByUid($datas->uid, $datas->mobile_no);
        Log::info('PersonService > otpValidationForMobile  getOtpByUid function Return.' . json_encode($model));
        if ($datas->otp == $model->otp_received) {
            $status = PersonMobile::where(['uid' => $datas->uid, 'mobile_no' => $datas->mobile_no])->update(['mobile_cachet' => 2, 'mobile_validation' => 1, 'validation_updated_on' => Carbon::now()]);
            $result = ['personData' => $datas, 'status' => 'OtpValidateSuccess', 'type' => 1];
        } else {
            $result = ['personData' => "", 'status' => 'OtpValidatefailed', 'type' => 0];
        }
        return $result;
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
            $personData->salutation_id = $datas->salutation;
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
        return $this->commonService->sendResponse($datas->uid, '');
    }
    public function convertPerson($person, $datas)
    {
        Log::info('PersonService > convertPerson function Inside.' . json_encode($datas));
        Log::info('PersonService > convertPerson function Inside.' . json_encode($person));
        $person->uid = $datas->uid;
        $person->dob = $datas->dob;
        $person->gender_id = $datas->gender;
        $person->blood_group_id = $datas->bloodGroup;
        Log::info('PersonService > convertPerson function Return.' . json_encode($person));
        return $person;
    }
    public function generateEmailOtp($uid)
    {
        Log::info('PersonService > generateEmailOtp function Inside.' . json_encode($uid));
        $data = $this->personInterface->getPersonEmailByUid($uid);
        $otp = substr(str_shuffle("123456789"), 0, 5);
        $model = PersonEmail::where("uid", $uid)->update(["otp_received" => $otp, "email_validation_status" => 0]);
        Log::info('PersonService > generateEmailOtp function Return.' . json_encode($model));
        if ($model) {
            $response = ["message" => 'OK', 'route' => 'email_otp', "param" => ['uid' => $uid['uid'], 'email' => $data->email]];
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
            $email = PersonEmail::where(['uid' => $datas->uid, 'email' => $datas->email])->update(['email_validation_status' => 1, 'email_validation_updated_on' => Carbon::now()]);
            $result = ['status' => 'Otp verified', 'type' => 1, 'uid' => $uid];
        } else {
            $result = ['status' => 'Otp verified Failed', 'type' => 0, 'uid' => $uid];

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
        $personMasterData['PersonDatas'] = $personDetails;
        $personMasterData['PersonAddress'] = $personAddressByUid;
        $personMasterData['secondMobileAndEmail'] = $secondMobileAndEmail;

        Log::info('PersonService > personProfileDetails function Return.' . json_encode($personMasterData));
        return $this->commonService->sendResponse($personMasterData, '');
    }

    public function getDetailedAllPerson($datas)
    {
        Log::info('PersonService > getDetailedAllPerson function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $personAllDetails = $this->personInterface->getDetailedAllPersonDataWithEmailAndMobile($datas->email, $datas->mobileNumber);
        return $this->commonService->sendResponse($personAllDetails, '');

    }
    public function userProfileDatas($datas)
    {
        Log::info('PersonService > userProfileDatas function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $userProfiles = $this->personInterface->getAllDatasInUser($datas->uid);
        $entities = collect($userProfiles)->map(function ($users) {
            $personDetails = $users['personDetails'];
            $primaryMobile = $users['mobile'];
            $primaryEmail = $users['email'];
            $profilePic = $users['profilePic'];
            $personGender = $users['personDetails']['gender'];
            $personbloodGroup = $users['personDetails']['bloodGroup'];
            $primaryAddress = $users['personAddress']['ParentComAddress'];
            $personEducation = $users['personEducation'];
            $personProfession = $users['personProfession'];

            $data = ['userDeatils' => $personDetails, 'primaryMobile' => $primaryMobile, 'primaryEmail' => $primaryEmail, 'profilePic' => $profilePic, 'userGender' => $personGender, 'userBloodGroup' => $personbloodGroup, 'primaryAddress' => $primaryAddress, 'UserEducation' => $personEducation, 'userProfession' => $personProfession];

            return $data;
        });
        return $this->commonService->sendResponse($entities, '');
    }
    public function sendingOtp()
    {
        $otp = random_int(1000, 9999);
        return $otp;
    }
    public function addOtherMobileNumber($datas)
    {
        $datas = (object) $datas;
        Log::info('PersonService > addOtherMobileNumber123 function Inside.' . json_encode($datas->PersonUid));

        $checkPrimaryMobile = $this->personInterface->checkPersonByMobile($datas->mobileNo);
        if ($checkPrimaryMobile) {
            $model = ['users' => 'This Number Is Already Exists', 'type' => 1];
        } else {
            $model = new PersonMobile;
            $model->uid = $datas->PersonUid;
            $model->mobile_no = $datas->mobileNo;
            $model->mobile_cachet = 2;
            $model->otp_received = $this->sendingOtp();
            $model->validation_updated_on = null;
            $model->save();
        }
        return $this->commonService->sendResponse($model, '');
    }
    public function resendOtpForMobile($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->getMobileNumberByUid($datas->uid, $datas->mobile_no);
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
        $model = $this->personInterface->getMobileNumberByUid($datas->uid, $datas->mobile_no);
        if ($model) {
            $mobile = PersonMobile::where(['uid' => $datas->uid, 'mobile_no' => $datas->mobile_no])->update(['mobile_cachet' => 3, 'deleted_at' => Carbon::now()]);
            $data = ['Message' => ' MobileNumber is Deleted '];
        } else {
            $data = ['Message' => 'MobileNumber Not Found'];
        }
        return $this->commonService->sendResponse($data, '');
    }
    public function addOtherEmail($datas)
    {
        $datas = (object) $datas;
        $checkPrimaryEmail = $this->personInterface->checkPersonByEmail($datas->email);
        if ($checkPrimaryEmail) {
            $model = ['users' => 'This email Is Already Exists', 'type' => 1];
        } else {
            $model = new PersonEmail;
            $model->uid = $datas->PersonUid;
            $model->email = $datas->email;
            $model->email_cachet = 2;
            $model->otp_received = $this->sendingOtp();
            $model->email_validation_updated_on = null;
            $model->save();
        }
        return $this->commonService->sendResponse($model, '');
    }
    public function resendOtpForEmail($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->checkPersonEmailByUid($datas->email, $datas->uid);
        if ($model) {
            $mobile = PersonEmail::where(['uid' => $datas->uid, 'email' => $datas->email])->update(['otp_received' => $this->sendingOtp(), 'email_validation_updated_on' => null]);
            $data = ['Message' => ' Resend OTP Successfully'];
        } else {
            $data = ['Message' => 'Data Not Found'];
        }
        return $this->commonService->sendResponse($data, '');
    }
    public function deleteForEmailByUid($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->checkPersonEmailByUid($datas->email, $datas->uid);
        if ($model) {
            $mobile = PersonEmail::where(['uid' => $datas->uid, 'email' => $datas->email])->update(['email_cachet' => 3, 'deleted_at' => Carbon::now()]);
            $data = ['Message' => ' Email is Deleted '];
        } else {
            $data = ['Message' => 'Email Not Found'];
        }
        return $this->commonService->sendResponse($data, '');
    }
    public function mobileNumberChangeAsPrimary($datas)
    {
        $datas = (object) $datas;
        $otpValidation = $this->otpValidationForMobile($datas);
        if ($otpValidation['type'] == 1) {
            $perviousMobile = $this->personInterface->getPerviousPrimaryMobileNumber($datas->uid);
            if ($perviousMobile) {
                $updateMobile = PersonMobile::where(['uid' => $datas->uid, 'mobile_no' => $datas->mobile_no])->update(['mobile_cachet' => 1, 'mobileno_updated_on' => Carbon::now(), 'validation_updated_on' => Carbon::now()]);
                $message = ['status' => 'primary changed Successfully', 'type' => 1];
            } else {
                $message = ['status' => 'primary Not in Tables', 'type' => 0];
            }
            $result = $message;
        } else {
            $result = ['message' => 'OTP Validation Failed ', 'type' => 0];
        }
        return $this->commonService->sendResponse($result, '');
    }
    public function emailChangeAsPrimary($datas)
    {
        $datas = (object) $datas;
        $otpValidation = $this->emailOtpValidation($datas);
        if ($otpValidation['type'] == 1) {
            $perviousMobile = $this->personInterface->getPerviousPrimaryEmail($datas->uid);
            if ($perviousMobile) {
                $updateMobile = PersonEmail::where(['uid' => $datas->uid, 'email' => $datas->email])->update(['email_cachet' => 1, 'email_updated_on' => Carbon::now(), 'email_validation_updated_on' => Carbon::now()]);
                $message = ['status' => 'primary changed Successfully'];
            } else {
                $message = 'primary Not in Tables';
            }
            $result = $message;
        } else {
            $result = 'OTP Validation Failed ';
        }
        return $this->commonService->sendResponse($result, '');
    }
}
