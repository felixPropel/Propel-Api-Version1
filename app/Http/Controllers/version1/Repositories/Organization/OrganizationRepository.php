<?php

namespace App\Http\Controllers\version1\Repositories\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Models\Organization\OrganizationDatabase;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\Organization\OrganizationStructure;
use App\Models\Organization\OrganizationOwnership;
use App\Models\Organization\OrganizationCategory;
use App\Models\Organization\OrganizationDocument;
use App\Models\TempOrganization;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class OrganizationRepository implements OrganizationInterface
{
    public function getOrganizationAccountByUid($uid)
    {
        return UserOrganizationRelational::select('organizations.id as orgId', 'organization_details.org_name', 'user_organization_relationals.default_org', 'organizations.pfm_stage_id')
            ->leftjoin('organizations', 'organizations.id', '=', 'user_organization_relationals.organization_id')
            ->leftjoin('organization_details', 'organization_details.org_id', '=', 'organizations.id')
            ->where('uid', $uid)
            ->get();
    }
    public function saveOrganization($orgModel, $orgDetailModel, $orgEmailModel, $orgWebLinkModel, $orgAddressModel, $orgDBModel)
    {
        try {
            $result = DB::transaction(function () use ($orgModel, $orgDetailModel, $orgEmailModel, $orgWebLinkModel, $orgAddressModel, $orgDBModel) {

                $orgModel->save();
                $orgDetailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $orgEmailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $orgWebLinkModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $orgDBModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $orgDetailModel->save();
                $orgEmailModel->save();
                $orgWebLinkModel->save();
                $orgAddressModel->save();
                $orgDBModel->save();
               

                return [
                    'message' => "Success",
                    'data' => $orgDBModel,
                ];
            });
            return $result;
        } catch (\Exception $e) {
            return [
                'message' => "failed",
                'data' => $e,
            ];
        }
    }
         public function dynamicOrganizationData($orgDocId,$orgOwnershipId,$orgCategoryId,$orgStructureId)
         {
           
            try {
                $result = DB::transaction(function () use ($orgDocId, $orgOwnershipId, $orgCategoryId, $orgStructureId) {
    
                    $orgDocId->save();
                    $orgOwnershipId->save();
                    $orgCategoryId->save();
                    $orgStructureId->save();
              
                    
                    return [
                        'message' => "Success",
                        'data' => $orgDocId->org_id,
                    ];
                });
                return $result;
            } catch (\Exception $e) {
                return [
                    'message' => "failed",
                    'data' => $e,
                ];
            }
         }

    public function getDataBaseNameByOrgId($id)
    {
        return OrganizationDatabase::where('org_id', $id)->first();
    }
    public function getPerviousDefaultOrganization($uid)
    {
        return UserOrganizationRelational::select('organization_details.org_name', 'user_organization_relationals.organization_id')
            ->leftjoin('organization_details', 'organization_details.org_id', '=', 'user_organization_relationals.organization_id')
            ->where(['uid' => $uid, ['default_org', '=', '1']])
            ->first();
    }
    public function changeDefaultOrganization($uid)
    {
        return UserOrganizationRelational::where(['uid' => $uid, ['default_org', '=', '1']])->first();
    }
    public function storeTempOrganization($model)
    {
        try {
            $result = DB::transaction(function () use ($model) {

                $model->save();
                return [
                    'message' => "Success",
                    'data' => $model,
                ];
            });

            return $result;
        } catch (\Exception $e) {

            return [

                'message' => "failed",
                'data' => $e,
            ];
        }
    }
    public function getTempOrganizationDataByTempId($id)
    {
        return TempOrganization::where('id', $id)->whereNull('deleted_at')->first();
    }
    public function pimsOrganizationStructure()
    {
        return OrganizationStructure::whereNull('deleted_flag')
        ->whereNull('deleted_at')
        ->get();
     
    }
    public function pimsOrganizationCategory()
    {
        return OrganizationCategory::whereNull('deleted_flag')
        ->whereNull('deleted_at')
        ->get();
      
    }
    public function pimsOrganizationOwnerShip()
    {
        return OrganizationOwnership::whereNull('deleted_flag')
        ->whereNull('deleted_at')
        ->get();
      
    }
    public function pimsOrganizationDocumentType()
    {
        return OrganizationDocument::whereNull('deleted_flag')
        ->whereNull('deleted_at')
        ->get();
      
    }
}
