<?php

namespace App\Http\Controllers\version1\Repositories\Hrm\Master;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;

use App\Models\HrmDepartment;
use Illuminate\Support\Facades\DB;

//use Your Model

/**
 * Class HrmDepartmentRepository.
 */
class HrmDepartmentRepository implements HrmDepartmentInterface
{

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
}
