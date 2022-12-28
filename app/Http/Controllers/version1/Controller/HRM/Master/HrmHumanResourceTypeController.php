<?php

namespace App\Http\Controllers\version1\Controller\HRM\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\version1\Services\HRM\Masters\HrmHumanResourceTypeService;
use Log;
class HrmHumanResourceTypeController extends Controller
{
    protected $service;
    public function __construct(HrmHumanResourceTypeService $service)
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
        
        $response = $this->service->index($orgId);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $orgId)
    {
        Log::info(' Human Resource Type Store function Inside.' . json_encode($request->all()));
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

        $response = $this->service->findById($orgId, $id);

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
        Log::info(' Human Resource Type update function Inside.' . json_encode($request->all()));
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
    public function destroy($orgId,$id)
    {
     
        $response = $this->service->destroyById($orgId,$id);
        return $response;
    }
}
