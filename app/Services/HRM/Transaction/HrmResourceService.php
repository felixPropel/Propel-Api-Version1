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
        
        $checkPerson = $this->personInterface->findExactPersonWithEmailAndMobile($email, $mobile);

        $saluationLists = $this->commonInterface->getAllSalutions();
        dd($saluationLists);

        if ($checkPerson) {
            $uId = $checkPerson->uid;
            $checkUserWithUid =  $this->personInterface->checkUserByUID($uId);
            
            if ($checkUserWithUid) {
                $orgId = "1";
                $userWithInOrganization = $this->personInterface->findUserWithInOrganization($uId, $orgId);               
                if ($userWithInOrganization) 
                {
                    $response = ['status' => "SameOrganizationUser", 'data' => ""];
                } 
                else
                {
                    $response = ['status' => "NotInSameOrganizationUser", 'data' => ""];
                }
            } else {
                $response = ['status' => "SinglePersonOnly", 'data' =>  $checkPerson];
            }
        } else {
            $getAllPersonByMobileAndEmail =  $this->personInterface->getDetailedAllPersonDataWithEmailAndMobile($email, $mobile);
            if (count($getAllPersonByMobileAndEmail))
            {
                $response = ['status' => "NotInSinglePerson", 'data' => $getAllPersonByMobileAndEmail];
            } else {
                $response = ['status' => "FreshPerson", 'data' => ""];
            }
        }
        return response($response, 400);
    }

    public function save($datas)
    {
        dd("well save");
    }
}
