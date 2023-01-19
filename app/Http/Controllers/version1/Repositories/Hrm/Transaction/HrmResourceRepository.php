<?php

namespace App\Http\Controllers\version1\Repositories\Hrm\Transaction;

use App\Http\Controllers\version1\Interfaces\Hrm\Transaction\HrmResourceInterface;
use App\Models\HrmDepartment;
use App\Models\HrmResource;
use Illuminate\Support\Facades\DB;

//use Your Model

/**
 * Class HrmDepartmentRepository.
 */
class HrmResourceRepository implements HrmResourceInterface
{
    public function findResourceByUid($uid)
    {
        return HrmResource::where('uid', $uid)->first();
    }

    public function findAll()
    {

        return HrmResource::with('Person.personDetails','designation.ParentHrmDesignation','designation.ParentHrmDesignation.department')->whereNull('deleted_at')->get();
    }
    public function store($model)
    {
        try {
            $result = DB::transaction(function () use ($model) {

                $model->save();
                return [
                    'message' => "Success",
                    'data' => $model
                ];
            });

            return $result;
        } catch (\Exception $e) {


            return [

                'message' => "failed",
                'data' => $e
            ];
        }
    }
    public function findById($id)
    {
        $data = HrmDepartment::with('hrmParentDept')->where('id', $id)->first();
        return $data;
    }
    public function getParentDeptExceptThisId($id)
    {
        return HrmDepartment::where('id', '!=', $id)->whereNull('deleted_at')->get();
    }
    public function saveResourceModel($model)
    {
        $model->save();
        return $model;
    }
    public function saveResource($allModels)
    {

        try {

            $result = DB::transaction(function () use ($allModels) {
               

                $resourceModel = $allModels['resourceModel'];
                $resourceTypeDetailModel = $allModels['resourceTypeDetailModel'];
                $resourceDesignModel = $allModels['resourceDesignModel'];
                $resourceWorkingModel = $allModels['resourceWorkingModel'];
                $userAccountModel = $allModels['userAccountModel'];

                $resourceModel->save();

                $resourceTypeDetailModel->ParentHrmResource()->associate($resourceModel,  'resource_id','id');
                $resourceDesignModel->ParentHrmResource()->associate($resourceModel, 'resource_id', 'id');
                $resourceWorkingModel->ParentHrmResource()->associate($resourceModel, 'resource_id', 'id');
                $userAccountModel->ParentPerson()->associate($resourceModel, 'uid', 'uid');


                $resourceTypeDetailModel->save();
                $resourceDesignModel->save();
                $resourceWorkingModel->save();
                $userAccountModel->save();
                
                return [
                    'message' => "Success",
                    'data' => $resourceModel

                ];
            });

            return $result;
        } catch (\Exception $e) {


            return [

                'message' => "failed",
                'data' => $e
            ];
        }
    }
}
