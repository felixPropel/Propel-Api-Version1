<?php

namespace App\Services\Organization;

use App\Interfaces\Organization\OrganizationInterface;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationAddress;
use App\Models\Organization\OrganizationDetail;
use App\Models\Organization\OrganizationEmail;
use App\Models\Organization\OrganizationIdentity;
use App\Models\Organization\OrganizationMobile;
use App\Models\Organization\OrganizationWebAddress;
use App\Interfaces\CommonInterface;
/**
 * Class OrganizationService
 * @package App\Services
 */
class OrganizationService
{

    public function __construct(OrganizationInterface $interface,CommonInterface $commonInterface)
    {
        $this->interface = $interface;
        $this->commonInterface = $commonInterface;
    }
    public function checkGstNumber($gstNo)
    {
        $checkGST = $this->interface->checkGstNo($gstNo);
        if ($checkGST) {
            dd("if");
        } else {
            $response = ['data' => $checkGST];
        }
        return $response;
    }
    public function save($datas)
    {
         $datas = (object) $datas;
         $setOrganizationModel = $this->convertToOrganizationModel($datas);
         $organizationModel = $this->interface->saveOrganizationModel($setOrganizationModel);
         if ($organizationModel){
            $organizationId = $organizationModel['data']->id;
            $setOrgDetailModel = $this->convertToOrganizationDetailModel($datas, $organizationId);
            $setOrganizationMobileModel = $this->convertToOrganizationMobileModel($datas, $organizationId);
            $setOrganizationEmailModel = $this->convertToOrganizationEmailModel($datas, $organizationId);
            $setOrganizationWebAddressModel = $this->convertToOrganizationWebAddressModel($datas, $organizationId);
            $setOrganizationAddressModel = $this->convertToOrganizationAddressModel($datas, $organizationId);
            $setOrganizationIdentityModel = $this->convertToOrganizationIdentityModel($datas, $organizationId);
            $orgDetailModel = $this->interface->saveOrganizationDetailModel($setOrgDetailModel);
            $orgMobileModel = $this->interface->saveOrganizationMobileModel($setOrganizationMobileModel);
            $orgEmailModel = $this->interface->saveOrganizationEmailModel($setOrganizationEmailModel);
            $orgWebAddressModel = $this->interface->saveOrganizationWebAddressModel($setOrganizationWebAddressModel);
            $orgAddressModel = $this->interface->saveOrganizationAddressModel($setOrganizationAddressModel);
            $orgIdentityModel = $this->interface->saveOrganizationIdentityModel($setOrganizationIdentityModel);
        }

        
    }
    public function convertToOrganizationModel($datas)
    {
        $model = new Organization();
        $model->authorization_status= "1";
        $model->status = "1";
        return $model;
    }
    public function convertToOrganizationDetailModel($datas, $organizationId)
    {
        $model = new OrganizationDetail();
        $model->org_id = $organizationId;
        $model->title_id = $datas->org_title_id;
        $model->org_name = $datas->organizationName;
        $model->alias = "";
        $model->started_date = $datas->startDate;
        $model->year_of_yestablishment = null;
        $model->org_category_id = $datas->orgCategoryId;
        $model->org_ownership_id = $datas->orgOwnershipId;
        $model->org_register_status = 1;
        $model->status = 1;
        return $model;
    }

    public function convertToOrganizationEmailModel($datas, $organizationId)
    {
        $model = new OrganizationEmail();
        $model->org_id = $organizationId;
        $model->email = $datas->primaryEmail;
        $model->verification_status_id = 0;
        $model->status = 1;
        return $model;
    }

    public function convertToOrganizationMobileModel($datas, $organizationId)
    {
        $model = new OrganizationMobile();
        $model->org_id = $organizationId;
        $model->country_id = '91';
        $model->mobile_no = $datas->mobile;
        return $model;
    }
    public function convertToOrganizationWebAddressModel($datas, $organizationId)
    {
        $model = new OrganizationWebAddress();
        $model->org_id = $organizationId;
        $model->web_address = $datas->weblinks;
        $model->status = 1;
        return $model;
    }
    public function convertToOrganizationAddressModel($datas, $organizationId)
    {
        $model = new OrganizationAddress();
        $model->org_id = $organizationId;
        $model->address_type_id = $datas->addressType;
        $model->door_no = $datas->doorNo;
        $model->building_name = $datas->buildingName;
        $model->street = $datas->street;
        $model->area = $datas->area;
        $model->district_id = $datas->district;
        $model->city = $datas->city;
        $model->pincode = $datas->pincode;
        $model->landmark = $datas->landmark;
        $model->location = "";
        $model->status_id = '1';
        return $model;
    }
    public function convertToOrganizationIdentityModel($datas, $organizationId)
    {
        $model = new OrganizationIdentity();
        $model->org_id = $organizationId;
        $model->doc_type_id = $datas->docTypeId;
        $model->doc_no = $datas->docNumber;
        $model->doc_validity = $datas->validTo;
        $model->status = '1';
        return $model;
    }
    public function organizationCommonData($datas)
    {

        $addressOfLists=$this->commonInterface->getAllAddressOfLists();
        $idDocumentTypes=$this->commonInterface->getAllIdDocumnetTypes();
        $response =['addressOfLists' => $addressOfLists,'idDocumentTypes' => $idDocumentTypes];
         return $response;
    }
}
