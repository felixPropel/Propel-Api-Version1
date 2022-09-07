<?php

namespace App\Services\HRM\Transaction;

use App\Interfaces\CommonInterface;
use App\Interfaces\PersonInterface;

/**
 * Class HrmResourceService.
 * @package App\Services
 */
class HrmResourceService
{

    public function __construct(PersonInterface $personInterface,CommonInterface $commonInterface)
    {
        $this->personInterface = $personInterface;
        $this->commonInterface = $commonInterface;
    }


    public function findResourceWithCredentials($datas)
    {
      
        $datas = (object)$datas; 
        $mobile = $datas->mobile;
        $email = $datas->email;
        $checkPerson = $this->personInterface->findExactPersonWithEmailAndMobile($email,$mobile);
        $saluationLists = $this->commonInterface->getAllSalutions();
        $bloodGroupLists=$this->commonInterface->getAllBloodGroups();
        $genderLists=$this->commonInterface->getAllGenders();
        $maritalStatusLists=$this->commonInterface->getAllMaritalstatus();
        $addressOfLists=$this->commonInterface->getAllAddressOfLists();
        $hrmDepartmentLists=$this->commonInterface->getAllHrmDepartmentLists();
        $hrmDesignationLists=$this->commonInterface->getAllHrmDesignationLists();
        

        if ($checkPerson) {
            $uId = $checkPerson->uid;
            $checkUserWithUid =  $this->personInterface->checkUserByUID($uId);
            
            if ($checkUserWithUid) {
                $orgId = "1";
                $userWithInOrganization = $this->personInterface->findUserWithInOrganization($uId, $orgId);               
                if ($userWithInOrganization) 
                {
                    $results = ['status' => "SameOrganizationUser", 'data' => ""];
                } 
                else
                {
                    $results = ['status' => "NotInSameOrganizationUser", 'data' => ""];
                }
            } else {
                $results = ['status' => "SinglePersonOnly", 'data' =>  $checkPerson];
            }
        } else {
            $getAllPersonByMobileAndEmail =  $this->personInterface->getDetailedAllPersonDataWithEmailAndMobile($email, $mobile);
            if (count($getAllPersonByMobileAndEmail))
            {
                $results = ['status' => "NotInSinglePerson", 'data' => $getAllPersonByMobileAndEmail];
            } else {
                $results = ['status' => "FreshPerson", 'data' => ""];
            }
        }
        $response = ['results' =>$results ,'saluationLists' => $saluationLists,'bloodGroupLists' => $bloodGroupLists ,'genderLists' => $genderLists ,'addressOfLists' => $addressOfLists ,'hrmDepartmentLists' => $hrmDepartmentLists,'hrmDesignation'=>$hrmDesignationLists];
        return   $response;
    }

    public function save($datas)
    {
        dd("well save");
    }
}