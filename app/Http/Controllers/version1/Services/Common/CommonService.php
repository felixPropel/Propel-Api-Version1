<?php

namespace App\Http\Controllers\version1\Services\Common;

use App\Http\Controllers\version1\Interfaces\Common\commonInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDesignationInterface;
use App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface;
use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class CommonService
{
  public function __construct(commonInterface $commonInterface, OrganizationInterface $organizationInterface, HrmDepartmentInterface $hrmDeptInterface, HrmDesignationInterface $hrmDesInterface, HrmHumanResourceTypeInterface $hrmResourceTypeInterface)
  {
    $this->commonInterface = $commonInterface;
    $this->organizationInterface = $organizationInterface;
    $this->hrmDeptInterface = $hrmDeptInterface;
    $this->hrmDesInterface = $hrmDesInterface;
    $this->hrmResourceTypeInterface = $hrmResourceTypeInterface;
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
    Log::info('CommonService > getAllGender function Inside.');
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
  public function getCityByStateId($data)
  {
    Log::info('CommonService > getCityByStateId function Inside.' . json_encode($data));
    $result = $this->commonInterface->getCityByStateId($data['stateId']);
    Log::info('CommonService > getCityByStateId function Return.' . json_encode($result));
    return $result;
  }

  public function getAllStates()
  {
    Log::info('CommonService > getAllStates function Inside.');
    $result = $this->commonInterface->getAllStates();
    Log::info('CommonService > getAllStates function Return.' . json_encode($result));
    return $result;
  }
  public function getAddrerssType()
  {
    Log::info('CommonService > getAddrerssType function Inside.');
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
    Log::info('CommonService > getLanguage function Inside.');
    $result = $this->commonInterface->getLanguage();
    Log::info('CommonService > getLanguage function Return.' . json_encode($result));
    return $result;
  }

  public function getAllDocumentType()
  {
    Log::info('CommonService > getAllDocumentType function Inside.');
    $result = $this->commonInterface->getAllDocumentType();
    Log::info('CommonService > getAllDocumentType function Return.' . json_encode($result));
    return $result;
  }
  public function getAllBankAccountType()
  {
    Log::info('CommonService > getAllBankAccountType function Inside.');
    $result = $this->commonInterface->getAllBankAccountType();
    Log::info('CommonService > getAllBankAccountType function Return.' . json_encode($result));
    return $result;
  }


  public function getPersonMasterData()
  {

    $saluationLists = $this->getSalutation();
    $bloodGroupLists = $this->getAllBloodGroup();
    $genderLists = $this->getAllGender();
    $maritalStatusLists = $this->getMaritalStatus();
    $addressOfLists = $this->getAddrerssType();
    $languageLists = $this->getLanguage();
    $idDocumentTypes = $this->getAllDocumentType();
    $bankAccountTypes = $this->getAllBankAccountType();
    $datas = [
      'saluationLists' => $saluationLists,
      'bloodGroupLists' => $bloodGroupLists,
      'genderLists' => $genderLists,
      'maritalStatusLists' => $maritalStatusLists,
      'addressOfLists' => $addressOfLists,
      'languageLists' => $languageLists,
      'idDocumentTypes' => $idDocumentTypes,
      'bankAccountTypes' => $bankAccountTypes
    ];


    return $datas;
  }

  public function getOrganizationDatabaseByOrgId($orgId)
  {
    $result = $this->organizationInterface->getDataBaseNameByOrgId($orgId);
   Session::put('currentDatabase', $result->db_name);
   Config::set('database.connections.mysql_external.database', $result->db_name);
   DB::purge('mysql');
   DB::reconnect('mysql');
    Log::info('CommonService > getOrganizationDatabaseByOrgId function Return.' . json_encode($result));
    return $result;
  }
}
