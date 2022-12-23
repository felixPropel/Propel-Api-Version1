<?php

namespace App\Http\Controllers\version1\Controller\Organization;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\Organization\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\version1\Services\Common\commonService;

class OrganizationController extends Controller
{
    public function __construct(OrganizationService $service, CommonService $commonService)
    {
        $this->service = $service;
        $this->commonService = $commonService;
    }
    public function store(Request $request)
    {

        Log::info('OrganizationController > Store new data  function Inside.' . json_encode($request->all()));
        $response = $this->service->store($request->all());
        // $dbResponse = $this->service->organizationDb($request->organizationName);
        //Log::info('OrganizationController>Store function Return.' . json_encode($response));
        return $response;
    }
    public function getAllState()
    {
        $response = $this->commonService->getAllState();
        return $response;
    }
    public function getDistrict(Request $request)
    {
        $response = $this->commonService->getDistrict($request->all());
        return $response;
    }
}
