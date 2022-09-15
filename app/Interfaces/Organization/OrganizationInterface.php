<?php

namespace App\Interfaces\Organization;

interface OrganizationInterface
{

    public function checkGstNo($gstNo);
    public function saveOrganizationModel($data);
    public function saveOrganizationDetailModel($data);
    public function saveOrganizationMobileModel($data);
    public function saveOrganizationEmailModel($data);
    public function saveOrganizationWebAddressModel($data);
    public function saveOrganizationAddressModel($data);
    public function saveOrganizationIdentityModel($data);
}
