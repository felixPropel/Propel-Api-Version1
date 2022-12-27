<?php

namespace App\Http\Controllers\version1\Repositories\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Models\Organization\UserOrganizationRelational;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\TempPerson;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrganizationRepository implements OrganizationInterface
{
    public function getOrganizationAccountByUid($uid)
    {
        return UserOrganizationRelational::select('organization_details.org_name')
            ->leftjoin('organizations', 'organizations.id', '=', 'user_organization_relationals.organization_id')
            ->leftjoin('organization_details', 'organization_details.org_id', '=', 'organizations.id')
            ->where('uid', $uid)
            ->get();
    }
    public function saveOrganization($orgModel, $orgDetailModel, $orgEmailModel, $userAccountModel, $orgDBModel)
    {
        try {
            $result = DB::transaction(function () use ($orgModel, $orgDetailModel, $orgEmailModel, $userAccountModel, $orgDBModel) {
                
                $orgModel->save();

                $orgDetailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $orgEmailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $userAccountModel->ParentOrganization()->associate($orgModel, 'organization_id', 'id');
                $orgDBModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');

                $orgDetailModel->save();
                $orgEmailModel->save();
                $userAccountModel->save();
                $orgDBModel->save();


                $preDatabase = Config::get('database.connections.mysql.database');
                DB::statement("CREATE DATABASE IF NOT EXISTS $orgDBModel->db_name");

                $new = Config::set('database.connections.mysql.database', $orgDBModel->db_name);
                DB::purge('mysql');
                DB::reconnect('mysql');
                \Artisan::call('migrate');

                Config::set('database.connections.mysql.database', $preDatabase);


                return [
                    'message' => "Success",
                    'data' => $orgModel
                ];
            });
            return $result;
        } catch (\Exception $e) {
            return [
                'message' => "failed",
                'data' => $e
            ];
        }
    }
}