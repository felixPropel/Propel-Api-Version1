<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
class PersonController extends Controller
{
    protected $person;

    public function __construct(PersonService $person)
    {

        $this->person = $person;
        //$this->middleware('auth');
    }

    public function get_stage(Request $request)
    {
        $response = $this->person->get_stage($request->all());
        return $response;
    }

    public function get_gender_and_blood_group(Request $request)
    {
      
        $response = $this->person->get_gender_and_blood_group($request->all());
        return $response;
    }

    public function getAllPersonDataWithEmailAndMobile($email, $mobile)
    {
        $response = $this->person->getAllPersonDataWithEmailAndMobile($email, $mobile);
    }
    public function check_for_email(Request $request)
    {
        $response = $this->person->check_for_email($request->all());
        return $response;
    }

    function temp_update(Request $request)
    {
        $response = $this->person->temp_update($request->all());
        return $response;
    }

    public function update_person_details(Request $request)
    {
        $response = $this->person->update_person_details($request->all());
        return $response;
    }

    public function person_details_stage1(Request $request)
    {
        // Log::info('personController > person_details_stage1 .' . json_encode($datas));
        $response = $this->person->person_details_stage1($request->all());
        return $response;
    }

    public function person_details_stage2(Request $request)
    {
        $response = $this->person->person_details_stage2($request->all());
        return $response;
    }

    public function get_mobile(Request $request)
    {
 
        $response = $this->person->get_person_mobile($request->all());
        return $response;
    }

    public function create_user(Request $request)
    {
        $response = $this->person->create_user($request->all());
        return $response;
    }

    public function upload_pic(Request $request)
    {
        $response = $this->person->upload_pic($request->all());
        return $response;
    }

    public function person_details_by_uid(Request $request)
    {
        $response = $this->person->person_details_by_uid($request->all());
        return $response;
    }

    public function get_cities_by_state(Request $request)
    {
        $response = $this->person->get_cities_by_state($request->all());
        return $response;
    }

    public function complete_profile(Request $request)
    {
        $response = $this->person->complete_profile($request->all());
        return $response;
    }
    public function get_profile_details(Request $request)
    {
        $response = $this->person->getProfileDetails($request->all());
        return $response;
    }
    public function person_details_update(Request $request)
    {
        Log::info('PersonController  > now.' . json_encode($request->all()));
        $response = $this->person->profileDetailsUpdate($request->all());
        return response($response, 200);
        
    }
public function check_person(Request $request)
{
log::info('personcontroller > check_person mobile ' . json_encode($request->all()));    
$response=$this->person->check_person($request->all());
return $response;
}
    public function person_details_update_extra(Request $request)
    {
        Log::info('PersonController  > person_details_update_extra .' . json_encode($request->all()));
        $response = $this->person->PersonDetailsUpdateExtra($request->all());
        return $response;
    }
    public function store_mobile(Request $request)
    {
        $response = $this->person->storeMobile($request->all());
        return $response;
    }

    public function make_primary(Request $request)
    {
        $response = $this->person->makePrimary($request->all());
        return $response;
    }

    public function make_email_primary(Request $request)
    {
        $response = $this->person->makeEmailPrimary($request->all());
        return $response;
    }

    public function make_email_secondary(Request $request)
    {
        $response = $this->person->makeEmailSecondary($request->all());
        return $response;
    }

    public function make_email_primary_secondary(Request $request){
        $response = $this->person->makeEmailPrimarySecondary($request->all());
        return $response;
    }

    public function delete_other(Request $request)
    {
        $response = $this->person->deleteOther($request->all());
        return $response;
       
    }

    public function delete_other_email(Request $request)
    {
        $response = $this->person->deleteOtherEmail($request->all());
        return $response;
    }


    //Written Dhana Function Started

    //@developer Dhana
    public function findExactPersonWithEmailAndMobile(Request $request)
    {
        
        // Log::info('PersonController>findExactPersonWithEmailAndMobile Function>Inside. '.json_encode($request->all()));
        // $response = $this->person->findExactPersonWithEmailAndMobile($request->all());
        // Log::info('PersonController>findExactPersonWithEmailAndMobile Function>Return. '.json_encode($response));
        // return $response;
    }
    //Written Dhana Function Ended
}
