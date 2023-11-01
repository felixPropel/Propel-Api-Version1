<?php

namespace App\Http\Controllers\version1\Repositories\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationDatabase;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\PIMSOrganization\Category;
use App\Models\PIMSOrganization\DocumentType;
use App\Models\PIMSOrganization\OwnerShip;
use App\Models\PIMSOrganization\Structure;
use App\Models\TempOrganization;
use Illuminate\Support\Facades\DB;

class OrganizationRepository implements OrganizationInterface
{
    public function getOrganizationAccountByUid($uid)
    {
        return UserOrganizationRelational::with('organizationDetail')->where('uid', $uid)->whereNull('deleted_flag')->get();
           
    }
    // public function saveOrganization($orgModel, $orgDetailModel, $orgEmailModel, $orgWebLinkModel, $propertyAddressModel, $orgDBModel)
    // {
    //     try {
    //         $result = DB::transaction(function () use ($orgModel, $orgDetailModel, $orgEmailModel, $orgWebLinkModel, $propertyAddressModel, $orgDBModel) {

    //             $orgModel->save();
    //             $orgDetailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
    //             $orgEmailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
    //             $orgWebLinkModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
    //             $orgDBModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
    //             $orgDetailModel->save();
    //             $orgEmailModel->save();
    //             $orgWebLinkModel->save();
    //             $orgDBModel->save();
    //             if ($propertyAddressModel) {
    //                 $propertyAddressModel->save();
    //                 $orgAddress = new OrganizationAddress();
    //                 $orgAddress->ParentOrganization()->associate($orgModel, 'org_id', 'id');
    //                 $orgAddress->ParentComAddress()->associate($propertyAddressModel, 'com_propertry_address_id', 'id');
    //                 $orgAddress->save();
    //             }
    //             return $orgDBModel;

    //         });
    //         return $result;
    //     } catch (\Exception $e) {
    //         return [
    //             'message' => "failed",
    //             'data' => $e,
    //         ];
    //     }
    // }
    // public function dynamicOrganizationData($orgDocId, $orgOwnershipId, $orgCategoryId, $orgStructureId)
    // {
    // //   $db=config('database.connections.mysql_external.database');

    //     try {
    //         $result = DB::transaction(function () use ($orgDocId, $orgOwnershipId, $orgCategoryId, $orgStructureId) {
    //             if ($orgDocId) {
    //             for ($i = 0; $i < count($orgDocId); $i++) {
    //                 $orgDocId[$i]->save();
    //             }
    //             }
    //             $orgOwnershipId->save();
    //             $orgCategoryId->save();
    //             $orgStructureId->save();

    //             return [
    //                 'message' => "Success",
    //                 'data' => $orgOwnershipId->org_id,
    //             ];
    //         });
    //         return $result;
    //     } catch (\Exception $e) {
    //         return [
    //             'message' => "failed",
    //             'data' => $e,
    //         ];
    //     }
    // }

    public function getDataBaseNameByOrgId($id)
    {
        return OrganizationDatabase::where('org_id', $id)->first();
    }
    public function getOrganizationName($uid)
    {

        return Organization::with('OrganizationDetail', 'userRelational')
            ->where('pfm_stage_id', 1)
            ->whereNull('deleted_flag')
            ->whereNull('deleted_at')
            ->whereHas('userRelational', function ($query) use ($uid) {
                $query->where('uid', $uid);
            })->get();

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
    public function getTempOrganizationDataByTempId($tempOrgId)
    {
        return TempOrganization::where('id', $tempOrgId)->whereNull('deleted_at')->first();
    }
    public function pimsOrganizationStructure()
    {
        return Structure::whereNull('deleted_flag')
            ->whereNull('deleted_at')
            ->get();

    }
    public function pimsOrganizationCategory()
    {
        return Category::whereNull('deleted_flag')
            ->whereNull('deleted_at')
            ->get();

    }
    public function pimsOrganizationOwnerShip()
    {
        return OwnerShip::whereNull('deleted_flag')
            ->whereNull('deleted_at')
            ->get();

    }
    public function pimsOrganizationDocumentType()
    {
        return DocumentType::whereNull('deleted_flag')
            ->whereNull('deleted_at')
            ->get();

    }
    public function getAllTempOrganizations($uid)
    {
        return TempOrganization::where('authorized_person_id', $uid)->whereNull('deleted_flag')->whereNull('deleted_at')
            ->get();
    }
}
