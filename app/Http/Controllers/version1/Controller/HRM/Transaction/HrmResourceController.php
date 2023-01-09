<?php

namespace App\Http\Controllers\version1\Controller\HRM\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\HRM\Transaction\HrmResourceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HrmResourceController extends Controller
{


    public function __construct(HrmResourceService $service)
    {
        $this->service = $service;
    }

    public function index($orgId)
    {
        Log::info('findResourceWithCredentials-> index Inside.' . json_encode($orgId));
        $response = $this->service->findAll($orgId);
        return $response;
        Log::info('HrmResourceController>Store Return.' . json_encode($response));
    }
    public function findResourceWithCredentials(Request $request, $orgId)
    {

        Log::info('findResourceWithCredentials-> Store Inside.' . json_encode($request->all()));
        $response = $this->service->findResourceWithCredentials($request->all(), $orgId);
        return $response;
        Log::info('HrmResourceController>Store Return.' . json_encode($response));
    }

    public function findDesignationByDepartmentId(Request $request, $orgId)
    {

        Log::info('HrmResourceController>findDesignationByDepartmentId Inside.' . json_encode($request->all()));
        $response = $this->service->findDesignationByDepartmentId($request->all(), $orgId);
        return $response;
        Log::info('HrmResourceController>findDesignationByDepartmentId Return.' . json_encode($response));
    }

    public function getResourceMasterData($orgId)
    {

        Log::info('findResourceWithCredentials-> getPersonMasterData Inside OrgId .' . json_encode($orgId));
        $response = $this->service->getResourceMasterData($orgId);
        return $response;
        Log::info('HrmResourceController>Store Return.' . json_encode($response));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
public function resourceMobileOtp(Request $request, $orgId)
{
    Log::info('HrmResourceController > resourceMobileOtp.' . json_encode($request->all()));
    $response = $this->service->resourceMobileOtp($request->all(),$orgId);
    return $response;
    Log::info('HrmResourceController> resourceMobileOtp .' . json_encode($response));

}
public function resourceOtpValidate(Request $request, $orgId)
{
    Log::info('HrmResourceController > resourceOtpValidate.' . json_encode($request->all()));
    $response = $this->service->resourceOtpValidate($request->all(),$orgId);
    return $response;
    Log::info('HrmResourceController> resourceOtpValidate .' . json_encode($response));

}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $orgId)
    {
        Log::info('HrmResourceController > resourcesStore.' . json_encode($request->all(), $orgId));

        $response = $this->service->save($request->all(), $orgId);
        // Log::info('HrmResourceController>Store Return.' . json_encode($response));
        return $response;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
