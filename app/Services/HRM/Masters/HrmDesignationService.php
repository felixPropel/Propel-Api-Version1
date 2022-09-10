<?php

namespace App\Services\HRM\Masters;

use App\Interfaces\HrmDepartmentInterface;
use App\Interfaces\HrmDesignationInterface;
use App\Models\HrmDepartment;
use App\Models\HrmDesignation;

/**
 * Class HrmDesigationService
 * @package App\Services
 */
class HrmDesignationService
{
    protected $interface;
    public function __construct(HrmDesignationInterface $interface,HrmDepartmentInterface $deptInterface)
    {
        $this->deptInterface = $deptInterface;
        $this->interface = $interface;
    }
    public function findAll()
    {
        
        $models = $this->interface->findAll();
        return $models;
    }
    public function create()
    {
        
        $departmentModels = $this->deptInterface->findAll();
        return $departmentModels;

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
        $unAssignedDesId = $this->interface->findByName('Un-Assigned');
        $model->name = $data->designation;
        $model->dept_id =$data->dept_id;
        $model->no_of_posting =$data->no_of_posting;
        $model->description = $data->description;
        $model->status =1;


        return $model;
    }
    public function findById($id)
    {
        $modelData = $this->interface->findById($id);    
        $getDepartmentDatas = $this->deptInterface->findAll();
        $response = ['modelData'=>$modelData,'depatmentData'=>$getDepartmentDatas];
        return  $response; 
    }
    public function destroyById($id)
    {
        $response = $this->interface->destroy($id);
        return $response;
    }
}