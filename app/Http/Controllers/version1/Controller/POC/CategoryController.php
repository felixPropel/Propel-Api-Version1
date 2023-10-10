<?php

namespace App\Http\Controllers\version1\controller\POC;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\POC\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    protected $CategoryService;
    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
     
    }
    public function category(Request $request)
    {
      $response = $this->CategoryService->category($request->all());
      return $response;
    }
}
