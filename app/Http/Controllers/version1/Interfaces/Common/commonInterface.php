<?php

namespace App\Http\Controllers\version1\Interfaces\Common;

interface commonInterface
{
    public function getSalutation();
    public function getAllGender();
    public function getAllBloodGroup();
    public function getAllState();
    public function getDistrict($stateId);
}