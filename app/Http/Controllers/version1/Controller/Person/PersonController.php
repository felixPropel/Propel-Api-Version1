<?php

namespace App\Http\Controllers\version1\Controller\Person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\Person\PersonService;
use App\Http\Controllers\version1\Services\Common\commonService;
use App\Http\Controllers\version1\Services\User\UserService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller
{
    public function __construct(PersonService $service, CommonService $commonService,UserService $UserService)
    {
        $this->personService = $service;
        $this->commonService = $commonService;
        $this->userService = $UserService;
    }

    public function findMobileNumber(Request $request)
    {

        $response = $this->personService->findMobileNumber($request->all());

        return $response;
    }
    public function findEmail(Request $request)
    {
        $response = $this->personService->findEmail($request->all());
        return $response;
    }
    public function storeTempPerson(Request $request)
    {
        $response = $this->personService->storeTempPerson($request->all());
        return $response;
    }
    public function storePerson(Request $request)
    {

        $response = $this->personService->storePerson($request->all());
        return $response;
    }
    public function getSalutation(Request $request)
    {

        $response = $this->commonService->getSalutation();
        return $response;
    }
    public function getCommonData(Request $request)
    {
        //TEST
        $gender = $this->commonService->getAllGender();
        $bloodGroup = $this->commonService->getAllBloodGroup();
        $response = ['gender' => $gender, 'bloodgroup' => $bloodGroup];
        return response($response);
    }
    public function resendOtpPersonConfirmation(Request $request)
    {
        $response = $this->personService->resendOtp($request->all());
        return $response;
    }
public function personOtpValidation(Request $request)
{
    $response = $this->personService->personOtpValidation($request->all());
        return $response;
}
public function checkPersonEmail(Request $request)
{
    // log::info('controller > ' .json_encode($request->all()));
    $response=$this->personService->checkPersonEmail($request->all());
    return  $response;
}
public function personMobileOtp(Request $request)
{
    $response=$this->personService->personMobileOtp($request->all());
    return  $response; 
}
public function mobileOtpValidated(Request $request)
{
    log::info('Request > ' .json_encode($request->all()));
    $response=$this->personService->mobileOtpValidated($request->all());
    return  $response; 
}
public function emailOtpValidation(Request $request)
{
    $response = $this->personService->emailOtpValidation($request->all());
    return  $response;
}
public function changePassword(Request $request)
{

    $response = $this->userService->changePassword($request->all());

    return  $response;
}
public function personDatas(Request $request)
{
    $response = $this->personService->personDatas($request->all());

    return  $response;
}
public function personUpdate(Request $request)
{
    $response = $this->personService->personUpdate($request->all());
    return  $response;
}
public function personToUser(Request $request)
{
    $response = $this->personService->personToUser($request->all());
    return  $response;
}
public function userCreation(Request $request)
{
    $response=$this->userService->userCreation($request->all());
    return  $response;
}
public function personProfiles(Request $request)
{
    $response=$this->personService->personProfileDetails($request->all());
    return  $response;
}
public function profileUpdate(Request $request)
{
    log::info('controller > ' .json_encode($request->all()));
    $response=$this->personService->profileUpdate($request->all());
    return  $response;
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
