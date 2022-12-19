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
    public function __construct(UserInterface $userInterface, PersonInterface $personInterface, CommonService $commonService)
    {
        $this->userInterface = $userInterface;
        $this->personInterface = $personInterface;
        $this->commonService = $commonService;
    }
    public function loginUser($objdatas)
    {
        $datas = (object) $objdatas;

        $validator = Validator::make($objdatas, [
            'userName' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('primary_email', $datas->userName)->orWhere('primary_mobile', $datas->userName)->first();
        $uid = $user->uid;
        $user_name = PersonDetails::where('uid', $uid)->pluck('first_name')->first();


        if ($user) {
            if (Hash::check($datas->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token, 'uid' => $uid];
                return $this->commonService->sendResponse($response, "");
            } else {
                $response = ["message" => "Password mismatch", 'username' => $user_name, 'uid' => $uid];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
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
    public function changePassword($datas)
    {
        $datas = (object) $datas;
      
        $user = $this->userInterface->findUserDataByUid($datas->uid);
     
        if ($user) {
            $password = Hash::make($datas->password);
            $user->password = $password;
            $model = $this->userInterface->storeUser($user);

            if ($model['message'] == "Success") {
                $modeldata = $model['data'];
                $userData = $this->personInterface->getPersonPrimaryDataByUid($modeldata->uid);

                return $this->commonService->sendResponse($userData, $model['message']);
            } else {
                return $this->commonService->sendError($model['data'], $model['message']);
            }
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
