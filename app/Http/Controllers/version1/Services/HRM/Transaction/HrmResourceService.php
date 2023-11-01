<?php

namespace App\Http\Controllers\version1\Services\HRM\Transaction;

use App\Http\Controllers\version1\Interfaces\Common\commonInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDesignationInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Transaction\HrmResourceInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Http\Controllers\version1\Services\Person\PersonService;
use App\Models\HrmResource;
use App\Models\HrmResourceDesignation;
use App\Models\HrmResourceSr; 
use App\Models\HrmResourceSrAffinity;
use App\Models\HrmResourceTypeAffinity;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Class HrmResourceService.
 * @package App\Services
 */
class HrmResourceService
{

    public function __construct(PersonService $personService, PersonInterface $personInterface, UserInterface $userInterface, HrmResourceInterface $hrmResourceInterface, CommonService $commonService, commonInterface $commonInterface, HrmDepartmentInterface $hrmDeptInterface, HrmDesignationInterface $hrmDesInterface, HrmHumanResourceTypeInterface $hrmResourceTypeInterface)
    {
        $this->personService = $personService;
        $this->personInterface = $personInterface;
        $this->userInterface = $userInterface;
        $this->hrmResourceInterface = $hrmResourceInterface;
        $this->commonService = $commonService;
        $this->commonInterface = $commonInterface;

        $this->hrmDeptInterface = $hrmDeptInterface;
        $this->hrmDesInterface = $hrmDesInterface;
        $this->hrmResourceTypeInterface = $hrmResourceTypeInterface;
    }

    public function findAll($orgId)
    {

        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $resources = $this->hrmResourceInterface->findAll();
     

        $resourceDetails = $resources->map(function ($resource) {

            $personUid = $resource->uid;
            $resourceId = $resource->id;
            $personDetails = $resource->Person->personDetails;
            $personName = "{$personDetails->first_name} {$personDetails->last_name} {$personDetails->nick_name}";
            $department = $resource->resourceDesignation->ParentHrmDesignation->department->department_name;
            $designation = $resource->resourceDesignation->ParentHrmDesignation->designation_name;
            $resourceStatus = isset($resource->resourceSr->active_status_id) ? $resource->resourceSr->active_status_id : null;
            

            return [
                'designation' => $designation,
                'department' => $department,
                'resourceName' => $personName,
                'resourceId' => $resourceId,
                'uid' => $personUid,
                'resourceStatus' => $resourceStatus,
            ];
        });
        return $this->commonService->sendResponse($resourceDetails, '');
    }
    public function findResourceWithCredentials($datas, $orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $datas = (object) $datas;
        $mobile = $datas->mobileNo;
        $email = $datas->email;
        $checkPerson = $this->personInterface->findExactPersonWithEmailAndMobile($email, $mobile);
      

        /*Some Important Types credential Type Start */
        /* 1.get All Person */
        /* 2.None*/
        /* 3.Person Email Only */
        /* 4.Resource True */
        /* 5.Resource false */
        /* 6.SameOrganizationUser/employee*/
        /* 7. NotInSameOrganizationUser */

        /*Some Important Types credential Type End */
        if ($checkPerson) {
          
            $uid = $checkPerson->uid;
            $checkUserWithUid = $this->personInterface->checkUserByuid($uid);
            if ($checkUserWithUid) {
                $userWithInOrganization = $this->hrmResourceInterface->findResourceByUid($uid);
                if ($userWithInOrganization) {
                    $results = ['type' => 6, 'status' => "SameOrganizationUser", 'data' => ""];
                } else {
                    $getUserName = $this->personInterface->getPersonDatasByUid($uid);
                    $results = ['type' => 7, 'data' => $getUserName, 'mobile' => $checkUserWithUid];
                }
                return $this->commonService->sendResponse($results, '');
            } else {
                $checkResource = $this->hrmResourceInterface->findResourceByUid($uid);
                if ($checkResource) {
                    $resData = ['type' => 4, 'Resuid' => $uid];
                } else {
                    $person_details = $this->personInterface->getPrimaryMobileAndEmailbyUid($uid);
                    $resData = ['type' => 5, 'PersonDatas' => $person_details];
                }
                return $this->commonService->sendResponse($resData, '');
            }
        } else {
            $personMobile = $this->personInterface->getPersonDataByMobileNo($mobile);
            $personEmail = $this->personInterface->getPersonDataByEmail($email);
            if ($personMobile  !== null || $personEmail !== null) {
                $personData=['personMobile'=>$personMobile->mobile,'personEmail'=>$personEmail->email];
                $resData = ['type' => 1, 'PersonDatas' => $personData];
            } else {
                $resData = ['type' => 2, 'status' => 'freshResource', 'mobile' => $mobile, 'email' => $email];
            }
        }
        return $this->commonService->sendResponse($resData, '');
    }
    public function findDesignationByDepartmentId($datas, $orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);

        $datas = (object) $datas;
        $deptId = $datas->deptId;
        $response = $this->hrmDesInterface->findByDeptId($deptId);

        return $this->commonService->sendResponse($response, '');
    }

    public function getResourceMasterData($orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $masterDatas = $this->commonService->getPersonMasterData();
        $hrmDepartmentLists = $this->hrmDeptInterface->findAll();
        $hrmDesignationLists = $this->hrmDesInterface->findAll();
        $hrmResourceTypeLists = $this->hrmResourceTypeInterface->index();

        $masterDatas['hrmDepartmentLists'] = $hrmDepartmentLists;
        $masterDatas['hrmDesignationLists'] = $hrmDesignationLists;
        $masterDatas['hrmResourceTypeLists'] = $hrmResourceTypeLists;

        return $this->commonService->sendResponse($masterDatas, '');
    }
    public function resourceRelive($datas, $orgId)
    {

        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
                $datas = (object) $datas;
        $cModel = $this->convertToResourceReliveModel($datas);
        $model = "";

    }
    public function convertResourceServiceDetails($datas, $id)
    {
        $model = new HrmResourceSrAffinity();
        $model->resource_sr_id = $id;
        $model->activity_id = isset($datas->reliveTypeId) ? $datas->reliveTypeId : 1;
        $model->date = date('Y-m-d', strtotime($datas->date));
        $model->reason = isset($datas->reason) ? $datas->reason : null;
        return $model;
    }
    public function save($datas, $orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
      
        $orgdatas = (object) $datas;
        $personModelresponse = $this->personService->storePerson($datas, 'resource');

        if ($personModelresponse['message'] == "Success") {

            $personModel = $personModelresponse['data'];

            $uid = $personModel->uid;
            Log::info('HrmResourceService > saveUid.' . json_encode($uid));

            $convertToResourceModel = $this->convertToResourceModel($orgdatas, $uid);
            Log::info('HrmResourceService > convertToResourceModel.' . json_encode($convertToResourceModel));

            //$resourceModel = $this->hrmResourceInterface->saveResourceModel($convertToResourceModel);
            $convertToResourceTypeDetailModel = $this->convertToResourceTypeDetailModel($orgdatas);
                        $convertToResourceDesignationModel = $this->convertToResourceDesignationModel($orgdatas);
            Log::info('HrmResourceService > convertToResourceDesignationModel.' . json_encode($convertToResourceDesignationModel));

            $convertToResourceService = $this->convertToResourceService($orgdatas);
            Log::info('HrmResourceService > convertToResourceService.' . json_encode($convertToResourceService));

            $convertToResourceServiceDetails = $this->convertToResourceServiceDetails($orgdatas);
            Log::info('HrmResourceService > convertToResourceServiceDetails.' . json_encode($convertToResourceServiceDetails));

            $convertToUserAccountModel = $this->convertToUserAccountModel($orgId);
            Log::info('HrmResourceService > convertToUserAccountModel.' . json_encode($convertToUserAccountModel));
 

            $allModels = [
                'resourceModel' => $convertToResourceModel,
                 'resourceTypeDetailModel' => $convertToResourceTypeDetailModel,
                 'resourceDesignModel' => $convertToResourceDesignationModel,
                'resourceServiceModel' => $convertToResourceService,
                'ResourceServiceDetailsModel' => $convertToResourceServiceDetails,
                'userAccountModel' => $convertToUserAccountModel,
            ];

            $saveResourceModel = $this->hrmResourceInterface->saveResource($allModels);
           

            log::info('saveResource ' . json_encode($saveResourceModel));
            return $this->commonService->sendResponse($saveResourceModel, '');
        }
    }
    public function convertToResourceModel($datas, $uid)
    {
        $model = HrmResource::where('uid', isset($datas->personUid))->first();
        if ($model) {
            $model->uid = $uid;
        } else {
            $model = new HrmResource();
            $model->uid = $uid;
        }
        $model->resource_code = $datas->resourceCode;
        return $model;
    }

    public function convertToResourceTypeDetailModel($datas)
    {
        //dd($datas);
        $model = new HrmResourceTypeAffinity();
        $model->resource_type_id = $datas->resourceTypeId;
        return $model;
    }

    public function convertToResourceDesignationModel($datas)
    {
        //dd($datas);
        $model = new HrmResourceDesignation();
        $model->designation_id = $datas->designationId;
        return $model;
    }
    public function convertToResourceService($datas)
    {
        $model = new HrmResourceSr();
        $model->hrm_resource_activity_status_id = 1;
        log::info('hrmResourceService   HrmResourceSr ' . json_encode($model->date_of_joining));
        return $model;
    }
    public function convertToResourceServiceDetails($datas)
    {
        $model = new HrmResourceSrAffinity();
        $model->activity_id = 1;
        $model->date = date('Y-m-d', strtotime($datas->resourceJoinDate));
        $model->reason = isset($datas->reason) ? $datas->reason : null;
        log::info('hrmResourceService   HrmResourceSr ' . json_encode($model->date_of_joining));
        return $model;
    }
    public function convertToUserAccountModel($orgId)
    {
        $model = new UserOrganizationRelational();
        $model->organization_id = $orgId;
        return $model;
    }
    public function resourceMobileOtp($uid, $orgId)
    {
        log::info('hrmResourceService   otp ' . json_encode($uid));

        log::info('hrmResourceService object  otp ' . json_encode($uid));
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $otp = random_int(1000, 9999);
        $model = PersonMobile::where("uid", $uid)->update(['otp_received' => $otp]);
        if ($model) {
            $result = ['type' => 1, 'status' => "OtpSuccessfully", 'uid' => $uid];
        } else {
            $result = ['type' => 2, 'status' => "OtpFailed", 'datas' => ""];
        }
        return $this->commonService->sendResponse($result, '');
    }
    public function resourceEmailOtp($datas, $orgId)
    {
        $datas = (object) $datas;
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $otp = random_int(1000, 9999);
        $model = PersonEmail::where("uid", $datas->uid)->update(['otp_received' => $otp]);
        if ($model) {
            $result = ['type' => 1, 'status' => "OtpSuccessfully", 'datas' => $datas];
        } else {
            $result = ['type' => 2, 'status' => "OtpFailed", 'datas' => ""];
        }
        return $this->commonService->sendResponse($result, '');
    }
    public function resourceOtpValidate($datas, $orgId)
    {
        $datas = (object) $datas;
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->personInterface->getMobileNumberByuid($datas->uid, $datas->mobile);
        if ($model->otp_received == $datas->otp) {
            $saluationLists = $this->commonInterface->getSalutation();
            $bloodGroupLists = $this->commonInterface->getAllBloodGroup();
            $genderLists = $this->commonInterface->getAllGender();
            $maritalStatusLists = $this->commonInterface->getMaritalStatus();
            $addressOfLists = $this->commonInterface->getAddrerssType();
            $hrmDepartmentLists = $this->hrmDeptInterface->findAll();
            $hrmDesignationLists = $this->hrmDesInterface->findAll();
            $hrmResourceTypeLists = $this->hrmResourceTypeInterface->index();
            $languageLists = $this->commonInterface->getLanguage();
            $getLanguageByuid = $this->personInterface->motherTongueByuid($datas->uid);
            $idDocumentTypes = $this->commonInterface->getAllDocumentType();
            $bankAccountTypes = $this->commonInterface->getAllBankAccountType();
            $getPersonPrimaryData = $this->personInterface->getPersonPrimaryDataByuid($datas->uid);
            $anniversaryDate = $this->personInterface->getAnniversaryDate($datas->uid);
            $personAddress = $this->personInterface->personAddressByuid($datas->uid);

            $allDatas = [
                'type' => 1,
                'status' => "OTP SuccessFully",
                'salutation' => $saluationLists,
                'bloodGroup' => $bloodGroupLists,
                'gender' => $genderLists,
                'addressOf' => $addressOfLists,
                'hrmDepartment' => $hrmDepartmentLists,
                'hrmDesignation' => $hrmDesignationLists,
                'idDocumentTypes' => $idDocumentTypes,
                'getPersonPrimaryData' => $getPersonPrimaryData,
                'maritalStatus' => $maritalStatusLists,
                'hrmResourceType' => $hrmResourceTypeLists,
                'language' => $languageLists,
                'bankAccount' => $bankAccountTypes,
                'otherLanguages' => $getLanguageByuid,
                'anniversaryDate' => $anniversaryDate,
                'personAddress' => $personAddress,
            ];
        } else {
            $allDatas = ['Status' => 'OTP InValid', 'datas' => ''];
        }

        return $this->commonService->sendResponse($allDatas, '');
    }
    public function resourceEmailOtpValidate($datas, $orgId)
    {
        $datas = (object) $datas;
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->personInterface->emailOtpValidation($datas->uid);
        if ($model->otp_received == $datas->otp) {
            $saluationLists = $this->commonInterface->getSalutation();
            $bloodGroupLists = $this->commonInterface->getAllBloodGroup();
            $genderLists = $this->commonInterface->getAllGender();
            $maritalStatusLists = $this->commonInterface->getMaritalStatus();
            $addressOfLists = $this->commonInterface->getAddrerssType();
            $hrmDepartmentLists = $this->hrmDeptInterface->findAll();
            $hrmDesignationLists = $this->hrmDesInterface->findAll();
            $hrmResourceTypeLists = $this->hrmResourceTypeInterface->index();
            $languageLists = $this->commonInterface->getLanguage();
            $getLanguageByuid = $this->personInterface->motherTongueByuid($datas->uid);
            $idDocumentTypes = $this->commonInterface->getAllDocumentType();
            $bankAccountTypes = $this->commonInterface->getAllBankAccountType();
            $getPersonPrimaryData = $this->personInterface->getPersonPrimaryDataByuid($datas->uid);
            $anniversaryDate = $this->personInterface->getAnniversaryDate($datas->uid);
            $personAddress = $this->personInterface->personAddressByuid($datas->uid);

            $allDatas = [
                'type' => 1,
                'status' => "OTP SuccessFully",
                'salutation' => $saluationLists,
                'bloodGroup' => $bloodGroupLists,
                'gender' => $genderLists,
                'addressOf' => $addressOfLists,
                'hrmDepartment' => $hrmDepartmentLists,
                'hrmDesignation' => $hrmDesignationLists,
                'idDocumentTypes' => $idDocumentTypes,
                'getPersonPrimaryData' => $getPersonPrimaryData,
                'maritalStatus' => $maritalStatusLists,
                'hrmResourceType' => $hrmResourceTypeLists,
                'language' => $languageLists,
                'bankAccount' => $bankAccountTypes,
                'otherLanguages' => $getLanguageByuid,
                'anniversaryDate' => $anniversaryDate,
                'personAddress' => $personAddress,
            ];
        } else {
            $allDatas = ['Status' => 'OTP InValid', 'datas' => ''];
        }

        return $this->commonService->sendResponse($allDatas, '');
    }
    public function resourceMasterDataAndPersonData($datas, $orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $masterDatas = $this->commonService->getPersonMasterData();
        $hrmDepartmentLists = $this->hrmDeptInterface->findAll();
        $hrmDesignationLists = $this->hrmDesInterface->findAll();
        $hrmResourceTypeLists = $this->hrmResourceTypeInterface->index();
        $personDetails = $this->personService->personProfileDetails($datas);
        $result = [
            'masterDatas' => $masterDatas,
            'hrmDepartmentLists' => $hrmDepartmentLists,
            'hrmDesignationLists' => $hrmDesignationLists,
            'hrmResourceTypeLists' => $hrmResourceTypeLists,
            'personDetails' => $personDetails,
        ];
        return $this->commonService->sendResponse($result, '');
    }
    }
