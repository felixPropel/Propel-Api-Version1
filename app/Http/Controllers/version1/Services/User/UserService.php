<?php

namespace App\Http\Controllers\version1\Services\User;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserService
{
    public function __construct(UserInterface $userInterface, PersonInterface $personInterface, CommonService $commonService, OrganizationInterface $OrganizationInterface)
    {
        $this->userInterface = $userInterface;
        $this->personInterface = $personInterface;
        $this->commonService = $commonService;
        $this->OrganizationInterface = $OrganizationInterface;
    }
    public function loginUser($objdatas)
    {
              Log::info('UserService > loginUser function Inside.' . json_encode($objdatas));
        $datas = (object) $objdatas;
        $validator = Validator::make($objdatas, [
            'userName' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $verifyUser = $this->userInterface->verifyUserForMobile($datas);
                $uid = $verifyUser->uid;
        $personDetail = $this->personInterface->getPersonPicAndPersonName($uid);
        $nickName = $personDetail->nick_name ?? null;
        $firstName = $personDetail->first_name ?? null;
        $personPic = $personDetail->PersonPic->profile_pic ?? null; 
        Log::info('UserService > loginUser function Return.' . json_encode($verifyUser));
        if ($verifyUser) {
            if (Hash::check($datas->password, $verifyUser->password)) {
                             $token = $verifyUser->createToken('Laravel Password Grant Client')->accessToken;
                $personStatus = $this->personInterface->checkPersonExistence($uid);
                $personType = $personStatus ? $personStatus->existence : null;
                $defaultOrg = $this->OrganizationInterface->getPerviousDefaultOrganization($uid);
                $response = ['personType' => $personType, 'token' => $token, 'uid' => $uid, 'defaultOrg' => $defaultOrg, 'nickName' => $nickName, 'firstName' => $firstName, 'personPic' => $personPic];
                return $this->commonService->sendResponse($response, "");
            } else {
                $response = ["message" => "Password mismatch", 'firstName' => $firstName, 'uid' => $uid];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }
    public function storeUser($data)
    {
               Log::info('UserService > storeUser function Inside.' . json_encode($data));
        $validator = Validator::make($data, [
            'password' => 'required|string|max:255',
            'passwordConfirmation' => 'required|string|same:password',
        ]);
        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $datas = (object) $data;
        $personModel = $this->personInterface->getPrimaryMobileAndEmailbyUid($datas->uid);
        $personData=['mobile'=>$personModel->mobile->mobile_no,'email'=>$personModel->email->email];
        $model = $this->convertToUserModel($personData, $datas);
        $storeUser = $this->userInterface->storeUser($model);
        Log::info('UserService > storeUser function Return.' . json_encode($storeUser));

        if ($storeUser['message'] == "Success") {

            return $this->commonService->sendResponse($storeUser['data'], $storeUser['message']);
        } else {
            return $this->commonService->sendError($storeUser['data'], $storeUser['message']);
        }
    }
    public function changePassword($datas)
    {
        Log::info('UserService > changePassword function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $user = $this->userInterface->findUserDataByUid($datas->uid);
        Log::info('UserService > changePassword function Return.' . json_encode($user));
        if (Hash::check($datas->oldPassword, $user->password)) {
            if ($datas->password == $datas->passwordConfirmation) {
                $password = Hash::make($datas->password);
                $user->password = $password;
                $model = $this->userInterface->storeUser($user);
                $model['status'] = 'Password Changed Successfully';
                return $model;
            } else {
                $model = ['message' => 'Failed', 'status' => 'confirm Password MisMatched'];
                return $model;
            }
            return $model;
        } else {
            $model = ['message' => 'Failed', 'status' => 'old Password MisMatched'];
            return $model;
        }
        return $this->commonService->sendResponse($model, '');
    }
    public function setNewPassword($datas)
    {
        Log::info('UserService > setNewPassword function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $user = $this->userInterface->findUserDataByUid($datas->uid);
        Log::info('UserService > setNewPassword function Return.' . json_encode($user));
        if ($user) {
            $password = Hash::make($datas->password);
            $user->password = $password;
            $model = $this->userInterface->storeUser($user);
            if ($model['message'] == "Success") {
                $userModel = $model['data'];
                $personModel = $this->personInterface->getPersonPrimaryDataByUid($userModel->uid);
                return $this->commonService->sendResponse($personModel, $model['message']);
            } else {
                return $this->commonService->sendError($model['data'], $model['message']);
            }
        }

    }
    public function convertToUserModel($personData, $datas)
    {
        Log::info('UserService > convertToUserModel function Inside.' . json_encode($datas));
        Log::info('UserService > convertToUserModel function Inside.' . json_encode($personData));
        $personData = (object) $personData;
        $model = new User();
        $model->uid = $datas->uid;
        $model->primary_email = $personData->email;
        $model->primary_mobile = $personData->mobile;
        $model->password = Hash::make($datas->password);
        $model->pfm_stage_id = 1;
        Log::info('UserService > convertToUserModel function Return.' . json_encode($model));
        return $model;
    }
    public function userCreation($datas)
    {

        Log::info('UserService > userCreation function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $mobile = $this->personInterface->getPrimaryMobileNumberByUid($datas->uid);
        $email = $this->personInterface->getPersonEmailByUid($datas->uid);
        $getPersonName = $this->personInterface->getPersonDatasByUid($datas->uid);
        $createuser = $this->UserCreate($mobile->mobile_no, $email->email, $datas);
        $saveUser = $this->userInterface->savedUser($createuser);
        $result = ['personName' => $getPersonName->first_name, 'mobileNumber' => $mobile->mobile_no];
        Log::info('UserService > userCreation function Return.' . json_encode($result));
        return $this->commonService->sendResponse($result, '');
    }
    public function UserCreate($mobile, $email, $datas)
    {
        Log::info('UserService > UserCreate function Inside.' . json_encode($datas));
        $model = $this->userInterface->findUserDataByUid($datas->uid);
        if ($model) {
            $model->uid = $datas->uid;
        } else {
            $model = new User();
            $model->uid = $datas->uid;
        }
        $model->primary_email = $email;
        $model->primary_mobile = $mobile;
        $model->password = Hash::make($datas->password);
        $model->pfm_stage_id = 1;
        Log::info('UserService > UserCreate function Return.' . json_encode($model));
        return $model;
    }
}
