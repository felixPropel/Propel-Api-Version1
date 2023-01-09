<?php

namespace App\Http\Controllers\HRM\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HRM\Masters\HrmDesignationService;
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
    public function index()
    {
        $response = $this->service->findAll();
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('HrmDesignationController>Create Function>Inside.');
        $response = $this->service->create();
        Log::info('HrmDesignationController>Create Function>Inside.');
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Store function Inside.' . json_encode($request->all()));
        $response = $this->service->store($request->all());
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
    public function edit($id)
    {
        $response = $this->service->findById($id);
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
    public function destroy($id)
    {
        
        $response = $this->service->destroyById($id);
        return $response;
    }
}
