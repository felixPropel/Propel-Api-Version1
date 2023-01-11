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
        Log::info('PersonController > findMobileNumber function Inside.' . json_encode($request->all()));
        $response = $this->personService->findMobileNumber($request->all());
        Log::info('PersonController > findMobileNumber function Return.' . json_encode($response));
        return $response;
    }
    public function findEmail(Request $request)
    {
        Log::info('PersonController > findEmail function Inside.' . json_encode($request->all()));
        $response = $this->personService->findEmail($request->all());
        Log::info('PersonController > findEmail function Return.' . json_encode($response));
        return $response;
    }
    public function storeTempPerson(Request $request)
    {
        Log::info('PersonController > storeTempPerson function Inside.' . json_encode($request->all()));
        $response = $this->personService->storeTempPerson($request->all());
        Log::info('PersonController > storeTempPerson function Return.' . json_encode($response));
        return $response;
    }
    public function storePerson(Request $request)
    {
        Log::info('PersonController > storePerson function Inside.' . json_encode($request->all()));
        $response = $this->personService->storePerson($request->all());
        Log::info('PersonController > storePerson function Return.' . json_encode($response));
        return $response;
    }
    public function getSalutation(Request $request)
    {
        Log::info('PersonController > getSalutation function Inside.' );
        $response = $this->commonService->getSalutation();
        Log::info('PersonController > getSalutation function Return.' . json_encode($response));
        return $response;
    }
    public function getCommonData(Request $request)
    {
        Log::info('PersonController > getAllGender function Inside.' );
        $gender = $this->commonService->getAllGender();
        Log::info('PersonController > getAllGender function Return.' . json_encode($gender));

        Log::info('PersonController > getAllBloodGroup function Inside.');
        $bloodGroup = $this->commonService->getAllBloodGroup();
        Log::info('PersonController > getAllBloodGroup function Return.' . json_encode($bloodGroup));

        $response = ['gender' => $gender, 'bloodgroup' => $bloodGroup];
        return response($response);
    }
    public function resendOtpPersonConfirmation(Request $request)
    {
        Log::info('PersonController > resendOtpPersonConfirmation function Inside.' . json_encode($request->all()));
        $response = $this->personService->resendOtp($request->all());
        Log::info('PersonController > resendOtpPersonConfirmation function Return.' . json_encode($response));
        return $response;
    }
public function personOtpValidation(Request $request)
{
    Log::info('PersonController > personOtpValidation function Inside.' . json_encode($request->all()));
    $response = $this->personService->personOtpValidation($request->all());
    Log::info('PersonController > personOtpValidation function Return.' . json_encode($response));
    return $response;
}
public function checkPersonEmail(Request $request)
{
    Log::info('PersonController > checkPersonEmail function Inside.' . json_encode($request->all()));
    $response=$this->personService->checkPersonEmail($request->all());
    Log::info('PersonController > checkPersonEmail function Return.' . json_encode($response));
    return  $response;
}
public function personMobileOtp(Request $request)
{
    Log::info('PersonController > personMobileOtp function Inside.' . json_encode($request->all()));
    $response=$this->personService->personMobileOtp($request->all());
    Log::info('PersonController > personMobileOtp function Return.' . json_encode($response));
    return  $response; 
}
public function mobileOtpValidated(Request $request)
{
    Log::info('PersonController > mobileOtpValidated function Inside.' . json_encode($request->all()));
    $response=$this->personService->mobileOtpValidated($request->all());
    Log::info('PersonController > mobileOtpValidated function Return.' . json_encode($response));
    return  $response; 
}
public function generateEmailOtp(Request $request)
{
    Log::info('PersonController > mobileOtpValidated function Inside.' . json_encode($request->all()));
    $response=$this->personService->generateEmailOtp($request->all());
    Log::info('PersonController > mobileOtpValidated function Return.' . json_encode($response));
    return  $response; 
}

public function emailOtpValidation(Request $request)
{
    Log::info('PersonController > emailOtpValidation function Inside.' . json_encode($request->all()));
    $response = $this->personService->emailOtpValidation($request->all());
    Log::info('PersonController > emailOtpValidation function Return.' . json_encode($response));
    return  $response;
}
public function changePassword(Request $request)
{
    Log::info('PersonController > changePassword function Inside.' . json_encode($request->all()));
    $response = $this->userService->changePassword($request->all());
    Log::info('PersonController > changePassword function Return.' . json_encode($response));
    return  $response;
}
public function personDatas(Request $request)
{
    Log::info('PersonController > personDatas function Inside.' . json_encode($request->all()));
    $response = $this->personService->personDatas($request->all());
    Log::info('PersonController > personDatas function Return.' . json_encode($response));
    return  $response;
}
public function personUpdate(Request $request)
{
    Log::info('PersonController > personUpdate function Inside.' . json_encode($request->all()));
    $response = $this->personService->personUpdate($request->all());
    Log::info('PersonController > personUpdate function Return.' . json_encode($response));
    return  $response;
}
public function personToUser(Request $request)
{
    Log::info('PersonController > personToUser function Inside.' . json_encode($request->all()));
    $response = $this->personService->personToUser($request->all());
    Log::info('PersonController > personToUser function Return.' . json_encode($response));
    return  $response;
}
public function userCreation(Request $request)
{
    Log::info('PersonController > userCreation function Inside.' . json_encode($request->all()));
    $response=$this->userService->userCreation($request->all());
    Log::info('PersonController > userCreation function Return.' . json_encode($response));
    return  $response;
}
public function personProfiles(Request $request)
{
    Log::info('PersonController > personProfiles function Inside.' . json_encode($request->all()));
    $response=$this->personService->storePerson($request->all());
    Log::info('PersonController > personProfiles function Return.' . json_encode($response));
    return  $response;
}
public function profileUpdate(Request $request)
{
    Log::info('PersonController > profileUpdate function Inside.' . json_encode($request->all()));
    $response=$this->personService->profileUpdate($request->all());
    Log::info('PersonController > profileUpdate function Return.' .json_encode($response));
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
