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
       return HrmResource::where('uid',$uid)->first();
    }

    public function findAll()
    {

        return HrmDepartment::with('hrmParentDept')->whereNull('deleted_at')->get();
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
     public function saveResource($ResourceTypeDetail, $ResourceDesignation, $ResourceDateOfJoin,$ResourceWorking)
     {
         
        try {
            $result = DB::transaction(function () use ($ResourceTypeDetail, $ResourceDesignation, $ResourceDateOfJoin,$ResourceWorking) {

        $ResourceTypeDetail->save();
        $ResourceDesignation->save();
        $ResourceDateOfJoin->save();
        $ResourceWorking->save(); 
                return [
                    'message' => "Success"
                   
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
