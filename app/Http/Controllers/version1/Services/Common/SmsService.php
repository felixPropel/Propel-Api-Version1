<?php

namespace App\Http\Controllers\version1\Services\Common;

use App\Http\Controllers\version1\Interfaces\Common\commonInterface;
use App\Http\Controllers\version1\Interfaces\Common\SmsInterface;
use App\Models\SmsManipulation;

class SmsService

{
    public function __construct(SmsInterface $smsInterface)
    {
        $this->smsInterface = $smsInterface;
    }
   

    public function storeSms($mobileNo, $smsType, $smsContent, $uid)
    {
        $model = $this->convertToModel($mobileNo, $smsType, $smsContent, $uid);
        $storeModel = $this->smsInterface->store($model);
        return $storeModel;
    }
    public function convertToModel($mobileNo, $smsType, $smsContent, $uid)
    {
        $model = new SmsManipulation();
        $model->mobile_no = $mobileNo;
        $model->sms_type_id = $smsType;
        $model->sms_content = $smsContent;
        $model->uid = $uid;
        return $model;
    }
}
