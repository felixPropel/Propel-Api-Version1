<?php

namespace App\Repositories\Organization;

use App\Interfaces\Organization\OrganizationInterface;
use App\Models\Organization\OrganizationIdentities;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationSector;
use App\Models\Organization\OrganizationSubset;
use App\Models\Organization\OrganizationActivities;
use App\Models\Organization\OrganizationCategory;
use App\Models\Organization\OrganizationOwnership;
use Illuminate\Support\Facades\Log;
//use Your Model

/**
 * Class OrganizationRepository.
 */
class OrganizationRepository implements OrganizationInterface
{
    public function checkGstNo($gstNo)
    {
        return OrganizationIdentities::leftjoin('id_document_types', 'id_document_types.id', '=', 'organization_identities.doc_type_id')
            ->where('id_document_types.name', 'GST')
            ->where('organization_identities.doc_no', $gstNo)
            ->exists();
    }
    public function saveOrganizationModel($data)
    {

        $data->save();
        Log::info('OrganizationRepo > saveOrganizationModel After data. ' . json_encode($data));
        return $data;
        // return [
        //     'message' => "success",   
        //     'data' => $data
        // ];
    }
    public function saveOrganizationDetailModel($data)
    {

        $data->save();
        Log::info('OrganizationRepo > saveOrganizationDetailModel After data. ' . json_encode($data));
        return [
            'message' => "success",
            'data' => $data
        ];
    }
    public function saveOrganizationMobileModel($data)
    {

        $data->save();
        Log::info('OrganizationRepo > saveOrganizationMobileModel After data. ' . json_encode($data));
        return [
            'message' => "success",
            'data' => $data
        ];
    }
    public function saveOrganizationEmailModel($data)
    {

        $data->save();
        Log::info('OrganizationRepo > saveOrganizationEmailModel After data. ' . json_encode($data));
        return [
            'message' => "success",
            'data' => $data
        ];
    }
    public function saveOrganizationWebAddressModel($data)
    {

        $data->save();
        Log::info('OrganizationRepo > saveOrganizationWebAddressModel After data. ' . json_encode($data));
        return [
            'message' => "success",
            'data' => $data
        ];
    }
    public function saveOrganizationAddressModel($data)
    {

        $data->save();
        Log::info('OrganizationRepo > saveOrganizationAddressModel After data. ' . json_encode($data));
        return [
            'message' => "success",
            'data' => $data
        ];
    }
    public function saveOrganizationIdentityModel($data)
    {

        $data->save();
        Log::info('OrganizationRepo > saveOrganizationIdentityModel After data. ' . json_encode($data));
        return [
            'message' => "success",
            'data' => $data
        ];
    }
    public function getOrganizationSector()
    {
     
        return OrganizationSector::get();
    }
    public function getOrganizationSubSet()
    {
   
        return OrganizationSubset::get();
    }
    public function getOrganizationActivities()
    {
        return OrganizationActivities::get();
    }
    public function getOrganizationCategory()
    {
        return OrganizationCategory::get();
    }
    public function getOrganizationOwnerShip()
    {
        
        return OrganizationOwnership::get();
    }
}

