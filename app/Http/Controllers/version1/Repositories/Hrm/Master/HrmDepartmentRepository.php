<?php

namespace App\Http\Controllers\version1\Repositories\Hrm\Master;

use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;

use App\Models\HrmDepartment;

//use Your Model

/**
 * Class HrmDepartmentRepository.
 */
class HrmDepartmentRepository implements HrmDepartmentInterface
{

    public function findAll()
    {

        return HrmDepartment::whereNull('deleted_at')->get();
    }
    public function store($data)
    {
        $data->save();
        return [
            'message' => "success",
            'data' => $data
        ];
    }
    public function findById($id)
    {
        $data = $this->model::where('id', $id)->first();
        return $data;
    }
    public function getParentDeptExceptThisId($id)
    {
        return $this->model::where('id', '!=', $id)->whereNull('deleted_at')->get();
    }

    public function destroy($id)
    {
        $res = $this->model::findOrFail($id)->delete();

        return [
            'message' => "Success",
            'data' => "Deleted Successfully."
        ];
    }
}
