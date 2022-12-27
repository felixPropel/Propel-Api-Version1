<?php

namespace App\Http\Controllers\version1\Services\HRM\Masters;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;

use App\Models\HrmDepartment;


/**
 * Class HrmDepartmentService
 * @package App\Services
 */
class HrmDepartmentService
{
    protected $interface;
    public function __construct(HrmDepartmentInterface $interface,CommonService $commonService)
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
    public function create()
    {
        $models = $this->interface->findAll();
        return $models;
    }
   
    public function store($data, $id = false)
    {
        $model = $this->convertToModel($data, $id);
        $response = $this->interface->store($model);

        return $response;
    }
    public function findById($id)
    {
        $response = $this->interface->findById($id);
        $responseParentDeptData = $this->interface->getParentDeptExceptThisId($id);
        $responseArray = ['resposeModelData' => $response, 'responseParentDeptData' => $responseParentDeptData];
        return $responseArray;
    }


    public function convertToModel($data, $id = false)
    {

        $data = (object)$data;

        if ($id) {
            $model = $this->interface->findById($id);
        } else {
            $model = new HrmDepartment();
        }
        $model->name = $data->name;
        $model->parent_dept_id = ($data->parent_dept_id) ? $data->parent_dept_id : null;
        $model->description = $data->description;
        $model->status = 1;

        return $model;
    }
    public function destroyById($id)
    {

        $response = $this->interface->destroy($id);
        return $response;
    }
}
