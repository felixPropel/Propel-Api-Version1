<?php

namespace App\Http\Controllers\HRM\Transaction;
use App\Http\Controllers\Controller;
use App\Services\HRM\Transaction\HrmResourceService;
use Illuminate\Http\Request;
use Log;

class HrmResourceController extends Controller
{


    public function __construct(HrmResourceService $service)
    {
        $this->service = $service;
    }


    public function findResourceWithCredentials(Request $request)
    {
    
    Log::info('findResourceWithCredentials-> Store Inside.' . json_encode($request->all()));
        $response = $this->service->findResourceWithCredentials($request->all());
        return $response;
        Log::info('HrmResourceController>Store Return.' . json_encode($response));
    }

    public function findDesignationByDepartmentId(Request $request)
    {
        Log::info('HrmResourceController>findDesignationByDepartmentId Inside.' . json_encode($request->all()));
        $response = $this->service->findDesignationByDepartmentId($request->all());
        return response($response, 200);
        Log::info('HrmResourceController>findDesignationByDepartmentId Return.' . json_encode($response));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("well f");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('HrmResourceController>Store in wizard forms Inside.' . json_encode($request->all()));
        $response = $this->service->save($request->all());
        // Log::info('HrmResourceController>Store Return.' . json_encode($response));
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
