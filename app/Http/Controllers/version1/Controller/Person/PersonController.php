<?php

namespace App\Http\Controllers\version1\Controller\Person;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\Person\PersonService;
use App\Http\Controllers\version1\Services\Common\commonService;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct(PersonService $service, CommonService $commonService)
    {
        $this->personService = $service;
        $this->commonService = $commonService;
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
    public function emailOtpValidation(Request $request)
    {

        $response = $this->personService->emailOtpValidation($request->all());
        return $response;
    }
    public function updatePassword(Request $request)
    {

        $response = $this->personService->updatePassword($request->all());
        return $response;
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