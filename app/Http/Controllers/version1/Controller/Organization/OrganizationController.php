<?php
namespace App\Http\Controllers\version1\Controller\Organization;
use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\Organization\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\version1\Services\Common\commonService;
class OrganizationController extends Controller
{
    public function __construct(OrganizationService $service, CommonService $commonService)
    {
        $this->service = $service;
        $this->commonService = $commonService;
    }
    // public function store(Request $request)
    // {
    //     Log::info('OrganizationController > store function Inside.' . json_encode($request->all()));
    //     $response = $this->service->store($request->all());
    //     // $dbResponse = $this->service->organizationDb($request->organizationName);
    //     Log::info('OrganizationController > store function Return.' . json_encode($response));
    //     return $response;
    // }
    public function organizationMasterDatas()  
    {       
        $response = $this->service->organizationMasterDatas();
        Log::info('OrganizationController > organizationMasterDatas function Return.' . json_encode($response));
        return $response;
    }
    public function organizationIndex()  
    {
    
        $response = $this->service->organizationIndex();
        Log::info('OrganizationController > organizationIndex function Return.' . json_encode($response));
        return $response;
    }
    public function getCityByStateId(Request $request)
    {
        Log::info('OrganizationController > getCityByStateId function Inside.' . json_encode($request->all()));
        $response = $this->commonService->getCityByStateId($request->all());
        Log::info('OrganizationController > getCityByStateId function Return.' . json_encode($response));
        return $response;
    }
    public function getOrganizationAccountByUid(Request $request)
    {
        Log::info('OrganizationController > getOrganizationAccountByUid function Inside.' . json_encode($request->all()));
        $response = $this->service->getOrganizationAccountByUid($request->all());
        Log::info('OrganizationController > getOrganizationAccountByUid function Return.' . json_encode($response));
        return $response;
    }
    public function getDataBaseNameByid(Request $request)
    {
        Log::info('OrganizationController > getDataBaseNameByid function Inside.' . json_encode($request->all()));
        $response = $this->service->getDataBaseNameByid($request->all());
        Log::info('OrganizationController > getDataBaseNameBy id function Return.' . json_encode($response));
        return $response;
    }
    public function setDefaultOrganization(Request $request)
    {
        Log::info('OrganizationController > setDefaultOrganization function Inside.' . json_encode($request->all()));
        $response = $this->service->setDefaultOrganization($request->all());
        Log::info('OrganizationController > setDefaultOrganization id function Return.' . json_encode($response));
        return $response;
    }
    public function tempOrganizationStore(Request $request)
    {
     
        Log::info('OrganizationController > tempOrganizationStore function Inside.' . json_encode($request->all()));
        $response = $this->service->tempOrganizationStore($request->all());
        Log::info('OrganizationController > tempOrganizationStore  function Return.' . json_encode($response));
        return $response;
    }

}