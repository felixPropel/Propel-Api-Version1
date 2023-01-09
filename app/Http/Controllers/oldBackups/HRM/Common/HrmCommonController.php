<?php

namespace App\Http\Controllers\HRM\Common;

use App\Http\Controllers\Controller;
use App\Services\HRM\Common\HrmCommonService;
use Illuminate\Http\Request;

class HrmCommonController extends Controller
{

    public function __construct(HrmCommonService $service){
        $this->service = $service;
    }
    public function getPersonDataByEmailAndMobile(Request $request)
    {
        $response = $this->service->getPersonDataByEmailAndMobile($request->all());
        dd($response);
        
    }
}
