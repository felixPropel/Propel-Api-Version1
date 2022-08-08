<?php

namespace App\Http\Controllers\Api\Response;

use GuzzleHttp\Client;

class APIResponse
{
    //public $httpStatus;

    public $message;

    public $data;

    public function __construct($message=false, $data=false)
    {
        //$this->httpStatus   =   ($httpStatus == false ? ''   :  $httpStatus);
        $this->message = ($message == false ? ''   :  $message);
        $this->data = ($data == false ? ''   :  $data);
    }

}