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
use App\Models\HrmResourceTypeDetail;
use Illuminate\Support\Facades\Log;

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

        /*Some Important Types credential Type End */
        if ($checkPerson) {

            $uId = $checkPerson->uid;

            $checkResource = $this->hrmResourceInterface->findResourceByUid($uId);
            if ($checkResource) {
                $resData = ['type' => 4, 'ResUid' => $uId];
            } else {
                $resData = ['type' => 5, 'PersonUid' => $uId];
            }


            // $checkUserWithUid =  $this->personInterface->checkUserByUID($uId);

            // if ($checkUserWithUid) {
            //     $orgId = "1";
            //     $userWithInOrganization = $this->personInterface->findUserWithInOrganization($uId, $orgId);
            //     if ($userWithInOrganization) {
            //         $results = ['status' => "SameOrganizationUser", 'data' => ""];
            //     } else {
            //         $results = ['status' => "NotInSameOrganizationUser", 'data' => ""];
            //     }
            // } else {
            //     $results = ['status' => "SinglePersonOnly", 'data' =>  $checkPerson];
            // }
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

            $allModels = [
                'resourceModel' => $convertToResourceModel,
                'resourceTypeDetailModel' => $convertToResourceTypeDetailModel,
                'resourceDesignModel' => $convertToResourceDesignationModel,
                'resourceJoinModel' => $convertToResourceDateOfJoin,
                'resourceWorkingModel' => $convertToResourceWorking
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
}
