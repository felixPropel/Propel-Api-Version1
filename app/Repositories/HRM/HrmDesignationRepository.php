<?php

namespace App\Repositories\HRM;

use App\Interfaces\HrmDesignationInterface;
use App\Models\HrmDesignation;

//use Your Model

/**
 * Class HrmDepartmentRepository.
 */
class HrmDesignationRepository implements HrmDesignationInterface
{
    protected $model;
    public function __construct(HrmDesignation $model)
    {
        $this->model = $model;
    }
    public function findAll()
    {
        $datas = $this->model::with('hrmDesDept')->get();
       
        return $datas;
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
        $data = $this->model::with('hrmDesDept')->where('id', $id)->first();
        return $data;
    }
    public function findByName($name)
    {
        $data = $this->model::where('name', $name)->first();
        return $data;
    }

    public function findAllByDeptId($deptId)
    {
        $data = $this->model::where('dept_id', $deptId)->get();
        return $data;
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
