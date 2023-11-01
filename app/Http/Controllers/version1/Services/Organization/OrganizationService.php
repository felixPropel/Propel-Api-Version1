<?php

namespace App\Http\Controllers\version1\Services\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationCategory;
use App\Models\Organization\OrganizationDatabase;
use App\Models\Organization\OrganizationDetail;
use App\Models\Organization\OrganizationDocument;
use App\Models\Organization\OrganizationEmail;
use App\Models\Organization\OrganizationOwnership;
use App\Models\Organization\OrganizationStructure;
use App\Models\Organization\OrganizationWebAddress;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\PropertyAddress;
use App\Models\TempOrganization;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrganizationService
{
    public function __construct(OrganizationInterface $organizationInterface, CommonService $commonService)
    {
        $this->organizationInterface = $organizationInterface;
        $this->commonService = $commonService;
    }
    public function getOrganizationAccountByUid($uid)
    {
        Log::info('OrganizationService > getOrganizationAccountByUid function Inside.' . json_encode($uid));
        $OrganizationAccountModel = $this->organizationInterface->getOrganizationAccountByUid($uid);
        $transformed = $OrganizationAccountModel->map(function ($item) {
            $orgId=$item->organization_id;
            $defaultOrgStatus=$item->default_org;
            $pfmActiveStatus=$item->pfm_active_status_id;
            $orgName = $item->organizationDetail->org_name;
            return ['orgId'=>$orgId,'org_name'=>$orgName,'pfm_stage_id'=>$pfmActiveStatus,'default_org'=>$defaultOrgStatus];
        });
        return $this->commonService->sendResponse($transformed, "");
    }
    public function store($tempOrgId)
    {

        $preDatabase = Config::get('database.connections.mysql.database');
        Log::info('OrganizationService > store function Inside.' . json_encode($tempOrgId));
        $tempOrgData = $this->organizationInterface->getTempOrganizationDataByTempId($tempOrgId);
        $orgDetails = json_decode($tempOrgData->organization_detail, true);
        $orgDocuments = json_decode($tempOrgData->organization_doc_type, true);
        $orgAddress = (object) json_decode($tempOrgData->organization_address, true);
        if ($tempOrgData) {
            $datas = (object) $tempOrgData;
            $generateOrganizationModel = $this->convertToOrganizationModel($datas);
            $generateOrganizationDetailModel = $this->convertToOrganizationDetailModel($orgDetails);
            $generateOrganizationEmailModel = $this->convertToOrganizationEmailModel($orgDetails);
            $generateOrganizationWebAddressModel = $this->convertToOrganizationWebAddressModel($orgDetails);
            $generatePropertyAddressModel = $this->convertToPropertyAddressModel($orgAddress);
            $generateOrganizationDatabaseModel = $this->convertToOrganizationDatabaseModel($orgDetails);
            $orgModel = $this->organizationInterface->saveOrganization($generateOrganizationModel, $generateOrganizationDetailModel, $generateOrganizationEmailModel, $generateOrganizationWebAddressModel, $generatePropertyAddressModel, $generateOrganizationDatabaseModel);
            $orgId = $orgModel->id;
            $orgName = $orgModel->db_name;
            $CreateDynamicDb = $this->createDynamicDatabase($orgName);
            $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
            $generateOrganizationDocumentModel = $this->convertToOrganizationDocumentModel($orgDocuments, $orgId);

            $generateOrganizationOwnerShipIdModel = $this->convertOrganizationOwnerShipModel($orgDetails, $orgId);
            $generateOrganizationCategoryIdModel = $this->convertOrganizationCategoryModel($orgDetails, $orgId);
            $generateOrganizationStructureIdModel = $this->convertOrganizationStructureModel($orgDetails, $orgId);
            $model = $this->organizationInterface->dynamicOrganizationData($generateOrganizationDocumentModel, $generateOrganizationOwnerShipIdModel, $generateOrganizationCategoryIdModel, $generateOrganizationStructureIdModel);
            // $generateUserAccountModel = $this->convertToUserAccountModel($datas);
            Config::set('database.connections.mysql.database', $preDatabase);
            DB::purge('mysql');
            DB::reconnect('mysql');

            if ($model['message'] == "Success") {
                return $this->commonService->sendResponse($model, $model['message']);
            } else {
                return $this->commonService->sendError($model['data'], $model['message']);
            }
        } else {
            return $this->commonService->sendError('TempOrgId  Not Found', 'Empty');

        }
    }
    public function createDynamicDatabase($dbName)
    {
        $preDatabase = Config::get('database.connections.mysql.database');
        DB::statement("CREATE DATABASE IF NOT EXISTS $dbName");
        $new = Config::set('database.connections.mysql.database', $dbName);
        DB::purge('mysql');
        DB::reconnect('mysql');
        \Artisan::call('migrate');
        $current = Config::set('database.connections.mysql.database', $preDatabase);
        DB::purge('mysql');
        DB::reconnect('mysql');
        return true;
    }
    public function convertToOrganizationModel($datas)
    {
        $model = new Organization();
        $model->pfm_stage_id = 1;
        $model->pfm_authorization_id = 1;
        $model->pfm_origin_id = 1;
        return $model;
    }
    public function convertToOrganizationDatabaseModel($datas)
    {
        $datas = (object) $datas;
        Log::info('OrganizationService > convertToOrganizationDatabaseModel function Inside.' . json_encode($datas));
        $dbName = now()->timestamp . preg_replace('/\s+/', '', $datas->orgName);
        $model = new OrganizationDatabase();
        $model->db_name = $dbName;
        $model->pfm_active_status_id = 1;
        return $model;
    }
    public function convertToOrganizationDetailModel($datas)
    {
        $datas = (object) $datas;
        $model = new OrganizationDetail();
        $model->title_id = (isset($datas->title_id) ? $datas->title_id : null);
        $model->org_name = $datas->orgName;
        $model->org_alias = (isset($datas->org_alias) ? $datas->org_alias : null);
        $model->started_date = (isset($datas->started_date) ? $datas->started_date : null);
        $model->year_of_establishment = (isset($datas->year_of_establishment) ? $datas->year_of_establishment : null);
        $model->is_registered_org = (isset($datas->is_registered_org) ? $datas->is_registered_org : null);
        $model->date_of_reg = (isset($datas->date_of_reg) ? $datas->date_of_reg : null);
        return $model;
    }
    public function convertToOrganizationEmailModel($datas)
    {
        $datas = (object) $datas;
        $model = new OrganizationEmail();
        $model->email = $datas->orgEmail;
        $model->pfm_active_status_id = "1";
        return $model;
    }
    public function convertToUserAccountModel($datas)
    {
        $model = new UserOrganizationRelational();
        $model->uid = $datas->tried_person_id;
        return $model;
    }
    public function getDataBaseNameByid($orgId)
    {
        $datas = (object) $datas;
        $model = $this->organizationInterface->getDataBaseNameById($datas->id);

        Session::put('orgDb', $model->db_name);

        return $this->commonService->sendResponse($model, '');
    }
    public function convertToOrganizationDocumentModel($datas, $orgId)
    {
        if ($datas) {
            $orgModel = [];
            for ($i = 0; $i < count($datas); $i++) {
                $model[$i] = new OrganizationDocument();
                $model[$i]->org_id = $orgId;
                $model[$i]->pims_org_doc_type_id = (isset($datas[$i]['doctypeId']) ? $datas[$i]['doctypeId'] : null);
                $model[$i]->doc_no = (isset($datas[$i]['docNo']) ? $datas[$i]['docNo'] : null);
                $model[$i]->doc_validity = (isset($datas[$i]['docValid']) ? $datas[$i]['docValid'] : null);
                $model[$i]->doc_attachment = (isset($datas[$i]['docFilePath']) ? $datas[$i]['docFilePath'] : null);
                $model[$i]->pfm_active_status_id = (isset($datas[$i]['activeStatus']) ? $datas[$i]['activeStatus'] : null);
                array_push($orgModel, $model[$i]);

            }
            return $orgModel;
        }

        //    if($datas){
        //     $model = new OrganizationDocument();
        //     $model->org_id = $orgId;
        //     $model->pims_org_doc_type_id = (isset($datas->doc_type_id) ? $datas->doc_type_id : null);
        //     $model->doc_no = null;
        //     $model->doc_validity = null;
        //     $model->doc_attachment = null;
        //     $model->pfm_active_status_id = 1;
        //     return $model;
        //    }
    }
    public function convertToOrganizationWebAddressModel($datas)
    {
        $datas = (object) $datas;
        $model = new OrganizationWebAddress();
        $model->web_address = (isset($datas->orgwebsite) ? $datas->orgwebsite : null);
        $model->pfm_active_status_id = 1;
        return $model;

    }
    public function convertToPropertyAddressModel($datas)
    {

        $model = new PropertyAddress();
        $model->door_no = (isset($datas->door_no) ? $datas->door_no : null);
        $model->building_name = (isset($datas->building_name) ? $datas->building_name : null);
        $model->pin = (isset($datas->pincode) ? $datas->pincode : null);
        $model->pims_com_state_id = (isset($datas->state_id) ? $datas->state_id : null);
        $model->street = (isset($datas->street) ? $datas->street : null);
        $model->land_mark = (isset($datas->landmark) ? $datas->landmark : null);
        $model->pims_com_district_id = (isset($datas->district_id) ? $datas->district_id : null);
        $model->pims_com_city_id = (isset($datas->city_id) ? $datas->city_id : null);
        $model->area = (isset($datas->area) ? $datas->area : null);
        $model->location = (isset($datas->location) ? $datas->location : null);
        return $model;

    }
    public function setDefaultOrganization($datas)
    {
        $datas = (object) $datas;
        $model = $this->organizationInterface->changeDefaultOrganization($datas->uid);
        if ($model) {
            $model->default_org = 0;
            $model->save();
        }
        $setOrganization = UserOrganizationRelational::where(['organization_id' => $datas->orgId, 'uid' => $datas->uid])->update(['default_org' => 1]);
        return $this->commonService->sendResponse($datas, '');
    }
    public function tempOrganizationStore($datas)
    {

        $validator = Validator::make($datas, [
            'orgStructureId' => 'required',
            'orgCategoryId' => 'required',
            'orgOwnershipId' => 'required',
            'orgName' => 'required',
            'orgEmail' => 'required|email',
            'pinCode' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        } else {
            $datas = (object) $datas;
            $convertTempOrg = $this->convertTempOrganization($datas);
            $storeTempOrg = $this->organizationInterface->storeTempOrganization($convertTempOrg);
            return $this->commonService->sendResponse($storeTempOrg, '');
        }
    }
    public function convertOrganizationOwnerShipModel($datas, $orgId)
    {

        $datas = (object) $datas;
        $model = new OrganizationOwnership();
        $model->org_id = $orgId;
        $model->pims_org_ownership_id = (isset($datas->orgOwnershipId) ? $datas->orgOwnershipId : null);
        $model->pfm_active_status_id = (isset($datas->activeStatus) ? $datas->activeStatus : null);

        return $model;
    }
    public function convertOrganizationCategoryModel($datas, $orgId)
    {
        $datas = (object) $datas;
        $model = new OrganizationCategory();
        $model->org_id = $orgId;
        $model->pims_org_category_id = (isset($datas->orgCategoryId) ? $datas->orgCategoryId : null);
        $model->pfm_active_status_id = (isset($datas->activeStatus) ? $datas->activeStatus : null);

        return $model;
    }
    public function convertOrganizationStructureModel($datas, $orgId)
    {
        $datas = (object) $datas;
        $model = new OrganizationStructure();
        $model->org_id = $orgId;
        $model->pims_org_structure_id = (isset($datas->orgStructureId) ? $datas->orgStructureId : null);
        $model->pfm_active_status_id = (isset($datas->activeStatus) ? $datas->activeStatus : null);

        return $model;
    }
    public function convertTempOrganization($datas)
    {
        $uid = auth()->user()->uid;

        $orgDetail = [];
        $orgName = ($datas->orgName) ? $datas->orgName : null;
        $orgEmail = ($datas->orgEmail) ? $datas->orgEmail : null;
        $orgwebsite = isset($datas->orgWebsite) ? $datas->orgWebsite : null;
        $orgStructureId = isset($datas->orgStructureId) ? $datas->orgStructureId : null;
        $orgCategoryId = isset($datas->orgCategoryId) ? $datas->orgCategoryId : null;
        $orgOwnershipId = isset($datas->orgOwnershipId) ? $datas->orgOwnershipId : null;
        $orgDetail = ['orgName' => $orgName, 'orgEmail' => $orgEmail, 'orgwebsite' => $orgwebsite,
            'orgStructureId' => $orgStructureId, 'orgCategoryId' => $orgCategoryId, 'orgOwnershipId' => $orgOwnershipId];
        $orgAddress = [];
        $doorNo = isset($datas->doorNo) ? $datas->doorNo : null;
        $buildingName = isset($datas->buildingName) ? $datas->buildingName : null;
        $street = isset($datas->street) ? $datas->street : null;
        $landMark = isset($datas->landMark) ? $datas->landMark : null;
        $pinCode = isset($datas->pinCode) ? $datas->pinCode : null;
        $districtId = isset($datas->districtId) ? $datas->districtId : null;
        $stateId = isset($datas->stateId) ? $datas->stateId : null;
        $CityId = isset($datas->cityId) ? $datas->cityId : null;
        $area = isset($datas->area) ? $datas->area : null;
        $location = isset($datas->location) ? $datas->location : null;
        $orgAddress = ['doorNo' => $doorNo, 'buildingName' => $buildingName, 'street' => $street, 'landMark' => $landMark, 'pinCode' => $pinCode, 'districtId' => $districtId, 'stateId' => $stateId, 'CityId' => $CityId, 'area' => $area, 'location' => $location];
        $orgDocModels = [];
        if (isset($datas->documentNo)) {

            for ($i = 0; $i < count($datas->documentNo); $i++) {
                if ($datas->documentNo[$i]) {

                    $doctypeId = $datas->orgDocTypeId[$i];
                    $docNo = $datas->documentNo[$i] ?? null;
                    $docValid = $datas->validDate[$i] ?? null;
                    if (isset($datas->fileAttachment[$i]) && $datas->fileAttachment[$i]) {
                        $uniqueFileName[$i] = date('YmdHis') . '_' . uniqid() . '.jpg';
                        $savePath[$i] = storage_path('app/public/OrganizationDocument/' . $uniqueFileName[$i]);
                        File::put($savePath[$i], $datas->fileAttachment[$i]);

                    }
                    $orgDocModel = ['doctypeId' => $doctypeId, 'docNo' => $docNo, 'docValid' => $docValid, 'docFilePath' => isset($uniqueFileName[$i]) ? $uniqueFileName[$i] : ''];

                    array_push($orgDocModels, $orgDocModel);

                }
            }
        }
        if (isset($datas->tempOrgId)) {
            $model = $this->organizationInterface->getTempOrganizationDataByTempId($datas->tempOrgId);
          
        } else {
            $model = new TempOrganization();
        }
        $model->authorized_person_id = $uid;
        $model->organization_detail = json_encode($orgDetail);
        $model->organization_address = json_encode($orgAddress);
        if ($orgDocModels) {
            $model->organization_doc_type = json_encode($orgDocModels);
        }
        return $model;
    }
    public function organizationMasterDatas()
    {
        $state = $this->commonService->getAllStates();
        $orgStructure = $this->organizationInterface->pimsOrganizationStructure();
        $orgCategory = $this->organizationInterface->pimsOrganizationCategory();
        $orgOwnerShip = $this->organizationInterface->pimsOrganizationOwnerShip();
        $orgDocType = $this->organizationInterface->pimsOrganizationDocumentType();
        $result = ['state' => $state, 'orgStructure' => $orgStructure, 'orgCategory' => $orgCategory, 'orgOwnerShip' => $orgOwnerShip, 'orgDocType' => $orgDocType];
        return $this->commonService->sendResponse($result, '');
    }
    public function organizationIndex()
    {
        $uid = auth()->user()->uid;

        $orgName = $this->organizationInterface->getOrganizationName($uid);
        $mainOrganization = $orgName->map(function ($OrgItem) {
            $OrgId = $OrgItem->id;
            $orgName = $OrgItem->OrganizationDetail->org_name;
            return ['OrgName' => $orgName, 'OrgId' => $OrgId];
        });

        $tempOrg = $this->organizationInterface->getAllTempOrganizations($uid);
        $tempOrganization = $tempOrg->map(function ($tempOrgItem) {
            $tempOrgId = $tempOrgItem->id;
            $orgDetails = json_decode($tempOrgItem->organization_detail, true);
            return ['tempOrgName' => $orgDetails['orgName'], 'tempOrgId' => $tempOrgId];
        });

        $result = ['tempOrg' => $tempOrganization, 'mainOrg' => $mainOrganization];
        return $this->commonService->sendResponse($result, '');
    }
}
