<?php
namespace App\Http\Controllers\version1\Interfaces\Organization;
interface OrganizationInterface
{
    public function saveOrganization($orgModel,$orgDetailModel,$orgEmailModel,$orgWebLinkModel,$orgAddressModel,$orgDBModel);
    public function getOrganizationAccountByUid($uid);
    public  function getDataBaseNameByOrgId($id);
    public function getPerviousDefaultOrganization($uid);
    public function changeDefaultOrganization($uid);
    public function storeTempOrganization($model);
    public function getTempOrganizationDataByTempId($id);
    public function dynamicOrganizationData($orgDocId,$orgOwnershipId,$orgCategoryId,$orgStructureId);

}