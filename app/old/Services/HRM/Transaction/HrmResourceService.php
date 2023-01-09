<?php
namespace App\Services\HRM\Transaction;
use App\Interfaces\CommonInterface;
use App\Interfaces\HrmDesignationInterface;
use App\Interfaces\PersonInterface;

/**
 * Class HrmResourceService.
 * @package App\Services
 */
class HrmResourceService
{

    public function __construct(PersonInterface $personInterface,CommonInterface $commonInterface,HrmDesignationInterface $designationInterface)
    {
        $this->personInterface = $personInterface;
        $this->commonInterface = $commonInterface;
        $this->designationInterface = $designationInterface;
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
        $hrmResourceTypeLists=$this->commonInterface->getAllHrmResourceTypeLists();
        $languageLists=$this->commonInterface->getAllLanguageLists();
        $idDocumentTypes=$this->commonInterface->getAllIdDocumnetTypes();
        $bankAccountTypes=$this->commonInterface->getAllBankAccountTypes();
   
   
    
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
                $results = ['status' => "FreshPerson", 'data' => "newperosn"];
            }
        }
        $response = ['results' =>$results ,'saluationLists' => $saluationLists,'bloodGroupLists' => $bloodGroupLists ,'genderLists' => $genderLists ,'addressOfLists' => $addressOfLists ,'hrmDepartmentLists' => $hrmDepartmentLists,'hrmDesignation'=>$hrmDesignationLists, 'hrmResourceTypeLists' => $hrmResourceTypeLists ,'maritalStatusLists' => $maritalStatusLists, 'languageLists' => $languageLists, 'idDocumentTypes'=>$idDocumentTypes,'bankAccountTypes'=>$bankAccountTypes];
        return   $response;
    }
    public function findDesignationByDepartmentId($datas){

         $datas = (object) $datas;      
         $deptId = $datas->deptId;
         $response = $this->designationInterface->findAllByDeptId($deptId);
         return $response;
        
    }
    public function save($datas)
    {
        dd("well save");
    }
}