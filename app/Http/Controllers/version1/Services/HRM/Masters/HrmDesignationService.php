<?php

namespace App\Http\Controllers\version1\Services\HRM\Masters;


use App\Models\HrmDepartment;
use App\Models\HrmDesignation;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDesignationInterface;
use App\Http\Controllers\version1\Services\HRM\Masters\HrmDepartmentService;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;

/**
 * Class HrmDesigationService
 * @package App\Services
 */
class HrmDesignationService
{
    protected $interface, $commonService, $service, $hrmDeptInterface;
    public function __construct(CommonService $commonService, HrmDesignationInterface $interface, HrmDepartmentService $service, HrmDepartmentInterface $hrmDeptInterface)
    {
        $this->commonService = $commonService;
        $this->interface = $interface;
        $this->service = $service;
        $this->hrmDeptInterface = $hrmDeptInterface;
    }
    public function findAll($orgId)
    {

        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $models = $this->interface->findAll();
        $department = $this->hrmDeptInterface->findAll();
        $responseArray = ['model' => $models, 'department' => $department];
        return $this->commonService->sendResponse($responseArray, '');
    }
    public function create($orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $models = $this->hrmDeptInterface->findAll();
        return $this->commonService->sendResponse($models, '');
    }
    public function store($data, $orgId)
    {


        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->convertToModel($data);
        $response = $this->interface->store($model);

        return $response;
    }
    public function convertToModel($data)
    {

        $data = (object)$data;
        $id = $data->id;
        if ($id) {
            $model = $this->interface->findById($id);
            $model->last_updated_by = auth()->user()->uid;
        } else {
            $model = new HrmDesignation();
            $model->created_by = auth()->user()->uid;
        }
        $model->designation_name = $data->designation;
        $model->no_of_posting = $data->no_of_posting;
        $model->dept_id = $data->department;
        $model->description = $data->description;
        $model->pfm_active_status_id = isset($data->activeStatus) ? $data->activeStatus : null;
        return $model;
    }
    public function findById($orgId, $id)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $response = $this->interface->findById($id);
        $department = $this->hrmDeptInterface->findAll();
        $responseArray = ['responseModelData' => $response, 'department' => $department];

        return $this->commonService->sendResponse($responseArray, '');
    }
    public function destroyById($orgId, $id)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->interface->findById($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        $response = $this->interface->store($model);
        return $this->commonService->sendResponse("", 'Deleted Successfully');
    }
}
