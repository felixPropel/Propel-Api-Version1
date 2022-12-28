<?php
namespace App\Http\Controllers\version1\Repositories\Hrm\Master;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface;
use App\Models\HrmResourceType;
use Illuminate\Support\Facades\DB;


//use Your Model

/**
 * Class HrmDepartmentRepository.
 */
class HrmHumanResourceTypeRepository implements HrmHumanResourceTypeInterface
{
    protected $model;
    public function __construct(HrmResourceType $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        return HrmResourceType::whereNull('deleted_at')->get();
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