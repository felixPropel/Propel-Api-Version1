<?php

namespace App\Services\HRM;

use App\Interfaces\HrmDepartmentInterface;
use App\Models\HrmDepartment;
use App\Repositories\HRM\Masters\HrmDepartmentRepository;

/**
 * Class HrmDepartmentService
 * @package App\Services
 */
class HrmDepartmentService
{
    protected $interface;
    public function __construct(HrmDepartmentInterface $interface)
    {
        $this->interface = $interface;
    }
    public function index()
    {
        $models = $this->interface->index();
        return $models;
    }
    public function store($data, $id = false)
    {
        $model = $this->convertToModel($data, $id);
        $response = $this->interface->store($model);

        return $response;
    }
    public function findById($id)
    {
        $response = $this->interface->findById($id);
        return $response;
    }


    public function convertToModel($data, $id = false)
    {

        $data = (object)$data;

        if ($id) {
            $model = $this->interface->findById($id);
        } else {
            $model = new HrmDepartment();
        }
        $model->name = $data->name;
        $model->parent_dept_id = ($data->parent_dept_id) ? $data->parent_dept_id : null;
        $model->description = $data->description;
        $model->status = 1;

        return $model;
    }
    public function destroyById($id)
    {
       
        $response = $this->interface->destroy($id);
        return $response;
    }
}
