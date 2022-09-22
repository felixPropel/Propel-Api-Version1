<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Services\Organization\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrganizationController extends Controller
{

    public function __construct(OrganizationService $service)
    {
        $this->service = $service;
    }  
    public function store(Request $request)
    {
        dd('weell');
        Log::info('OrganizationController > Store new data  function Inside.' . json_encode($request->all()));
        $response = $this->service->save($request->all());
        Log::info('OrganizationController>Store function Return.' . json_encode($response));
        return response($response, 200);
    }
}
