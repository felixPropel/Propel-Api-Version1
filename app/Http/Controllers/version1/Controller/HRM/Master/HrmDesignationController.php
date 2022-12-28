<?php

namespace App\Http\Controllers\version1\Controller\HRM\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\version1\Services\HRM\Masters\HrmDesignationService;
use Log;

class HrmDesignationController extends Controller
{
    protected $service;
    public function __construct(HrmDesignationService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($orgId)
    {
       
        Log::info('HrmDesignationController>Index Function>Inside.'.json_encode($orgId));
        $response = $this->service->findAll($orgId);
        Log::info('HrmDesignationController>Index Function>Return' . json_encode($response));
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($orgId)
    {
       
        Log::info('HrmDesignationController>Create Function>Inside.'. json_encode($orgId));
        $response = $this->service->create($orgId);
        Log::info('HrmDesignationController>Create Function>Inside.');
        return $response;
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
        $response = $this->service->store($request->all(),$orgId);
        // Log::info('Store function Return.' . json_encode($response));
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
    
        Log::info('Edit function Inside.' . json_encode($orgId,$id));
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
    public function update(Request $request, $id)
    { 
        Log::info('HrmDesignationController>Create Function>Inside.',($request->all()));
        $response = $this->service->store($request->all(), $id);
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
        
        Log::info('Destroy function Inside id.' . json_encode($orgId,$id));
        $response = $this->service->destroyById($orgId, $id);
        Log::info('Destroy function Return .' . json_encode($response));
        return $response;
        
    }
}
