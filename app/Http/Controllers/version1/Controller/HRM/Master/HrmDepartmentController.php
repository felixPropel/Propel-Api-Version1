<?php

namespace App\Http\Controllers\version1\Controller\HRM\Master;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\HRM\Masters\HrmDepartmentService;
use Illuminate\Http\Request;

use DB;
use Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HrmDepartmentController extends Controller
{
    protected $service;
    public function __construct(HrmDepartmentService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getHrmDataByOrgId($orgId)
    {

        Log::info('HrmDepartmentController>Index Function>Inside.');
        $response = $this->service->findAll($orgId);
        Log::info('HrmDepartmentController>Index Function>Return' . json_encode($response));
        return $response;
    }

    public function index($orgId)
    {
       
        Log::info('HrmDepartmentController>Index Function>Inside.' .json_encode($orgId));
        $response = $this->service->findAll($orgId);
        Log::info('HrmDepartmentController>Index Function>Return' . json_encode($response));
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($orgId)
    {

        Log::info('HrmDepartmentController>Create Function>Inside.');
        $response = $this->service->create($orgId);
        Log::info('HrmDepartmentController>Create Function>Return' . json_encode($response));
        return response($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $orgId)
    {

        Log::info('Store function Inside.' . json_encode($request->all()));
        $response = $this->service->store($request->all(), $orgId);
        Log::info('Store function Return.' . json_encode($response));
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
        $response = $this->service->findById($id);
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($orgId, $id)
    {
        Log::info('Edit function Inside.' . json_encode($id));
        $response = $this->service->findById($orgId, $id);
        Log::info('Edit function Return.' . json_encode($response));
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orgId, $id)
    {
        Log::info('Update function Inside request Data.' . json_encode($request->all()));
        Log::info('Update function Inside request id.' . json_encode($id));
        $response = $this->service->store($request->all(), $id);
        Log::info('Update function Inside response.' . json_encode($response));
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($orgId, $id)
    {

        Log::info('Destroy function Inside id.' . json_encode($id));
        $response = $this->service->destroyById($orgId, $id);
        Log::info('Destroy function Return .' . json_encode($response));
        return $response;
    }
}
