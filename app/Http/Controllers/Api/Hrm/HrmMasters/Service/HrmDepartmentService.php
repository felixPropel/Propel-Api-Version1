<?php

namespace App\Http\Controllers\Api\Hrm\HrmMasters\Service;

use App\Http\Controllers\Api\Hrm\HrmMasters\Model\HrmDepartment;
use App\Http\Controllers\Api\Hrm\HrmMasters\Repository\HrmDepartmentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HrmDepartmentService
{


    /**
     * * To connect Repo **
     */
    public function __construct(HrmDepartmentRepository $repo)
    {
        $this->repo = $repo;
    }
    public function findAll()
    {
        $models = $this->repo->findAll();

        return [
            'message' => pStatusSuccess(),
            'data' => $models
        ];
    }
    public function findById($id)
    {

        $model = $this->repo->findById($id);

        return [
            'message' => pStatusSuccess(),
            'data' => $model
        ];
    }
    public function save($inputs)
    {
        $inputs = (object)$inputs;
        $id = ($inputs->id)?$inputs->id:null;
     
     
        $model = $this->convertToModel($inputs,$id);
       
        $response = $this->repo->save($model, $id);
      
        $model = $response['data'];
      
        $response = $this->findById($model->id);
        return $response;
        }
    public function convertToModel($inputs, $id = false)
    {

        if ($id == null) {
            $model = new HrmDepartment();
        } else {
            $model = $this->repo->findById($id);
        }
        $model->name = $inputs->name;
        $model->parent_dept_id = ($inputs->parent_dept_id) ? $inputs->parent_dept_id :null;
        $model->description = $inputs->description;
        $model->status = 1;
       
        return $model;
    }
    public function destroyById($id)
    {
        
        $model = $this->repo->findById($id);        
        $response = $this->repo->destroyById($model);
        return $response;
    }
}
