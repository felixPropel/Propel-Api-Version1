<?php

namespace App\Http\Controllers\Api\Hrm\HrmMasters\Controller;

use App\Http\Controllers\Api\Hrm\HrmMasters\Model\HrmDepartment;
use App\Http\Controllers\Api\Hrm\HrmMasters\Service\HrmDepartmentService;
use App\Http\Controllers\Api\Response\APIResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\Input as InputInput;

class HrmDepartmentController extends Controller
{

    /**
     * * To connect service **
     */
    public function __construct(HrmDepartmentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $response = $this->service->findAll();

        $apiResponse =   new APIResponse($response['message'], $response['data']);
        return response()->json($apiResponse);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->service->save($request->all());
        $apiResponse = new APIResponse($response['message'], $response['data']);
        return response()->json($apiResponse);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $response = $this->service->findById($id);
        $apiResponse =   new APIResponse($response['message'], $response['data']);

        return response()->json($apiResponse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, HrmDepartment $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy( $id)
    {
      
        $response = $this->service->destroyById($id);
        $apiResponse = new APIResponse($response['message'], $response['data']);      
        return response()->json($apiResponse);
    }
}
