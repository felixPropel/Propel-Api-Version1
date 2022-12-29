<?php

namespace App\Http\Controllers\version1\Services\HRM\Masters;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;

use App\Models\HrmResourceType;
use Illuminate\Support\Facades\Log;

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
        Log::info('HrmHumanResourceTypeService > index function Inside.' . json_encode($orgId));
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $models = $this->interface->index();
        Log::info('HrmHumanResourceTypeService > index function Return.' . json_encode($models));
        return $this->commonService->sendResponse($models, '');
    }
    public function store($data, $orgId)
    {
        Log::info('HrmHumanResourceTypeService > Store function Inside.' . json_encode($data));
        Log::info('HrmHumanResourceTypeService > Store function Inside.' . json_encode($orgId));
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->convertToModel($data);
        $response = $this->interface->store($model);
        Log::info('HrmHumanResourceTypeService > Store function Return.' . json_encode($response));
        return $this->commonService->sendResponse($response, '');
    }
    public function convertToModel($data)
    {
        Log::info('HrmHumanResourceTypeService > convertToModel function Inside.' . json_encode($data));
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
        Log::info('HrmHumanResourceTypeService > convertToModel function Return.' . json_encode($model));
        return $model;
    }
    public function findById($orgId, $id)
    {
        Log::info('HrmHumanResourceTypeService > findById function Inside.' . json_encode($orgId));
        Log::info('HrmHumanResourceTypeService > findById function Inside.' . json_encode($id));
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $response = $this->interface->findById($id);
        Log::info('HrmHumanResourceTypeService > findById function Return.' . json_encode($response));
        return $this->commonService->sendResponse($response, '');
    }
    public function destroyById($orgId, $id)
    {
        Log::info('HrmHumanResourceTypeService > destroyById function Inside.' . json_encode($orgId));
        $dbConnection = $this->commonService->getOrganizationDatabaseByOrgId($orgId);
        $model = $this->interface->findById($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        $response = $this->interface->store($model);
        Log::info('HrmHumanResourceTypeService > destroyById function Return.' . json_encode($response));
        return $this->commonService->sendResponse("", 'Deleted Successfully');
    }
}
