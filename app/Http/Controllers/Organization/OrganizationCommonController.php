<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Services\Organization\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrganizationCommonController extends Controller
{



    public function __construct(OrganizationService $service)
    {
        $this->service = $service;
    }
    public function checkGstNumber(Request $request)
    {
        Log::info('HrmDepartmentController>Index Function>Inside.');

        $response = $this->service->checkGstNumber($request->all());

        Log::info('HrmDepartmentController>Index Function>Return' . json_encode($response));
        return response($response, 200);
    }
    public function organizationCommonData(Request $request)
    {
    
        $response = $this->service->organizationCommonData($request->all());
        Log::info('organizationCommonData>datas' . json_encode($request->all()));
        return response($response, 200);


    }
}
