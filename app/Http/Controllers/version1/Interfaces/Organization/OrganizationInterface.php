<?php

namespace App\Http\Controllers\version1\Interfaces\Organization;

interface OrganizationInterface
{
    
    public function saveOrganization($model,$orgDetailModel,$orgEmailModel,$userAccountModel);

    public function getOrganizationAccountByUid($uid);
   
}