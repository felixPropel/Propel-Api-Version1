<?php

namespace App\Services\HRM;
use App\Interfaces\HrmDesignationInterface;
use App\Models\HrmDesignation;

/**
 * Class HrmDesigationService
 * @package App\Services
 */
class HrmDesignationService
{
    protected $interface;
    public function __construct(HrmDesignationInterface $interface)
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
    public function convertToModel($data, $id = false)
    {

        $data = (object)$data;

        if ($id) {
            $model = $this->interface->findById($id);
        } else {
            $model = new HrmDesignation();
        }
        $model->name = $data->name;
        $model->dept_id = $data->dept_id;
        $model->description = $data->description;
        $model->status = 1;

        return $model;
    }
    public function findById($id)
    {
        $response = $this->interface->findById($id);
        return $response;
    }
    public function destroyById($id)
    {
        $response = $this->interface->destroy($id);
        return $response;
    }
}
