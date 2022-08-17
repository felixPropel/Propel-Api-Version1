<?php

namespace App\Repositories\HRM;
use App\Interfaces\HrmHumanResourceTypeInterface;
use App\Models\HrmHumanResourceType;


//use Your Model

/**
 * Class HrmDepartmentRepository.
 */
class HrmHumanResourceTypeRepository implements HrmHumanResourceTypeInterface
{
    protected $model;
    public function __construct(HrmHumanResourceType $model)
    {
        $this->model = $model;
    }
    public function index()
    {        
        $datas = $this->model::get();
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
        $data = $this->model::where('id', $id)->first();
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