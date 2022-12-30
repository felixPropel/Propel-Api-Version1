<?php

namespace App\Http\Controllers\version1\Controller\Common;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Http\Controllers\version1\Services\HRM\Masters\HrmDepartmentService;
use Illuminate\Http\Request;

use DB;
use Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    protected $service;
    public function __construct(CommonService $service)
    {
        $this->service = $service;
    }

   
}
