<?php

namespace App\Http\Controllers\version1\Services\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Interfaces\User\UserInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationDatabase;
use App\Models\Organization\OrganizationDetail;
use App\Models\Organization\OrganizationEmail;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
        Log::info('OrganizationService > getOrganizationAccountByUid function Return.' . json_encode($OrganizationAccountModel));
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
        $model =  $this->organizationInterface->saveOrganization($generateOrganizationModel, $generateOrganizationDetailModel, $generateOrganizationEmailModel, $generateUserAccountModel,$generateOrganizationDatabaseModel);
        Log::info('OrganizationService > store function Return.' . json_encode($model));

        if ($model['message'] == "Success") {           
            return $this->commonService->sendResponse($model, $model['message']);
        } else {
            return $this->commonService->sendError($model['data'], $model['message']);
        }
    }

  
    public function convertToOrganizationModel($datas)
    {
        Log::info('OrganizationService > convertToOrganizationModel function Inside.' . json_encode($datas));
        $model = new Organization();
        $model->authorization = "1";
        $model->origin =  $datas->origin;
        //$model->db_name = $datas->organizationName;
        //$model->status = "1";
        Log::info('OrganizationService > convertToOrganizationModel function Return.' . json_encode($model));
        return $model;
    }
    public function convertToOrganizationDatabaseModel($datas)
    {
        Log::info('OrganizationService > convertToOrganizationDatabaseModel function Inside.' . json_encode($datas));
        $dbName = now()->timestamp . preg_replace('/\s+/', '', $datas->organizationName);
        $model = new OrganizationDatabase();
        $model->db_name = $dbName;
        Log::info('OrganizationService > convertToOrganizationDatabaseModel function Return.' . json_encode($model));
        return $model;
    }
    public function convertToOrganizationDetailModel($datas)
    {
        Log::info('OrganizationService > convertToOrganizationDetailModel function Inside.' . json_encode($datas));
        $model = new OrganizationDetail();
        $model->title_id = (isset($datas->title_id) ? $datas->title_id : "");
        $model->org_name = $datas->organizationName;
        $model->org_alias = (isset($datas->org_alias) ? $datas->org_alias : null);
        $model->started_date = (isset($datas->started_date) ? $datas->started_date : null);
        $model->year_of_establishment = (isset($datas->year_of_establishment) ? $datas->year_of_establishment : null);
        // $model->org_category_id = (isset($datas->organizationCategory) ? $datas->organizationCategory : 0);
        //$model->org_ownership_id = (isset($datas->ownerShip) ? $datas->ownerShip : 0);
        $model->is_registered_org = (isset($datas->is_registered_org) ? $datas->is_registered_org : null);
        $model->date_of_reg = (isset($datas->date_of_reg) ? $datas->date_of_reg : null);
        Log::info('OrganizationService > convertToOrganizationDetailModel function Return.' . json_encode($model));
        return $model;
    }
    public function convertToOrganizationEmailModel($datas)
    {
        Log::info('OrganizationService > convertToOrganizationEmailModel function Inside.' . json_encode($datas));
        $model = new OrganizationEmail();
        $model->email =  $datas->organizationEmail;
        //$model->origin =  $datas->origin;
        //$model->db_name = $datas->organizationName;
        $model->status = "1";
        Log::info('OrganizationService > convertToOrganizationEmailModel function Return.' . json_encode($model));
        return $model;
    }
    public function convertToUserAccountModel($datas)
    {
        Log::info('OrganizationService > convertToUserAccountModel function Inside.' . json_encode($datas));
        $model = new UserOrganizationRelational();
        $model->uid = Auth::user()->uid;
        Log::info('OrganizationService > convertToUserAccountModel function Return.' . json_encode($model));
        return $model;
    }
}
