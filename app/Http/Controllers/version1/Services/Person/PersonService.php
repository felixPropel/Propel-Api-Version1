<?php

namespace App\Http\Controllers\version1\Services\Person;

use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Http\Controllers\version1\Services\Common\CommonService;

class PersonService
{
    public function __construct(PersonInterface $personInterface, CommonService $commonService)
    {
        $this->commonService = $commonService;
        $this->personInterface = $personInterface;
    }
    public function findMobileNumber($datas)
    {
        $datas = (object) $datas;
        $model = $this->personInterface->findUserDataByMobileNumber($datas->mobileNumber);
        if ($model) {
            $result = ['type' => 1, 'model' => $model,'mobileNumber'=>$datas->mobileNumber];
        } else {
            $result = ['type' => 0, 'model' => "",'mobileNumber'=>$datas->mobileNumber];
        }
        return $this->commonService->sendResponse($result, "");
    }
}
