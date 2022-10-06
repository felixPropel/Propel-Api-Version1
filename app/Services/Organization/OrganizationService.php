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
use Illuminate\Support\Facades\Log;

/**
 * Class OrganizationService
 * @package App\Services
 */
class OrganizationService
{

    public function __construct(OrganizationInterface $interface, CommonInterface $commonInterface)
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
        Log::info('OrganizationService > Store new data  function Inside.' . json_encode($datas));

        $datas = (object) $datas;
        $orgdatas = (object) $datas->datas;
        Log::info('OrganizationService > Store After Convert Object.' . json_encode($orgdatas));
        Log::info('OrganizationService > Store After organizationName.' . json_encode($orgdatas->organizationName));
        $setOrganizationModel = $this->convertToOrganizationModel($orgdatas);
        $organizationModel = $this->interface->saveOrganizationModel($setOrganizationModel);
        if ($organizationModel) {

            $organizationId = $organizationModel->id;
            $setOrgDetailModel = $this->convertToOrganizationDetailModel($orgdatas, $organizationId);
            $orgDetailModel = $this->interface->saveOrganizationDetailModel($setOrgDetailModel);
            $setOrganizationMobileModel = $this->convertToOrganizationMobileModel($orgdatas, $organizationId);
            $orgMobileModel = $this->interface->saveOrganizationMobileModel($setOrganizationMobileModel);
            $setOrganizationEmailModel = $this->convertToOrganizationEmailModel($orgdatas, $organizationId);
            $orgEmailModel = $this->interface->saveOrganizationEmailModel($setOrganizationEmailModel);
            // if($orgdatas->webLinks){
            //     $setOrganizationWebAddressModel = $this->convertToOrganizationWebAddressModel($orgdatas, $organizationId);
            //     $orgWebAddressModel = $this->interface->saveOrganizationWebAddressModel($setOrganizationWebAddressModel);
            // }
         
            $setOrganizationAddressModel = $this->convertToOrganizationAddressModel($orgdatas, $organizationId);
            $setOrganizationIdentityModel = $this->convertToOrganizationIdentityModel($orgdatas, $organizationId);

            
           
         
        
            //$orgAddressModel = $this->interface->saveOrganizationAddressModel($setOrganizationAddressModel);
            Log::info('OrganizationService > Store After orgAddressModel. ' . json_encode($setOrganizationAddressModel));
            return true;
            //$orgIdentityModel = $this->interface->saveOrganizationIdentityModel($setOrganizationIdentityModel);
        }
    }
    public function convertToOrganizationModel($datas)
    {
        $model = new Organization();
        $model->authorization_status = "1";
        $model->status = "1";
        return $model;
    }
    public function convertToOrganizationDetailModel($datas, $organizationId)
    {
        $model = new OrganizationDetail();
        $model->org_id = $organizationId;
        $model->title_id = isset($datas->org_title_id) ? $datas->org_title_id : "";
        $model->org_name = $datas->organizationName;
        $model->alias = "";
        $model->started_date = $datas->startedDate;
        $model->year_of_yestablishment = null;
        $model->org_category_id = $datas->organizationCategory;
        $model->org_ownership_id = $datas->ownership;
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
        $model->mobile_no = $datas->primaryMobile;
        return $model;
    }
    public function convertToOrganizationWebAddressModel($datas, $organizationId)
    {
        $model = new OrganizationWebAddress();
        $model->org_id = $organizationId;
        $model->web_address = $datas->webLinks;
        $model->status = 1;
        return $model;
    }
    public function convertToOrganizationAddressModel($datas, $organizationId)
    {
        $model = array();
        for ($i = 0; $i < count($datas->address_of); $i++) {
            Log::info('OrganizationService > Store After doorNo.' . json_encode($datas->doorNo[$i]));
            Log::info('OrganizationService > Store After buildingName.' . json_encode($datas->buildingName[$i]));
            Log::info('OrganizationService > Store After street.' . json_encode($datas->street[$i]));
            Log::info('OrganizationService > Store After area.' . json_encode($datas->area[$i]));
            Log::info('OrganizationService > Store After district. ' . json_encode($datas->district[$i]));
            Log::info('OrganizationService > Store After city. ' . json_encode($datas->city[$i]));
            Log::info('OrganizationService > Store After pinCode. ' . json_encode($datas->pinCode[$i]));
            Log::info('OrganizationService > Store After landMark. ' . json_encode($datas->landMark[$i]));
            $model[$i] = new OrganizationAddress();
            $model[$i]->org_id = $organizationId;
            $model[$i]->address_type_id = $datas->address_of[$i];
            $model[$i]->door_no = $datas->doorNo[$i];
            $model[$i]->building_name = $datas->buildingName[$i];
            $model[$i]->street = $datas->street[$i];
            $model[$i]->area = $datas->area[$i];
            $model[$i]->district_id = "1";
            $model[$i]->city = $datas->city[$i];
            $model[$i]->pincode = $datas->pinCode[$i];
            $model[$i]->landmark = $datas->landMark[$i];
            $model[$i]->location = "";
            $model[$i]->status_id = '1';
            $model[$i]->save();
            Log::info('OrganizationService > Store After Model. ' . json_encode($model));
        }
        return $model;
    }
    public function convertToOrganizationIdentityModel($datas, $organizationId)
    {
        $model = array();
        for ($i = 0; $i < count($datas->idDocumentType); $i++) {

            $model[$i] = new OrganizationIdentity();
            $model[$i] ->org_id = $organizationId;
            $model[$i] ->doc_type_id = $datas->idDocumentType[$i];
            $model[$i] ->doc_no = $datas->documentNumber[$i];
            $model[$i] ->doc_validity = $datas->validTill[$i];
            $model[$i] ->status = '1';
            $model[$i]->save();
        }

        return $model;
    }
    public function organizationCommonData($datas)
    {
        $addressOfLists = $this->commonInterface->getAllAddressOfLists();
        $idDocumentTypes = $this->commonInterface->getAllIdDocumnetTypes();
        $organizationSector = $this->interface->getOrganizationSector();
        $organizationSubset = $this->interface->getOrganizationSubset();
        $organizationActivities = $this->interface->getOrganizationActivities();
        $organizationOwnerShip = $this->interface->getOrganizationOwnerShip();
        $organizationCategory = $this->interface->getOrganizationCategory();
        $response = ['addressOfLists' => $addressOfLists, 'idDocumentTypes' => $idDocumentTypes, 'organizationSector' => $organizationSector, 'organizationSubset' => $organizationSubset, 'organizationActivities' => $organizationActivities, 'organizationCategory' => $organizationCategory, 'organizationOwnerShip' => $organizationOwnerShip];
        return $response;
    }
}
