<?php

namespace App\Http\Controllers\HRM\Master;

use App\Http\Controllers\Controller;
use App\Services\HRM\Masters\HrmDepartmentService;
use Illuminate\Http\Request;
use Log;
use DB;
use Config;
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
    public function index()
    {
        Log::info('HrmDepartmentController>Index Function>Inside.');
        $response = $this->service->findAll();
        Log::info('HrmDepartmentController>Index Function>Return' . json_encode($response));
        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('HrmDepartmentController>Create Function>Inside.');
        $response = $this->service->create();
        Log::info('HrmDepartmentController>Create Function>Return' . json_encode($response));
        return response($response, 200);
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
        Log::info('Store function Return.' . json_encode($response));
        return response($response, 200);
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
        Log::info('Edit function Inside.' . json_encode($id));
        $response = $this->service->findById($id);
        Log::info('Edit function Return.' . json_encode($response));
        return response($response, 200);
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
    public function destroy($id)
    {
        Log::info('Destroy function Inside id.' . json_encode($id));
        $response = $this->service->destroyById($id);
        Log::info('Destroy function Return .' . json_encode($response));
        return $response;
    }
}
