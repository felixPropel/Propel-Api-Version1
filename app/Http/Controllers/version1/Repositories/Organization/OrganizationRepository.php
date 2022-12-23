<?php

namespace App\Http\Controllers\version1\Repositories\Organization;

use App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface;
use App\Http\Controllers\version1\Interfaces\Person\PersonInterface;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonDetails;
use App\Models\PersonEmail;
use App\Models\PersonMobile;
use App\Models\TempPerson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrganizationRepository implements OrganizationInterface
{

    public function saveOrganization($orgModel, $orgDetailModel,$orgEmailModel)
    {


        try {
            $result = DB::transaction(function () use ($orgModel, $orgDetailModel,$orgEmailModel) {



                $orgModel->save();
                $orgDetailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $orgEmailModel->ParentOrganization()->associate($orgModel, 'org_id', 'id');
                $orgDetailModel->save();
                $orgEmailModel->save();

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
