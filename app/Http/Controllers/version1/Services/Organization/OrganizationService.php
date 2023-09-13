<?php

namespace App\Http\Controllers\version1\Services\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationCategory;
use App\Models\Organization\OrganizationDatabase;
use App\Models\Organization\OrganizationStructure;
use App\Models\Organization\OrganizationDetail;
use App\Models\Organization\OrganizationDocument;
use App\Models\Organization\OrganizationEmail;
use App\Models\Organization\OrganizationOwnership;
use App\Models\Organization\OrganizationWebAddress;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\PropertyAddress;
use App\Models\TempOrganization;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class OrganizationService
{
    public function __construct(OrganizationInterface $organizationInterface, CommonService $commonService)
    {
        $this->organizationInterface = $organizationInterface;
        $this->commonService = $commonService;
    }
    public function getOrganizationAccountByUid($datas)
    {
        Log::info('OrganizationService > getOrganizationAccountByUid function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $OrganizationAccountModel = $this->organizationInterface->getOrganizationAccountByUid($datas->uid);
        return $this->commonService->sendResponse($OrganizationAccountModel, "");
    }
    public function store($tempOrgId)
    {
       
        Log::info('OrganizationService > store function Inside.' . json_encode($tempOrgId));
        $tempOrgData = $this->organizationInterface->getTempOrganizationDataByTempId($tempOrgId);
        if ($tempOrgData) {
            $datas = (object) $tempOrgData;
            $generateOrganizationModel = $this->convertToOrganizationModel($datas);
            $generateOrganizationDetailModel = $this->convertToOrganizationDetailModel($datas);
            $generateOrganizationEmailModel = $this->convertToOrganizationEmailModel($datas);
            $generateOrganizationWebAddressModel = $this->convertToOrganizationWebAddressModel($datas);
            $generateOrganizationAddressModel = $this->convertToOrganizationAddressModel($datas);
            $generateOrganizationDatabaseModel = $this->convertToOrganizationDatabaseModel($datas);
            $orgModel=$this->organizationInterface->saveOrganization($generateOrganizationModel,$generateOrganizationDetailModel,$generateOrganizationEmailModel,$generateOrganizationWebAddressModel,$generateOrganizationAddressModel,$generateOrganizationDatabaseModel);

            $orgId = $orgModel['data']->id;
            $org_name=$orgModel['data']->db_name;
            $CreateDynamicDb=$this->createDynamicDatabase($org_name);
            $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
            $generateOrganizationDocumentModel = $this->convertToOrganizationDocumentModel($datas,$orgId);
            $generateOrganizationOwnerShipIdModel = $this->convertOrganizationOwnerShipModel($datas,$orgId); 
            $generateOrganizationCategoryIdModel = $this->convertOrganizationCategoryModel($datas,$orgId);  
            $generateOrganizationStructureIdModel = $this->convertOrganizationStructureModel($datas,$orgId);           
            $model = $this->organizationInterface->dynamicOrganizationData($generateOrganizationDocumentModel, $generateOrganizationOwnerShipIdModel, $generateOrganizationCategoryIdModel, $generateOrganizationStructureIdModel);
            // $generateUserAccountModel = $this->convertToUserAccountModel($datas);
            if ($model['message'] == "Success") {
                return $this->commonService->sendResponse($model, $model['message']);
            } else {
                return $this->commonService->sendError($model['data'], $model['message']);
            }
        } else {
            return $this->commonService->sendError('TempOrgId  Not Found', 'Empty');

        }
    }
public function  createDynamicDatabase($db_name)
{
    $preDatabase = Config::get('database.connections.mysql.database'); 
    DB::statement("CREATE DATABASE IF NOT EXISTS $db_name");
     $new = Config::set('database.connections.mysql.database', $db_name);
    DB::purge('mysql');
    DB::reconnect('mysql');
    \Artisan::call('migrate');
    $current=Config::set('database.connections.mysql.database', $preDatabase);
    DB::purge('mysql');
    DB::reconnect('mysql');
     return true;
}
    public function convertToOrganizationModel($datas)
    {
        $model = new Organization();
        $model->stage = "1";
        $model->authorization = "1";
        $model->origin = '1';
        return $model;
    }
    public function convertToOrganizationDatabaseModel($datas)
    {
        Log::info('OrganizationService > convertToOrganizationDatabaseModel function Inside.' . json_encode($datas));
        $dbName = now()->timestamp . preg_replace('/\s+/', '', $datas->org_name);
        $model = new OrganizationDatabase();
        $model->db_name = $dbName;
        $model->org_id = 1;
        return $model;
    }
    public function convertToOrganizationDetailModel($datas)
    {
        $model = new OrganizationDetail();
        $model->title_id = (isset($datas->title_id) ? $datas->title_id : null);
        $model->org_name = $datas->org_name;
        $model->org_alias = (isset($datas->org_alias) ? $datas->org_alias : null);
        $model->started_date = (isset($datas->started_date) ? $datas->started_date : null);
        $model->year_of_establishment = (isset($datas->year_of_establishment) ? $datas->year_of_establishment : null);
        $model->is_registered_org = (isset($datas->is_registered_org) ? $datas->is_registered_org : null);
        $model->date_of_reg = (isset($datas->date_of_reg) ? $datas->date_of_reg : null);
        return $model;
    }
    public function convertToOrganizationEmailModel($datas)
    {
        $model = new OrganizationEmail();
        $model->email = $datas->org_email;
        $model->status = "1";
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
    public function convertToOrganizationDocumentModel($datas,$orgId)
    {
        $model = new OrganizationDocument();
        $model->org_id=$orgId;
        $model->org_doc_type_id = (isset($datas->doc_type_id) ? $datas->doc_type_id : null);
        $model->doc_no = null;
        $model->doc_validity = null;
        $model->doc_attachment = null;
        $model->active_status = 1;
        return $model;
    }
    public function convertToOrganizationWebAddressModel($datas)
    {
        $model = new OrganizationWebAddress();
        $model->web_address = (isset($datas->org_website) ? $datas->org_website : null);
        $model->status = 1;
        return $model;

    }
    public function convertToOrganizationAddressModel($datas)
    {
        $model = new PropertyAddress();
        $model->door_no = (isset($datas->door_no) ? $datas->door_no : null);
        $model->building_name = (isset($datas->building_name) ? $datas->building_name : null);
        $model->pin = (isset($datas->pincode) ? $datas->pincode : null);
        $model->state_id = (isset($datas->state_id) ? $datas->state_id : null);
        $model->street = (isset($datas->street) ? $datas->street : null);
        $model->land_mark = (isset($datas->landmark) ? $datas->landmark : null);
        $model->district = (isset($datas->district_id) ? $datas->district_id : null);
        $model->city_id = (isset($datas->city_id) ? $datas->city_id : null);
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
            'org_name' => 'required',
            'org_email' => 'required|email',
            'pin_code' => 'required|numeric',
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
    public function convertOrganizationOwnerShipModel($datas,$orgId)
    {
        $model = new OrganizationOwnership();
        $model->org_id=$orgId;
        $model->org_ownership_id = (isset($datas->org_ownership_id) ? $datas->org_ownership_id : null);
        return $model;
    }
    public function convertOrganizationCategoryModel($datas,$orgId)
    {
        $model = new OrganizationCategory();
        $model->org_id=$orgId;
        $model->org_category_id = (isset($datas->org_category_id) ? $datas->org_category_id : null);
        return $model;
    }
    public function convertOrganizationStructureModel($datas,$orgId)
    {
        $model = new OrganizationStructure();
        $model->org_id=$orgId;
        $model->org_structure_id = (isset($datas->org_structure_id) ? $datas->org_structure_id : null);
        return $model;
    }
    public function convertTempOrganization($datas)
    {
        $model = new TempOrganization();
        $model->org_name = $datas->org_name;
        $model->org_email = $datas->org_email;
        $model->org_website = $datas->org_website;
        $model->door_no = $datas->door_no;
        $model->building_name = $datas->building_name;
        $model->street = $datas->street;
        $model->landmark = $datas->landmark;
        $model->pincode = $datas->pin_code;
        $model->district_id = $datas->district_id ?? null;
        $model->state_id = $datas->state_id;
        $model->city_id = $datas->city_id;
        $model->area = $datas->area;
        $model->location = $datas->location;
        $model->tried_person_id = $datas->uid;
        $model->gst_no = $datas->org_gst;
        $model->gst_available_status = $datas->org_gst ?? '1';
        $model->authority_status = 1;
        $model->pan_no = $datas->org_pan;

        return $model;

    }
}
