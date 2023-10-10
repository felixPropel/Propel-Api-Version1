<?php

namespace App\Http\Controllers\version1\Repositories\POC;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\version1\Interfaces\POC\CategoryInterface;


class CategoryRepository implements CategoryInterface
{
    public function category($model)
    {
        try {
            $result = DB::transaction(function () use ($model) {

                $model->save();
                return [
                    'message' => "Success",
                    'data' => $model,
                ];
            });

            return $result;
        } catch (\Exception $e) {

            return [

                'message' => "failed",
                'data' => $e,
            ];
        }
    }
}