<?php

namespace App\Http\Controllers\version1\Services\HRM\Masters;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;

use App\Models\HrmResourceType;

/**
 * Class HrmHumanResourceTypeService
 * @package App\Services
 */
class HrmHumanResourceTypeService
{
    protected $interface;
    public function __construct(HrmHumanResourceTypeInterface $interface, CommonService $commonService)
    {
        $this->interface = $interface;
        $this->commonService = $commonService;
    }
    public function index($orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
       
        $models = $this->interface->index();
        return $this->commonService->sendResponse($models, '');
    }
    public function store($data, $orgId)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->convertToModel($data);
        $response = $this->interface->store($model);
        return $this->commonService->sendResponse($response, '');
    }
    public function convertToModel($data)
    {
        $data = (object)$data;
        $id = $data->id;
        if ($id) {
            $model = $this->interface->findById($id);
        } else {
            $model = new HrmResourceType();
        }
        $model->name = $data->name;
        $model->description = $data->description;
        $model->active_state = isset($data->active_state) ? 1 : 0;

        return $model;
    }
    public function findById($orgId, $id)
    {
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $response = $this->interface->findById($id);
        return $this->commonService->sendResponse($response, '');
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
