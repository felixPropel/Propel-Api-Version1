<?php

namespace App\Http\Controllers\version1\Services\Person;


use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PersonService
{
    public function __construct(PersonInterface $personInterface, CommonService $commonService)
    {
        $this->commonService = $commonService;
        $this->personInterface = $personInterface;
    }
    public function findMobileNumber($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->findUserDataByMobileNumber($datas->mobileNumber);
        if ($model) {
            $result = ['type' => 1, 'model' => $model, 'mobileNumber' => $datas->mobileNumber];
        } else {
            $result = ['type' => 0, 'model' => "", 'mobileNumber' => $datas->mobileNumber];
        }
        return $this->commonService->sendResponse($result, "");
    }

    public function findEmail($datas)
    {

        $datas = (object) $datas;
        $model = $this->personInterface->findUserDataByEmail($datas->email);

        if ($model) {
            $result = ['type' => 1, 'model' => $model, 'email' => $datas->email];
        } else {
            $result = ['type' => 0, 'model' => "", 'email' => $datas->email];
        }
        return $this->commonService->sendResponse($result, "");
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
