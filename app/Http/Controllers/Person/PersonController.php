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

    public function get_stage(Request $request){
       $response=$this->person->get_stage($request->all());
        return $response;
    }
}
