<?php

namespace App\Http\Controllers\version1\Interfaces\User;

interface UserInterface
{
    public function findUserByMobileNo($mobileNo);
    public function findUserDataByEmail($data);
    public Function storeUser($model);
    public function findUserDataByUid($uId);
    public function savedUser($model);
    public function verifyUserForMobile($data);
}