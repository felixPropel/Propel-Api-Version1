<?php

namespace App\Services\HRM\Masters;
use App\Interfaces\HrmHumanResourceTypeInterface;
use App\Models\HrmHumanResourceType;
use App\Repositories\HRM\Masters\HrmResourceTypeRepository;


/**
 * Class HrmHumanResourceTypeService
 * @package App\Services
 */
class HrmHumanResourceTypeService
{
    protected $interface;
    public function __construct(HrmHumanResourceTypeInterface $interface)
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
            $model = new HrmHumanResourceType();
        }
        $model->name = $data->name;
        $model->description = $data->description;
        $model->status =  $data->status; 

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
