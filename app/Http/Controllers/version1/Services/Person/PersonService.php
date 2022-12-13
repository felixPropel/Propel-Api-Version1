<?php

namespace App\Http\Controllers\version1\Services\Person;


use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\TempPerson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PersonService
{
    public function __construct(PersonInterface $personInterface, CommonService $commonService, UserInterface $userInterface)
    {
        $this->commonService = $commonService;
        $this->personInterface = $personInterface;
        $this->userInterface = $userInterface;
    }
    public function findMobileNumber($datas)
    {
        $datas = (object) $datas;
        $model = $this->userInterface->findUserDataByMobileNumber($datas->mobileNumber);
        $personModel = $this->personInterface->checkPersonByMobile($datas->mobileNumber);


        if ($model) {
            $result = ['type' => 1, 'model' => $model, 'mobileNumber' => $datas->mobileNumber, 'status' => "UserOnly"];
        } else {
            if ($personModel) {
                $result = ['type' => 1, 'model' => $model, 'mobileNumber' => $datas->mobileNumber, 'status' => "PersonOnly"];
            } else {
                $result = ['type' => 0, 'model' => "", 'mobileNumber' => $datas->mobileNumber, 'status' => "NotInUser"];
            }
        }
        return $this->commonService->sendResponse($result, "");
    }

    public function findEmail($datas)
    {

        $datas = (object) $datas;
        $model = $this->userInterface->findUserDataByEmail($datas->email);

        if ($model) {
            $result = ['type' => 1, 'model' => $model, 'email' => $datas->email];
        } else {
            $result = ['type' => 0, 'model' => "", 'email' => $datas->email];
        }
        return $this->commonService->sendResponse($result, "");
    }
    public function storeTempPerson($datas)
    {
        $datas = (object) $datas;
        $tempId = isset($datas->tempId) ? $datas->tempId : 0;

        $model = $this->convertToTempPersonModel($datas, $tempId);
        $storeTempPerson = $this->personInterface->storeTempPerson($model);
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
                $otp = random_int(1000, 9999);
                $newDatas  = ['otp' => $otp, 'stage' => 4];
                $newDatas = (object) $newDatas;
                $model1 = $this->convertToTempPersonModel($newDatas, $tempId);
                $storeTempPerson1 = $this->personInterface->storeTempPerson($model1);
                log::info('personservice > ' . json_encode($storeTempPerson1));
                if ($storeTempPerson1['message'] == "Success") {
                    $responseModel1 = $storeTempPerson1['data'];
                    $responseData = ['tempModel' => $responseModel1];
                } else {
                    return $this->commonService->sendError($storeTempPerson1['data'], $storeTempPerson1['message']);
                }
            }



            return $this->commonService->sendResponse($responseData, $storeTempPerson['message']);
        } else {
            return $this->commonService->sendError($storeTempPerson['data'], $storeTempPerson['message']);
        }
    }
    public function storePerson($datas)
    {
        $datas = (object) $datas;
        $personModel = $this->convertToPersonModel($datas);
        $personDetailModel = $this->convertToPersonDetailModel($datas);
        $personEmailModel = $this->convertToPersonEmailModel($datas);
        $personMobileModel = $this->convertToPersonMobileModel($datas);


        $personData = $this->personInterface->storePerson($personModel, $personDetailModel, $personEmailModel, $personMobileModel);
        if ($personData['message'] == "Success") {
            return $this->commonService->sendResponse($personData['data'], $personData['message']);
        } else {
            return $this->commonService->sendError($personData['data'], $personData['message']);
        }
    }

    public function convertToPersonModel($datas)
    {
        $model = new Person();
        $model->uid = Str::uuid();
        $model->stage = 1;
        $model->origin = 1;
        $model->existence = 1;
        return $model;
    }
    public function convertToTempPersonModel($datas, $id = null)
    {
        log::info('personService > ' . json_encode($datas));

        if ($id) {

            $model = TempPerson::findOrFail($id);
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
        $stage =   isset($datas->stage) ? $datas->stage : "";
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
        $model = new PersonDetails();
        $model->salutation_id = $datas->salutationId;
        $model->first_name = $datas->first_name;
        $model->gender_id = $datas->gender_id;
        $model->nationality_id = $datas->nationality_id;
        return $model;
    }
    public function convertToPersonMobileModel($datas)
    {
        $model = new PersonMobile();
        $model->mobile_no = $datas->mobileNumber;
        $model->mobile_cachet = 1;
        return $model;
    }
    public function convertToPersonEmailModel($datas)
    {
        $model = new PersonEmail();
        $model->email = $datas->email;
        $model->email_cachet = 1;
        return $model;
    }
}
