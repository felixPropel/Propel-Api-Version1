<?php

namespace  App\Http\Controllers\version1\Services\HRM\Transaction;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDesignationInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Transaction\HrmResourceInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Http\Controllers\version1\Services\Person\PersonService;
use App\Interfaces\CommonInterface;
use App\Models\HrmResource;
use App\Models\HrmResourceWorking;
use App\Models\HrmResourceDoj;
use App\Models\HrmResourceDesignation;
use App\Models\HrmResourceReliveDetail;
use App\Models\HrmResourceTypeDetail;
use App\Models\Organization\UserOrganizationRelational;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
/**
 * Class HrmResourceService.
 * @package App\Services
 */
class HrmResourceService
{

    public function __construct(PersonService $personService, PersonInterface $personInterface, UserInterface $userInterface, HrmResourceInterface $hrmResourceInterface, CommonService $commonService, CommonInterface $commonInterface, HrmDepartmentInterface $hrmDeptInterface, HrmDesignationInterface $hrmDesInterface, HrmHumanResourceTypeInterface $hrmResourceTypeInterface)
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
        $models = $this->hrmResourceInterface->findAll();

        $entities = collect($models)->map(function ($model) {
            $designation = "";
            $department = "";
            $name = "";
            $status = "";

            if ($model['person']) {
                $personModel = $model['person'];
                if ($personModel['personDetails']) {
                    $personDetailModel = $personModel['personDetails'];
                    $name = $personDetailModel['first_name'] . " " . $personDetailModel['middle_name'] . " " . $personDetailModel['last_name'];
                }
            }
            if ($model['designation']) {
                $designModel = $model['designation'];
                if ($designModel['ParentHrmDesignation']) {
                    $descMasterModel = $designModel['ParentHrmDesignation'];
                    $designation = $descMasterModel['designation_name'];
                    if ($descMasterModel['department']) {
                        $resourceDeptModel = $descMasterModel['department'];
                        $department = $resourceDeptModel["department_name"];
                    }
                }
            }
            $params = ['designation' => $designation, 'department' => $department, 'resourceName' => $name, 'id' => $model->id];
            return $params;
        });

        return $this->commonService->sendResponse($entities, '');
    }
    public function findResourceWithCredentials($datas, $orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $datas = (object) $datas;
        $mobile = $datas->mobileNo;
        $email = $datas->email;
        $checkPerson = $this->personInterface->findExactPersonWithEmailAndMobile($email, $mobile);
        // $saluationLists = $this->commonInterface->getAllSalutions();
        // $bloodGroupLists=$this->commonInterface->getAllBloodGroups();
        // $genderLists=$this->commonInterface->getAllGenders();
        // $maritalStatusLists=$this->commonInterface->getAllMaritalstatus();
        // $addressOfLists=$this->commonInterface->getAllAddressOfLists();
        // $hrmDepartmentLists=$this->commonInterface->getAllHrmDepartmentLists();
        // $hrmDesignationLists=$this->commonInterface->getAllHrmDesignationLists();
        // $hrmResourceTypeLists=$this->commonInterface->getAllHrmResourceTypeLists();
        // $languageLists=$this->commonInterface->getAllLanguageLists();
        // $idDocumentTypes=$this->commonInterface->getAllIdDocumnetTypes();
        // $bankAccountTypes=$this->commonInterface->getAllBankAccountTypes();


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
            $uId = $checkPerson->uid;
            $checkUserWithUid =  $this->personInterface->checkUserByUID($uId);
            if ($checkUserWithUid) {
                $userWithInOrganization = $this->hrmResourceInterface->findResourceByUid($uId);
                if ($userWithInOrganization) {
                    $results = ['type' => 6, 'status' => "SameOrganizationUser", 'data' => ""];
                } else {
                    $getUserName = $this->personInterface->getPersonDatasByUid($uId);
                    $results = ['type' => 7, 'data' => $getUserName];
                }
                return $this->commonService->sendResponse($results, '');
            } else {
                $checkResource = $this->hrmResourceInterface->findResourceByUid($uId);
                if ($checkResource) {
                    $resData = ['type' => 4, 'ResUid' => $uId];
                } else {
                    $resData = ['type' => 5, 'PersonUid' => $uId];
                }
                return $this->commonService->sendResponse($resData, '');
            }
        } else {

            $getAllPersonByMobileAndEmail =  $this->personInterface->getDetailedAllPersonDataWithEmailAndMobile($email, $mobile);

            if (count($getAllPersonByMobileAndEmail)) {
                $resData = ['type' => 1, 'AllPersons' => $getAllPersonByMobileAndEmail];
            } else {
                $resData = ['type' => 2];
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
        dd($cModel);
    }

    public function convertToResourceReliveModel($datas)
    {


        $model = new HrmResourceReliveDetail();
        $model->reource_id = $datas->resourceId;
        $model->relive_type_id = $datas->reliveType;
        $model->relive_date = $datas->reliveDate;
        $model->reason = $datas->reason;
        return $model;
    }
    public function save($datas, $orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);

        $orgdatas = (object) $datas;

        $personModelresponse = $this->personService->storePerson($datas, 'resource');
        if ($personModelresponse['message'] == "Success") {
            $personModel = $personModelresponse['data'];
            $uId = $personModel->uid;


            $convertToResourceModel = $this->convertToResourceModel($orgdatas, $uId);
            //  $resourceModel = $this->hrmResourceInterface->saveResourceModel($convertToResourceModel);

            $convertToResourceTypeDetailModel = $this->convertToResourceTypeDetailModel($orgdatas);
            $convertToResourceDesignationModel = $this->convertToResourceDesignationModel($orgdatas);
            $convertToResourceDateOfJoin = $this->convertToResourceJoinDate($orgdatas);
            $convertToResourceWorking = $this->convertToResourceWorking($orgdatas);
            $convertToUserAccountModel = $this->convertToUserAccountModel($orgId);

            $allModels = [
                'resourceModel' => $convertToResourceModel,
                'resourceTypeDetailModel' => $convertToResourceTypeDetailModel,
                'resourceDesignModel' => $convertToResourceDesignationModel,
                'resourceJoinModel' => $convertToResourceDateOfJoin,
                'resourceWorkingModel' => $convertToResourceWorking,
                'userAccountModel' => $convertToUserAccountModel
            ];


            $saveResourceModel = $this->hrmResourceInterface->saveResource($allModels);

            log::info('saveResource ' . json_encode($saveResourceModel));
            return $this->commonService->sendResponse($saveResourceModel, '');
            // }else{

            // }    
        }
    }
    public function convertToResourceModel($datas, $uid)
    {

        $model = new HrmResource();
        $model->uid = $uid;
        $model->resource_code = $datas->resourceCode;
        return $model;
    }

    public function convertToResourceTypeDetailModel($datas)
    {
        //dd($datas);
        $model = new HrmResourceTypeDetail();
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
    public function convertToResourceJoinDate($datas)
    {
        $model = new HrmResourceDoj();
        $model->DOJ = '2021-10-11';
        return $model;
    }
    public function convertToResourceWorking($datas)
    {
        $model = new HrmResourceWorking();
        $model->active_state = 1;
        return $model;
    }
    public function convertToUserAccountModel($orgId)
    {
        $model = new UserOrganizationRelational();
        $model->organization_id = $orgId;
        return $model;
    }
    public function resourceMobileOtp($datas, $orgId)
    {

        $datas = (object) $datas;
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $otp = random_int(1000, 9999);
        $model = PersonMobile::where("uid", $datas->uid)->update(['otp_received' => $otp]);
        if ($model) {
            $result = ['type' => 1, 'status' => "OtpSuccessfully", 'datas' => $datas];
        } else {
            $result = ['type' => 2, 'status' => "OtpFailed", 'datas' => ""];
        }
        return  $this->commonService->sendResponse($result, '');
    }
    public function resourceOtpValidate($datas, $orgId)
    {
        $datas = (object) $datas;

        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->personInterface->getMobileNumberByUid($datas->uid);
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
            $getLanguageByuid = $this->personInterface->motherTongueByUid($datas->uid);
            $idDocumentTypes = $this->commonInterface->getAllDocumentType();
            $bankAccountTypes = $this->commonInterface->getAllBankAccountType();
            $getPersonPrimaryData = $this->personInterface->getPersonPrimaryDataByUid($datas->uid);
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
                'personAddress' => $personAddress
            ];
        } else {
            $allDatas = ['Status' => 'OTP InValid', 'datas' => ''];
        }

        return  $this->commonService->sendResponse($allDatas, '');
    }
}
