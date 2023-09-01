<?php

namespace App\Http\Controllers\version1\Services\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationDatabase;
use App\Models\Organization\OrganizationDetail;
use App\Models\Organization\OrganizationDocument;
use App\Models\Organization\OrganizationEmail;
use App\Models\Organization\OrganizationWebAddress;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\PropertyAddress;
use App\Models\TempOrganization;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
    public function store($datas)
    {
        Log::info('OrganizationService > store function Inside.' . json_encode($datas));
        $datas = (object) $datas;
        $generateOrganizationModel = $this->convertToOrganizationModel($datas);
        $generateOrganizationDetailModel = $this->convertToOrganizationDetailModel($datas);
        $generateOrganizationEmailModel = $this->convertToOrganizationEmailModel($datas);
        $generateUserAccountModel = $this->convertToUserAccountModel($datas);   
        $generateOrganizationDatabaseModel = $this->convertToOrganizationDatabaseModel($datas);
        $generateOrganizationDocumentModel = $this->convertToOrganizationDocumentModel($datas);
        $generateOrganizationWebAddressModel = $this->convertToOrganizationWebAddressModel($datas);
        $generateOrganizationAddressModel = $this->convertToOrganizationAddressModel($datas);
        $model = $this->organizationInterface->saveOrganization($generateOrganizationModel, $generateOrganizationDetailModel, $generateOrganizationEmailModel, $generateUserAccountModel, $generateOrganizationDatabaseModel, $generateOrganizationDocumentModel, $generateOrganizationWebAddressModel, $generateOrganizationAddressModel);

        if ($model['message'] == "Success") {
            return $this->commonService->sendResponse($model, $model['message']);
        } else {
            return $this->commonService->sendError($model['data'], $model['message']);
        }
    }

    public function convertToOrganizationModel($datas)
    {
        $model = new Organization();
        $model->stage = "2";
        $model->authorization = "1";
        $model->origin = $datas->origin;
        //$model->status = "1";
        return $model;
    }
    public function convertToOrganizationDatabaseModel($datas)
    {
        Log::info('OrganizationService > convertToOrganizationDatabaseModel function Inside.' . json_encode($datas));
        $dbName = now()->timestamp . preg_replace('/\s+/', '', $datas->organizationName);
        $model = new OrganizationDatabase();
        $model->db_name = $dbName;
        return $model;
    }
    public function convertToOrganizationDetailModel($datas)
    {
        $model = new OrganizationDetail();
        $model->title_id = (isset($datas->title_id) ? $datas->title_id : null);
        $model->org_name = $datas->organizationName;
        $model->org_alias = (isset($datas->org_alias) ? $datas->org_alias : null);
        $model->started_date = (isset($datas->started_date) ? $datas->started_date : null);
        $model->year_of_establishment = (isset($datas->year_of_establishment) ? $datas->year_of_establishment : null);
        // $model->org_category_id = (isset($datas->organizationCategory) ? $datas->organizationCategory : 0);
        //$model->org_ownership_id = (isset($datas->ownerShip) ? $datas->ownerShip : 0);
        $model->is_registered_org = (isset($datas->is_registered_org) ? $datas->is_registered_org : null);
        $model->date_of_reg = (isset($datas->date_of_reg) ? $datas->date_of_reg : null);
        return $model;
    }
    public function convertToOrganizationEmailModel($datas)
    {
        $model = new OrganizationEmail();
        $model->email = $datas->organizationEmail;
        $model->status = "1";
        return $model;
    }
    public function convertToUserAccountModel($datas)
    {
        $model = new UserOrganizationRelational();
        $model->uid = $datas->uid;
        return $model;
    }
    public function getDataBaseNameByid($orgId)
    {
        $datas = (object) $datas;
        $model = $this->organizationInterface->getDataBaseNameById($datas->id);

        Session::put('orgDb', $model->db_name);

        return $this->commonService->sendResponse($model, '');
    }
    public function convertToOrganizationDocumentModel($datas)
    {
        $model = new OrganizationDocument();
        $model->org_gst_no = (isset($datas->organizationGst) ? $datas->organizationGst : null);
        $model->org_pan_no = (isset($datas->organizationPan) ? $datas->organizationPan : null);
        // $model->doc_validity=Null;
        // $model->attachment=Null;
        $model->status = 1;
        return $model;
    }
    public function convertToOrganizationWebAddressModel($datas)
    {
        $model = new OrganizationWebAddress();
        $model->web_address = (isset($datas->organizationWebsite) ? $datas->organizationWebsite : null);
        $model->status = 1;
        return $model;

    }
    public function convertToOrganizationAddressModel($datas)
    {
        $model = new PropertyAddress();
        $model->door_no = (isset($datas->doorNo) ? $datas->doorNo : null);
        $model->building_name = (isset($datas->buildingName) ? $datas->buildingName : null);
        $model->pin = (isset($datas->pincode) ? $datas->pincode : null);
        $model->state_id = (isset($datas->state) ? $datas->state : null);
        $model->street = (isset($datas->street) ? $datas->street : null);
        $model->land_mark = (isset($datas->landmark) ? $datas->landmark : null);
        $model->district = (isset($datas->district) ? $datas->district : null);
        $model->city_id = (isset($datas->city) ? $datas->city : null);
        $model->area = (isset($datas->area) ? $datas->area : null);
        return $model;
    }
    public function setDefaultOrganization($datas)
    {
        $datas = (object) $datas;
        $model = $this->organizationInterface->changeDefaultOrganization($datas->uid);
        if ($model) {
            $model->default_org =0;
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
    }else{
        $datas=(object)$datas;
        $convertTempOrg=$this->convertTempOrganization($datas);
        $storeTempOrg=$this->organizationInterface->storeTempOrganization( $convertTempOrg);
        return $this->commonService->sendResponse($storeTempOrg, '');
    }
}
public function convertTempOrganization($datas)
{
    $model = new TempOrganization();
    $model->org_name=$datas->org_name;
    $model->org_email=$datas->org_email;
    $model->org_website=$datas->org_website;   
    $model->door_no=$datas->door_no;  
    $model->building_name=$datas->building_name;
    $model->street=$datas->street; 
    $model->landmark=$datas->landmark;  
    $model->pincode=$datas->pin_code;  
    $model->district_id = $datas->district_id ?? null;
    $model->state_id=$datas->state_id;  
    $model->city_id=$datas->city_id;  
    $model->area=$datas->area;  
    $model->location=$datas->location;  
    $model->tried_person_id=$datas->uid;
    $model->gst_no=$datas->org_gst;
    $model->pan_no=$datas->org_pan;

    return $model;

}
}
