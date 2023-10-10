<?php

namespace App\Http\Controllers\version1\Services\POC;

use App\Http\Controllers\version1\Interfaces\POC\CategoryInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Models\POC\Category;


class CategoryService
{
    public function __construct(CategoryInterface $CategoryInterface, CommonService $commonService)
    {
        $this->CategoryInterface = $CategoryInterface;
        $this->commonService =$commonService;

    }
    public function category($datas)
    {
         $datas =(object)$datas;
        $model= new Category();
        $model->category = $datas->category;
        $model->active_status=1;
        $model = $this->CategoryInterface->category($model);
        return $this->commonService->sendResponse($model, "");  
       


    }
}
