<?php

namespace App\Repositories\Common;

use App\Interfaces\CommonInterface;
use App\Models\BasicModels\Salutation;
use App\Models\BasicModels\BloodGroup;
use App\Models\BasicModels\Gender;
use App\Models\Address_of;
use App\Models\MaritalStatue;
use App\Models\HrmDepartment;
use App\Models\HrmDesignation;
use App\Models\HrmHumanResourceType;
use App\Models\Language;
use App\Models\IdDocumentType;
use App\Models\BankAccountType;





//use Your Model

/**
 * Class CommonRepository.
 */
class CommonRepository implements CommonInterface
{
    public function getAllSalutions()
    {
      
     return Salutation::get();
    }
    public function getAllBloodGroups()
    {
        return BloodGroup::get();
    }
    public function getAllGenders(){
        return Gender::get();
    }
    public function getAllMaritalstatus(){
       
         return MaritalStatue::get();
    }
    public function getAllAddressOfLists(){

        return Address_of::get();
    }
    public function getAllHrmDepartmentLists(){
        return HrmDepartment::get();
    }
    public function getAllHrmDesignationLists(){
        return HrmDesignation::get();
    }
    public function getAllHrmResourceTypeLists(){
        return HrmHumanResourceType::get();
    }
    public function getAllLanguageLists(){
        return Language::get();
    }
    public function getAllIdDocumnetTypes(){
  
      return IdDocumentType::get();
    }
    public function getAllBankAccountTypes(){
        return BankAccountType::get();
        
    }
}
