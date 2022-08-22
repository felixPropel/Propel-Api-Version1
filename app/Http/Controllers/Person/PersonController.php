<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Services\UserService;

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

    public function check_for_email(Request $request)
    {
        $response = $this->person->check_for_email($request->all());
        return $response;
    }

    public function update_person_details(Request $request)
    {
        $response = $this->person->update_person_details($request->all());
        return $response;
    }

    public function person_details_stage1(Request $request)
    {
        $response = $this->person->person_details_stage1($request->all());
        return $response;
    }

    public function person_details_stage2(Request $request)
    {
        $response = $this->person->person_details_stage2($request->all());
        return $response;
    }

    public function create_user(Request $request)
    {
        $response = $this->person->create_user($request->all());
        return $response;
    }

    public function upload_pic(Request $request){
        $response = $this->person->upload_pic($request->all());
        return $response;
    }

    public function person_details_by_uid(Request $request){
        $response = $this->person->person_details_by_uid($request->all());
        return $response;
    }

    public function complete_profile(Request $request){
        $response = $this->person->complete_profile($request->all());
        return $response;
    }

}
