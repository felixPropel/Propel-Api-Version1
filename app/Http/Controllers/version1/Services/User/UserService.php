<?php

namespace App\Http\Controllers\version1\Services\User;


use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function __construct(UserInterface $userInterface, PersonInterface $personInterface,CommonService $commonService)
    {
        $this->userInterface = $userInterface;
        $this->personInterface = $personInterface;
        $this->commonService = $commonService;
    }
    public function storeUser($data)
    {
        $datas = (object) $data;

        $personModel = $this->personInterface->getPersonPrimaryDataByUid($datas->uId);
        
        $model = $this->convertToUserModel($personModel, $datas);
        $storeUser = $this->userInterface->storeUser($model);
        if ($storeUser['message'] == "Success") {

            return $this->commonService->sendResponse($storeUser['data'], $storeUser['message']);
        } else {
            return $this->commonService->sendError($storeUser['data'], $storeUser['message']);
        }
    }

    public function convertToUserModel($personModel, $datas)
    {

        $model = new User();
        $model->uid = $personModel->uid;
        $model->primary_email = $personModel->email;
        $model->primary_mobile = $personModel->mobile_no;
        $model->password = Hash::make($datas->password);
        return $model;
    }
}
