<?php

namespace App\Http\Controllers\version1\Services\HRM\Masters;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;

use App\Models\HrmDepartment;
use Illuminate\Support\Facades\Session;

/**
 * Class HrmDepartmentService
 * @package App\Services
 */
class HrmDepartmentService
{
    protected $interface,$commonService;
    public function __construct(HrmDepartmentInterface $interface, CommonService $commonService)
    {
        $this->interface = $interface;
        $this->commonService = $commonService;
    }
    public function findAll($orgId)
    {
      
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $models = $this->interface->findAll();
        return $this->commonService->sendResponse($models, '');
    }
    public function create($orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $models = $this->interface->findAll();
        return $models;
    }

    public function store($data, $orgId)
    {
       
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->convertToModel($data);
        $response = $this->interface->store($model);

        return $this->commonService->sendResponse($response, '');
    }
    public function findById($orgId, $id)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);

        $response = $this->interface->findById($id);
        $responseParentDeptData = $this->interface->getParentDeptExceptThisId($id);
        $responseArray = ['responseModelData' => $response, 'responseParentDeptData' => $responseParentDeptData];

        return $this->commonService->sendResponse($responseArray, '');
    }


    public function convertToModel($data)
    {
        $data = (object) $data;
        $id=$data->id;
        if ($id) {
            $model = $this->interface->findById($id);
            $model->last_updated_by=auth()->user()->uid;
        } else {
            $model = new HrmDepartment();
            $model->created_by=auth()->user()->uid;

        }
        $model->department_name = $data->department;
        $model->parent_dept_id = isset($data->parent_dept_id) ? $data->parent_dept_id : null;
        $model->description = $data->description;
        $model->pfm_active_status_id =isset($data->activeStatus) ? $data->activeStatus : null;

        return $model;
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
