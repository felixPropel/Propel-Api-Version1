<?php

namespace App\Http\Controllers\version1\Repositories\Hrm\Master;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDesignationInterface;

use App\Models\HrmDesignation;
use Illuminate\Support\Facades\DB;

//use Your Model

/**
 * Class HrmDesignationRepository.
 */
class HrmDesignationRepository implements HrmDesignationInterface
{

    public function findAll()
    {

        return HrmDesignation::whereNull('deleted_at')->get();
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
        $data = HrmDesignation::where('id', $id)->first();
        return $data;
    }
    public function findByDeptId($deptId)
    {
        $data = HrmDesignation::where('dept_id', $deptId)->get();
        return $data;
    }
}
