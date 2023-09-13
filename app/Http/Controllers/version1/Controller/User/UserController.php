<?php

namespace App\Http\Controllers\version1\Controller\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $UserService;
        public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        Log::info('UserController > storeUser function Inside.' . json_encode($request->all()));
        $response = $this->userService->storeUser($request->all());
        Log::info('UserController > storeUser function Return.' . json_encode($response));
        return $response;
    }
    public function login(Request $request)
    {
        Log::info('UserController > login function Inside.' . json_encode($request->all()));
        $response = $this->userService->loginUser($request->all());
        Log::info('UserController > login function Return.' . json_encode($response));
        return $response;
    }
    public function get_user_data(Request $request)
    {
        Log::info('UserController > get_user_data function Inside.' . json_encode($request->all()));
        $user = auth()->guard('api')->user();
        Log::info('UserController > get_user_data function Inside.' . json_encode($request->all()));
        return response($user, 200);
    }
    public function changePassword(Request $request)
    {        
        Log::info('UserController > changePassword function Inside.' . json_encode($request->all()));
        $response = $this->userService->changePassword($request->all());
        Log::info('UserController > changePassword function Return.' . json_encode($response));
        return $response;
    }
    public function setNewPassword(Request $request)
    {        
        Log::info('UserController > setNewPassword function Inside.' . json_encode($request->all()));
        $response = $this->userService->setNewPassword($request->all());
        Log::info('UserController > setNewPassword function Return.' . json_encode($response));
        return $response;
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
        //
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
