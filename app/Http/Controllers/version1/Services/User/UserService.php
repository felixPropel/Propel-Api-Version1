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
use Illuminate\Support\Facades\Log;

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
        Log::info('UserService > loginUser function Inside.' . json_encode($objdatas));
        $datas = (object) $objdatas;
        $validator = Validator::make($objdatas, [
            'userName' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('primary_email', $datas->userName)->orWhere('primary_mobile', $datas->userName)->first();
        $uid = $user->uid;
        $user_name = PersonDetails::where('uid', $uid)->pluck('first_name')->first();
        Log::info('UserService > loginUser function Return.' . json_encode($user));

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
        Log::info('UserService > storeUser function Inside.' . json_encode($data));
        $datas = (object) $data;
        $personModel = $this->personInterface->getPersonPrimaryDataByUid($datas->uId);
        $model = $this->convertToUserModel($personModel, $datas);
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
        if ($user) {
            $password = Hash::make($datas->password);
            $user->password = $password;
            $model = $this->userInterface->storeUser($user);

            if ($model['message'] == "Success") {
                $userModel = $model['data'];
                $personModel = $this->personInterface->getPersonPrimaryDataByUid($userModel->uid);

                return $this->commonService->sendResponse( $personModel, $model['message']);
            } else {
                return $this->commonService->sendError($model['data'], $model['message']);
            }
        }
    }
    public function convertToUserModel($personModel, $datas)
    {
        Log::info('UserService > convertToUserModel function Inside.' . json_encode($datas));
        Log::info('UserService > convertToUserModel function Inside.' . json_encode($personModel));
        $model = new User();
        $model->uid = $personModel->uid;
        $model->primary_email = $personModel->email;
        $model->primary_mobile = $personModel->mobile_no;
        $model->password = Hash::make($datas->password);
        Log::info('UserService > convertToUserModel function Return.' . json_encode($model));
        return $model;
    }
    public function userCreation($datas)
    {
        Log::info('UserService > userCreation function Inside.' . json_encode($datas));
        $datas = (object) $datas ;
        $mobile=$this->personInterface->getMobileNumberByUid($datas->uid);
        $email=$this->personInterface->getEmailByUid($datas->uid);
        $getPersonName=$this->personInterface->getPersonDatasByUid($datas->uid);
        $createuser=$this->UserCreate($mobile->mobile_no,$email->email,$datas);
        $saveUser=$this->userInterface->savedUser($createuser);
        $result=['personName'=>$getPersonName->first_name,'mobileNumber'=>$mobile->mobile_no];
        Log::info('UserService > userCreation function Return.' . json_encode($result));
        return $this->commonService->sendResponse($result,'');
    }
    public function UserCreate($mobile,$email,$datas)
    {
        Log::info('UserService > UserCreate function Inside.' . json_encode($datas));
        $model = new User();
        $model->uid = $datas->uid;
        $model->primary_email = $email;
        $model->primary_mobile = $mobile;
        $model->password = Hash::make($datas->password);
        Log::info('UserService > UserCreate function Return.' . json_encode($model));
        return $model;
    }
}
