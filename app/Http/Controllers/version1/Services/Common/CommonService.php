<?php

namespace App\Http\Controllers\version1\Services\Common;

use App\Http\Controllers\version1\Interfaces\Common\commonInterface;

class CommonService

{
    public function __construct(commonInterface $commonInterface)
    {
        $this->commonInterface = $commonInterface;
    }

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    public function getSalutation(){
   
      $result=$this->commonInterface->getSalutation();
      return $this->sendResponse($result, "");
    }
    public function getAllGender(){
   
        $result=$this->commonInterface->getAllGender();
        return $result;
      }
      public function getAllBloodGroup(){
        $result=$this->commonInterface->getAllBloodGroup();
        return $result;
      }
}
