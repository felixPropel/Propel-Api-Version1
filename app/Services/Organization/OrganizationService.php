<?php

namespace App\Services\Organization;
use App\Interfaces\Organization\OrganizationInterface;
use App\Interfaces\CommonInterface;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationAddress;
use App\Models\Organization\OrganizationDetail;
use App\Models\Organization\OrganizationEmail;
use App\Models\Organization\OrganizationIdentity;
use App\Models\Organization\OrganizationMobile;
use App\Models\Organization\OrganizationActivityId;
use App\Models\Organization\OrganizationWebAddress;
use App\Models\Organization\organizationAdministrators;
use App\Models\Organization\OrganizationSubsetId;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

/**
 * Class OrganizationService
 * @package App\Services
 */
class OrganizationService
{
    public function __construct(OrganizationInterface $interface, CommonInterface $commonInterface)
    {
        $this->interface = $interface;
        $this->commonInterface = $commonInterface;
    }
    public function checkGstNumber($gstNo)
    {
        $checkGST = $this->interface->checkGstNo($gstNo);
        if ($checkGST) {
            dd("if");
        } else {
            $response = ['data' => $checkGST];
        }
        return $response;
    }
    public function save($datas) 
    {
        Log::info('OrganizationService > Store .' . json_encode($datas));      
        $datas = (object) $datas;
        $orgdatas = (object) $datas;
        // return $datas;
        // die();
        Log::info('OrganizationService > object.' . json_encode($orgdatas));
        Log::info('OrganizationService > Store After Convert Object tdy.' . json_encode($orgdatas));
        $setOrganizationModel = $this->convertToOrganizationModel($datas);
        $organizationModel = $this->interface->saveOrganizationModel($setOrganizationModel);
        if ($organizationModel) {
            $organizationId = $organizationModel->id;
      
            $setOrgDetailModel = $this->convertToOrganizationDetailModel($orgdatas, $organizationId);
          
            $orgDetailModel = $this->interface->saveOrganizationDetailModel($setOrgDetailModel);
        if(!empty($orgdatas->Activities)){
            foreach($orgdatas->Activities as $activity){
            Log::info('organizationservice' . json_encode($activity));
            $setOrganizationActivityModel=$this->covertToOrganizationActivityModel($activity, $organizationId);
            $organizationActivityModel=$this->interface->saveOrganizationActivityModel($setOrganizationActivityModel);
        }
    }
    if(!empty($orgdatas->Subset)){

            foreach($orgdatas->Subset as $sub){
            log::info('organizationservice  '  .json_encode($sub));
            $setOrganizationSubsetModel=$this->covertToOrganizationSubsetIdModel($sub, $organizationId);
            $organizationSubsetModel=$this->interface->saveOrganizationSubsetModel($setOrganizationSubsetModel);
        }
    }
            $setOrganizationMobileModel = $this->convertToOrganizationMobileModel($orgdatas, $organizationId);
            $orgMobileModel = $this->interface->saveOrganizationMobileModel($setOrganizationMobileModel);
            $setOrganizationEmailModel = $this->convertToOrganizationEmailModel($orgdatas, $organizationId);
            $orgEmailModel = $this->interface->saveOrganizationEmailModel($setOrganizationEmailModel);
            if (!empty($datas->webLinks)) {
                //MULTIPLE ADDRESS//
                //   foreach($orgdatas->webLinks as $links){
                     $setOrganizationWebAddressModel = $this->convertToOrganizationWebAddressModel($orgdatas, $organizationId);
                     $orgWebAddressModel = $this->interface->saveOrganizationWebAddressModel($setOrganizationWebAddressModel);
                //  }
            }
             $setOrganizationAddressModel = $this->convertToOrganizationAddressModel($orgdatas, $organizationId);
            //  $organizationAddressmodel =$this->interface->saveToOrganizationAddreessModel($setOrganizationAddressModel);
            $setOrganizationIdentityModel = $this->convertToOrganizationIdentityModel($orgdatas, $organizationId);
        
            // $orgAddressModel = $this->interface->saveOrganizationAddressModel($setOrganizationAddressModel);
            // Log::info('OrganizationService > Store After orgAddressModel. ' . json_encode($setOrganizationAddressModel));
            $orgIdentityModel = $this->interface->saveOrganizationIdentityModel($setOrganizationIdentityModel);
          
            $setAdministratorModel = $this->convertToOrganizationAdminstratorModel($orgdatas, $organizationId);
            $administratorModel = $this->interface->saveOrganizationAdministratorModel($setAdministratorModel);
            return $organizationId;
        }
    }
    public function convertToOrganizationModel($datas)
    {
        $model = new Organization();
        $model->authorization_status = "1";
        $model->db_name = $datas->organizationName;
        $model->status = "1";
        return $model;
    }
    public function convertToOrganizationDetailModel($datas, $organizationId)
    {
        $model = new OrganizationDetail();
        $model->org_id = $organizationId;
        // $model->title_id = (isset($datas->org_title_id) ? $datas->org_title_id : "");
        $model->org_name = $datas->organizationName;
        $model->alias = "";
        $model->year_of_yestablishment =NULL;
        $model->org_category_id = (isset($datas->organizationCategory) ? $datas->organizationCategory : 0);
        $model->org_ownership_id = (isset($datas->ownerShip) ? $datas->ownerShip : 0);
        $model->org_register_status = 1;
        $model->status = 1;
        return $model;
        Log::info('convertToOrganizationDetailModel array' . json_encode($model));
    }
    public function covertToOrganizationActivityModel($activity, $organizationId)
    {
        Log::info('covertToOrganizationActivityModel '. json_encode($activity));
         $model= new OrganizationActivityId();
         $model->org_id=$organizationId;
         $model->activity_id= $activity;
         return $model;    
    }
    public function covertToOrganizationSubsetIdModel($sub, $organizationId)
    {
           Log::info('covertToOrganizationSubsetIdModel sub  '.json_encode($sub));
          $model= new OrganizationSubsetId();
            $model->org_id=$organizationId;
             $model->subset_id=$sub;
           return  $model;
    }
    public function convertToOrganizationEmailModel($datas, $organizationId)
    {
        $model = new OrganizationEmail();
        $model->org_id = $organizationId;
        $model->email = $datas->primaryEmail;
        $model->verification_status_id = 0;
        $model->status = 1;
        return $model;
    }
    public function convertToOrganizationMobileModel($datas, $organizationId)
    {
        $model = new OrganizationMobile();
        $model->org_id = $organizationId;
        $model->country_id = '91';
        $model->mobile_no = $datas->primaryMobile;
        return $model;
    }
    public function convertToOrganizationWebAddressModel($datas, $organizationId)
    {
        Log::info('OrganizationService > Store web links.' . json_encode($datas));
        $model = new OrganizationWebAddress();
        $model->org_id = $organizationId;
        $model->web_address = $datas->webLinks;
        $model->status = '1';
        return $model;
    }
    public function convertToOrganizationAddressModel($datas, $organizationId)
    {
        log::info('organizationservice > full Orgdatas' . json_encode($datas));
        if(isset($datas->addressOf)){
        $address=count($datas->addressOf);
        Log::info('organizationService address array   ' . json_encode($address));
        if($address>0){ 
        for ($i = 0; $i < $address;  $i++) {    
            $model[$i] = new OrganizationAddress();
            $model[$i]->org_id = $organizationId;
            $model[$i]->address_type_id = $datas->addressOf[$i];
            $model[$i]->door_no = $datas->doorNo[$i];
            $model[$i]->building_name = $datas->buildingName[$i];
            $model[$i]->street = $datas->street[$i];
            $model[$i]->area = $datas->area[$i];
            $model[$i]->district_id = "1";
            $model[$i]->city = $datas->city[$i];
            $model[$i]->pincode = $datas->pinCode[$i];
            $model[$i]->landmark = $datas->landMark[$i];
            $model[$i]->location = " ";
            $model[$i]->status_id = '1';
            $model[$i]->save();
        // Log::info('OrganizationService > Store After doorNo.' . json_encode($doorNo[$i]));
        // Log::info('OrganizationService > Store After buildingName.' . json_encode($buildingName[$i]));
        // Log::info('OrganizationService > Store After street.' . json_encode($street[$i]));
        // Log::info('OrganizationService > Store After area.' . json_encode($area[$i]));
        // Log::info('OrganizationServicec > district. ' . json_encode($district[$i]));
        // Log::info('OrganizationService > Store After city. ' . json_encode($city[$i]));
        // Log::info('OrganizationService > Store After pinCode. ' . json_encode($pinCode[$i]));
        // Log::info('OrganizationService > Store After landMark. ' . json_encode($landMark[$i]));
        // Log::info('OrganizationService > Store After Model. ' . json_encode($model));
    }
}
        }
}
    public function convertToOrganizationIdentityModel($datas, $organizationId)
    {
        Log::info(' OrganizationIdentity datas    ' . json_encode($datas));
        $model = new OrganizationIdentity();
        $model->org_id = $organizationId;
        $model->doc_type_id = (isset($datas->idDocumentTypes) ? $datas->idDocumentTypes : 0);
        $model->doc_no = (isset($datas->documentNumber) ? $datas->documentNumber : 0);
        $model->doc_validity = (isset($datas->validTill) ? $datas->validTill : 0);
        $model->doc_attachment = (isset($datas->attachments) ? $datas->attachments : "");
        $model->status = '1';
        return $model;
        Log::info(' OrganizationIdentity datas' . json_encode($model));
    }

    public function convertToOrganizationAdminstratorModel($datas, $organizationId)
    {
        $model = new organizationAdministrators();
        $model->org_id = $organizationId;
        $model->u_id = "1";
        $model->administrator_type_id = (isset($datas->administratorsType) ? $datas->administratorsType : 0);
        $model->verification_status_id = "1";
        return $model;
        log::info('organizationService> Admin'   . json_encode($model));
    }
    public function organizationCommonData($datas)
    {
        $addressOfLists = $this->commonInterface->getAllAddressOfLists();
        $idDocumentTypes = $this->commonInterface->getAllIdDocumnetTypes();
        $organizationSector = $this->interface->getOrganizationSector();
        $organizationSubset = $this->interface->getOrganizationSubset();
        $organizationActivities = $this->interface->getOrganizationActivities();
        $organizationOwnerShip = $this->interface->getOrganizationOwnerShip();
        $organizationCategory = $this->interface->getOrganizationCategory();
        $response = ['addressOfLists' => $addressOfLists, 'idDocumentTypes' => $idDocumentTypes, 'organizationSector' => $organizationSector, 'organizationSubset' => $organizationSubset, 'organizationActivities' => $organizationActivities, 'organizationCategory' => $organizationCategory, 'organizationOwnerShip' => $organizationOwnerShip];
        return $response;
    }

    public function organizationDb($db_name)
    {
        //Setting Dynamic Connection//
        $path = config_path('database.php');
        //GET Database Connection file 
        $arr = include $path;
        // load the array from the file
        $new_connection = [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST'),
            'database'  => $db_name,
            'username'  => env('COMMON_USERNAME'),
            'password'  => env('COMMON_PASS'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',      
            'strict' => false               
        ];
        // log::info('organizationService> organizationDb host   '   . json_encode(env('DB_HOST')));
        // log::info('organizationService> organizationDb username   '   . json_encode(env('COMMON_USERNAME')));
        // log::info('organizationService> organizationDb password   '   . json_encode(env('COMMON_PASS')));
        // log::info('organizationService> organizationDb db name   '   . json_encode($db_name));a
        // log::info('organizationService> organizationDbNew   '   . json_encode($new_connection));
        // modify the array
        $arr['connections'][$db_name] = $new_connection;
        // write it back to the file
        file_put_contents($path, "<?php  return " . var_export($arr, true) . ";");
        //Setting Dynamic Env//
        $path = base_path('.env');
        $new_env = "
          DB_CONNECTION_$db_name=mysql
          DB_HOST_$db_name=127.0.0.1
          DB_PORT_$db_name=3306
          DB_DATABASE_$db_name=$db_name,
          DB_USERNAME_$db_name=" . env('COMMON_USERNAME') . "
          DB_PASSWORD_$db_name=" . env('COMMON_PASS') . "
          REPLACE_DB_HERE
          ";
        if (file_exists($path)) {
            file_put_contents($path, str_replace('REPLACE_DB_HERE',$new_env,file_get_contents($path)
            ));
        }
        //Creating Dynamic DB//
        $preDatabase = Config::get('database.connections.mysql.database');
        log::info('person service > preDatabase ' .json_encode($preDatabase));
        DB::statement("CREATE DATABASE IF NOT EXISTS $db_name");
        $new = Config::set('database.connections.mysql.database', $db_name);
        log::info('person service > new ' .json_encode( $new));
         DB::purge('mysql');
         DB::reconnect('mysql');
        $database_path = database_path();
        \Artisan::call('migrate  --path=/database/migrations/organization/db');
        return true;  
    }   
} 
