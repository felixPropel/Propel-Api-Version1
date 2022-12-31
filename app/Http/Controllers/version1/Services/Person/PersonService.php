<?php

namespace App\Http\Controllers\version1\Services\Person;

use App\Http\Controllers\version1\Interfaces\Common\SmsInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Repositories\common\smsRepository;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Http\Controllers\version1\Services\Common\SmsService;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\TempPerson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\PersonLanguage;

use App\Models\WebLink;
use App\Models\PropertyAddress;

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
            if ($personModel) {
                $result = ['type' => 2, 'personUid' => $personModel['uid'], 'mobileNumber' => $datas->mobileNumber, 'status' => "PersonOnly"];
            } else {
                $result = ['type' => 0, 'model' => "", 'mobileNumber' => $datas->mobileNumber, 'status' => "NotInUser"];
            }
        }
        return $this->commonService->sendResponse($result, "");
    }

    public function findEmail($datas)
    {
        Log::info('PersonService > findEmail function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $model = $this->userInterface->findUserDataByEmail($datas->email);
        Log::info('PersonService > findEmail function Return.' . json_encode($model));

        if ($model) {
            $result = ['type' => 1, 'model' => $model, 'email' => $datas->email];
        } else {
            $result = ['type' => 0, 'model' => "", 'email' => $datas->email];
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
        $datas = (object) $datas;
        $personModel = $this->convertToPersonModel($datas);
        $personDetailModel = $this->convertToPersonDetailModel($datas);
        $personEmailModel = $this->convertToPersonEmailModel($datas);
        $personMobileModel = $this->convertToPersonMobileModel($datas);
        $personData = $this->personInterface->storePerson($personModel, $personDetailModel, $personEmailModel, $personMobileModel);
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
        Log::info('PersonService > checkPersonEmail function Return.' . json_encode($checkEmailByUid));
        if ($checkEmailByUid) {
            $result = ['type' => 1, 'personDatas' => $checkEmailByUid, 'mobileNumber' => $datas->mobileNumber, 'status' => "Email_In"];
        } else {
            $result = ['type' => 0, 'personDatas' => '', 'status' => "EmailNotFound"];
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

                return $this->commonService->sendError("Incorrect OTP", "Wrong Otp");
            }
        } else { }
    }

    public function convertToPersonModel($datas)
    {
        Log::info('PersonService > convertToPersonModel function Inside.' . json_encode($datas));
        $model = new Person();
        $model->uid = Str::uuid();
        $model->stage = 1;
        $model->origin = 1;
        $model->existence = 1;
        Log::info('PersonService > convertToPersonModel function Return.' . json_encode($model));
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
        $model = new PersonDetails();
        $model->salutation_id = $datas->salutationId;
        $model->first_name = $datas->firstName;
        $model->middle_name = $datas->middleName;
        $model->last_name = $datas->lastName;
        $model->nick_name = $datas->nickName;
        $model->dob = $datas->dob;
        $model->gender_id = $datas->genderId;
        $model->blood_group_id = $datas->bloodGroup;
        Log::info('PersonService > convertToPersonDetailModel function Return.' . json_encode($model));

        return $model;
    }
    public function convertToPersonMobileModel($datas)
    {
        Log::info('PersonService > convertToPersonMobileModel function Inside.' . json_encode($datas));
        $model = new PersonMobile();
        $model->mobile_no = $datas->mobileNumber;
        $model->mobile_cachet = 1;
        Log::info('PersonService > convertToPersonMobileModel function Return.' . json_encode($model));

        return $model;
    }
    public function convertToPersonEmailModel($datas)
    {
        Log::info('PersonService > convertToPersonEmailModel function Inside.' . json_encode($datas));
        $model = new PersonEmail();
        $model->email = $datas->email;
        $model->email_cachet = 1;
        Log::info('PersonService > convertToPersonEmailModel function Return.' . json_encode($model));

        return $model;
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
        return $this->commonService->sendResponse($datas, '');
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
    public function mobileOtpValidated($persondatas)
    {
        Log::info('PersonService > mobileOtpValidated function Inside.' . json_encode($persondatas));
        $datas = (object) $persondatas;
        $model = $this->personInterface->getOtpByUid($datas->uid);
        Log::info('PersonService > mobileOtpValidated function Return.' . json_encode($model));
        if ($datas->otp == $model->otp_received) {
            $status = PersonMobile::where("uid", $datas->uid)->update(['mobile_cachet' => 1, 'mobile_validation' => 1, 'validation_updated_on' => Carbon::now()]);
            return $this->commonService->sendResponse($persondatas, '');
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
    public function emailOtpValidation($datas)
    {
        Log::info('PersonService > emailOtpValidation function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $uid = $datas->uid;
        $model = $this->personInterface->getPersonEmailByUid($datas->uid);
        Log::info('PersonService > emailOtpValidation function Return.' . json_encode($model));
        if ($model->otp_received == $datas->otp) {
            return $this->commonService->sendResponse($uid, '');
        } else {
            return $this->commonService->sendError($uid, '');
        }
    }
    public function personProfileDetails($datas)
    {
        Log::info('PersonService > personProfileDetails function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $gender = $this->commonService->getAllGender();
        $blood = $this->commonService->getAllBloodGroup();
        $saluation = $this->commonService->getSalutation();
        $maritalStatus = $this->commonService->getMaritalStatus();
        $languages = $this->commonService->getLanguage();
        $personDetails = $this->personInterface->getPersonPrimaryDataByUid($datas->uid);
        // $personAddress = $this->personInterface->getPersonAddressByUid($datas->uid);
        // $states = $this->commonService->getAllStates();
        $address_of = $this->commonService->getAddrerssType();
        $result = ['uid' => $datas->uid, 'bloodGroup' => $blood, 'gender' => $gender, 'salutation' => $saluation, 'personData' => $personDetails, 'addressType' => $address_of, 'maritalStatus' => $maritalStatus, 'language' => $languages];
        Log::info('PersonService > personProfileDetails function Return.' . json_encode($result));
        return $this->commonService->sendResponse($result, '');
    }
    public function profileUpdate($datas)
    {
        Log::info('PersonService > profileUpdate function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $Person = $this->personInterface->getPersonDatasByUid($datas->uid);
        $updatePerson = $this->convertProfile($Person, $datas);
        $saveProfile = $this->personInterface->savePerson($updatePerson);
        $anniversary = $this->personInterface->getAnniversaryDate($datas->uid);
        $anniversaryDate = $this->anniversaryDate($anniversary, $datas);
        $saveAnniversary = $this->personInterface->saveAnniversaryDate($anniversaryDate);
        $motherTongue = $this->personInterface->motherTongueByUid($datas->uid);
        $convertMotherTongue = $this->convertMotherTongue($motherTongue, $datas);
        $updateMotherTongue = $this->personInterface->updateMotherTongue($convertMotherTongue);
        $addAddress = $this->addAddress($datas);
        if (!empty($datas->webLinks)) {
            $webLink = $this->addWebLink($datas);
            $addwebLink = $this->personInterface->addWebLink($webLink);
        }
        if (!empty($datas->otherMobile)) {
            if ($datas->uid) {
                foreach ($datas->otherMobile as $mobile) {
                    $convertOtherMobile = $this->ConvertotherMobile($datas->uid, $mobile);
                    $saveOtherMobile = $this->personInterface->saveOtherMobileByUid($convertOtherMobile);
                }
            }
        }
        if (!empty($datas->otherEmail)) {
            if ($datas->uid) {
                foreach ($datas->otherEmail as $email) {
                    $convertOtherEmail = $this->ConvertotherEmail($datas->uid, $email);
                    $saveOtherEmail = $this->personInterface->saveOtherEmailByUid($convertOtherEmail);
                }
            }
        }
        if (!empty($datas->otherLanguage)) {
            if ($datas) {
                foreach ($datas->otherLanguage as $language) {
                    $convertOtherLanguage = $this->ConvertotherLanguage($datas, $language);
                    $saveOtherLanguage = $this->personInterface->saveOtherLanguageByUid($convertOtherLanguage);
                }
            }
        }
    }


    public function convertProfile($person, $datas)
    {
        Log::info('PersonService > convertProfile function Inside.' . json_encode($datas));
        Log::info('PersonService > convertProfile function Inside.' . json_encode($person));
        if ($person) {
            $person->uid = $datas->uid;
            $person->salutation_id = $datas->Saluation;
            $person->first_name = $datas->firstName;
            $person->middle_name = $datas->middleName;
            $person->last_name = $datas->lastName;
            $person->nick_name = $datas->nickName;
            // $person->dob=$datas->dob;
            $person->birth_place = $datas->birthCity;
            $person->gender_id = $datas->gender;
            $person->blood_group_id = $datas->bloodGroup;
            $person->marital_id = $datas->maritalStatus;
            Log::info('PersonService > convertProfile function Return.' . json_encode($person));
            return $person;
        }
    }
    public function anniversaryDate($anniversary, $datas)
    {
        Log::info('PersonService > anniversaryDate function Inside.' . json_encode($datas));
        Log::info('PersonService > anniversaryDate function Inside.' . json_encode($anniversary));

        if ($anniversary) {
            $anniversary->uid = $datas->uid;
            $anniversary->anniversary_date = $datas->anniversaryDate;
            Log::info('PersonService > anniversaryDate function Return.' . json_encode($anniversary));
            return $anniversary;
        }
    }
    public function convertMotherTongue($motherTongue, $datas)
    {
        Log::info('PersonService > convertMotherTongue function Inside.' . json_encode($datas));
        Log::info('PersonService > convertMotherTongue function Inside.' . json_encode($motherTongue));
        if ($motherTongue) {
            $motherTongue->uid = $datas->uid;
            $motherTongue->mother_tongue = $datas->motherTongue;
            Log::info('PersonService > convertMotherTongue function Return.' . json_encode($motherTongue));
            return $motherTongue;
        }
    }
    public function ConvertotherEmail($uid, $email)
    {
        Log::info('PersonService > ConvertotherEmail function Inside.' . json_encode($uid));
        Log::info('PersonService > ConvertotherEmail function Inside.' . json_encode($email));
        if (isset($email)) {
            $model = new PersonEmail();
            $model->uid = $uid;
            $model->email = $email;
            $model->email_cachet = 2;
            $model->validation_updated_on = NULL;
            Log::info('PersonService > ConvertotherEmail function Return.' . json_encode($model));
            return $model;
        }
    }

    public function ConvertotherMobile($uid, $mobile)
    {
        Log::info('PersonService > ConvertotherMobile function Inside.' . json_encode($uid));
        Log::info('PersonService > ConvertotherMobile function Inside.' . json_encode($mobile));
        if (isset($mobile)) {
            $model = new PersonMobile();
            $model->uid = $uid;
            $model->mobile_no = $mobile;
            $model->mobile_cachet = 2;
            $model->validation_updated_on = NULL;
            Log::info('PersonService > ConvertotherMobile function Return.' . json_encode($model));
            return $model;
        }
    }

    public function ConvertotherLanguage($datas, $language)
    {
        Log::info('PersonService > ConvertotherLanguage function Inside.' . json_encode($datas));
        Log::info('PersonService > ConvertotherLanguage function Inside.' . json_encode($language));
        if (isset($language)) {
            $model = new PersonLanguage();
            $model->uid = $datas->uid;
            $model->language_id = $language;
            $model->mother_tongue = $datas->motherTongue;
            $model->read = NULL;
            $model->write = NULL;
            $model->spoken = NULL;
            $model->status = 0;
            Log::info('PersonService > ConvertotherLanguage function Return.' . json_encode($model));
            return $model;
        }
    }
    public function addWebLink($datas)
    {
        Log::info('PersonService > addWebLink function Inside.' . json_encode($datas));
        $model = new WebLink();
        $model->uid = $datas->uid;
        $model->web_add = $datas->webLinks;
        $model->web_cachet = 1;
        $model->status = 1;
        Log::info('PersonService > addWebLink function Return.' . json_encode($model));
        return $model;
    }
    public function addAddress($datas)
    {
        Log::info('PersonService > addAddress function Inside.' . json_encode($datas));
        $address = count($datas->addressOf);
        for ($i = 0; $i < $address; $i++) {
            $Model[$i] = new PropertyAddress();
            $Model[$i]->address_type = $datas->addressOf[$i];
            $Model[$i]->door_no = $datas->doorNo[$i];
            $Model[$i]->building_name = $datas->buildingName[$i];
            $Model[$i]->pin = $datas->pinCode[$i];
            $Model[$i]->area = $datas->area[$i];
            $Model[$i]->street = $datas->street[$i];
            $Model[$i]->land_mark = $datas->landMark[$i];
            $Model[$i]->district = $datas->district[$i];
            $Model[$i]->city_id = $datas->city[$i];
            $Model[$i]->state_id = $datas->state[$i];
            $Model[$i]->status = 1;
            $Model[$i]->save();
        }
    }
}
