<?php

namespace App\Http\Controllers\Api\Hrm\HrmMasters\Repository;

use App\Http\Controllers\Api\Hrm\HrmMasters\Model\HrmDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HrmDepartmentRepository implements HrmDepartmentRepositoryInterface
{
    public function findAll()
    {
        $query = HrmDepartment::get();
        return $query;
    }
    public function findById($id)
    {
        $query = HrmDepartment::where('id', $id)->first();
        return $query;
    }
    public function save(HrmDepartment $model, $id = false)
    {

        try {
            $result = DB::transaction(function () use ($model) {
                $model->save();
                return [
                    'message' => pStatusSuccess(),
                    'data' => $model
                ];
            });

            return $result;
        } catch (\Exception $e) {

            return [
                'message' => pStatusFailed(),
                'data' => $e
            ];
        }
    }
    public function destroyById(HrmDepartment $model)
    {

        try {
            $result = DB::transaction(function () use ($model) {
                $model->delete();
                return [
                    'message' => pStatusSuccess(),
                    'data' => "Deleted Successfully."
                ];
            });

            return $result;
        } catch (\Exception $e) {


            return [

                'message' => pStatusFailed(),
                'data' => $e
            ];
        }
    }
}
