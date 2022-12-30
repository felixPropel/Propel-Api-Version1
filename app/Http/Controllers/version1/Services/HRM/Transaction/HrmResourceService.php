<?php

namespace  App\Http\Controllers\version1\Services\HRM\Transaction;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDesignationInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Transaction\HrmResourceInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Interfaces\CommonInterface;



/**
 * Class HrmResourceService.
 * @package App\Services
 */
class HrmResourceService
{

    public function __construct(PersonInterface $personInterface, UserInterface $userInterface, HrmResourceInterface $hrmResourceInterface, CommonService $commonService, CommonInterface $commonInterface, HrmDepartmentInterface $hrmDeptInterface, HrmDesignationInterface $hrmDesInterface, HrmHumanResourceTypeInterface $hrmResourceTypeInterface)
    {
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
    // public function save($datas)
    // {
    //     dd("well save");
    // }
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
}
