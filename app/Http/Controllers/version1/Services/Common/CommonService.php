<?php

namespace App\Http\Controllers\version1\Services\Common;

use App\Http\Controllers\version1\Interfaces\Common\commonInterface;
use Illuminate\Support\Facades\Log;

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
      'data' => $result,
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
  public function getSalutation()
  {
    Log::info('CommonService > getSalutation function Inside.');
    $result = $this->commonInterface->getSalutation();
    Log::info('CommonService > getSalutation function Return.' . json_encode($result));
    return $result;
  }
  public function getAllGender()
  {
    Log::info('CommonService > getAllGender function Inside.' );
    $result = $this->commonInterface->getAllGender();
    Log::info('CommonService > getAllGender function Return.' . json_encode($result));
    return $result;
  }
  public function getAllBloodGroup()
  {
    Log::info('CommonService > getAllBloodGroup function Inside.');
    $result = $this->commonInterface->getAllBloodGroup();
    Log::info('CommonService > getAllBloodGroup function Return.' . json_encode($result));
    return $result;
  }
  public function getDistrict($data)
  {
    Log::info('CommonService > getDistrict function Inside.' . json_encode($data->all()));
    $result = $this->commonInterface->getDistrict($data['stateId']);
    Log::info('CommonService > getDistrict function Return.' . json_encode($result));
    return $result;
  }

  public function getAllStates()
  {
    Log::info('CommonService > getAllStates function Inside.' );
    $result = $this->commonInterface->getAllStates();
    Log::info('CommonService > getAllStates function Return.' . json_encode($result));
    return $result;
  }
  public function getAddrerssType()
  {
    Log::info('CommonService > getAddrerssType function Inside.' );
    $result = $this->commonInterface->getAddrerssType();
    Log::info('CommonService > getAddrerssType function Return.' . json_encode($result));
    return $result;
  }
  public function getMaritalStatus()
  {
    Log::info('CommonService > getMaritalStatus function Inside.');
    $result = $this->commonInterface->getMaritalStatus();
    Log::info('CommonService > getMaritalStatus function Return.' . json_encode($result));
    return $result;
  }
  public function getLanguage()
  {
    Log::info('CommonService > getLanguage function Inside.' );
    $result = $this->commonInterface->getLanguage();
    Log::info('CommonService > getLanguage function Return.' . json_encode($result));
    return $result;
  }
}