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
        Log::info('OrganizationController > store function Inside.' . json_encode($request->all()));
        $response = $this->service->store($request->all());
        // $dbResponse = $this->service->organizationDb($request->organizationName);
        Log::info('OrganizationController > store function Return.' . json_encode($response));
        return $response;
    }
    public function getAllStates()
    {
        Log::info('OrganizationController > getAllStates function Inside.');
        $response = $this->commonService->getAllStates();
        Log::info('OrganizationController > getAllStates function Return.' . json_encode($response));
        return $response;
    }
    public function getDistrict(Request $request)
    {
        Log::info('OrganizationController > getDistrict function Inside.' . json_encode($request->all()));
        $response = $this->commonService->getDistrict($request->all());
        Log::info('OrganizationController > getDistrict function Return.' . json_encode($response));
        return $response;
    }
    public function getOrganizationAccountByUid(Request $request)
    {
        Log::info('OrganizationController > getOrganizationAccountByUid function Inside.' . json_encode($request->all()));
        $response = $this->service->getOrganizationAccountByUid($request->all());
        Log::info('OrganizationController > getOrganizationAccountByUid function Return.' . json_encode($response));
        return $response;
    }
}