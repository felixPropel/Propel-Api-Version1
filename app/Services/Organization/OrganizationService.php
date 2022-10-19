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
       Log::info('OrganizationService > Store new data  function Inside.' . json_encode($datas));
         $datas = (object) $datas;
         $orgdatas = (object) $datas;
    
         Log::info('OrganizationService > Store After organizationName only data.' . json_encode($orgdatas));
         Log::info('OrganizationService > Store After Convert Object.' . json_encode($orgdatas));
        $setOrganizationModel = $this->convertToOrganizationModel($orgdatas);
        $organizationModel = $this->interface->saveOrganizationModel($setOrganizationModel);
        if ($organizationModel) 
        {
            $organizationId = $organizationModel->id;
            
            $setOrgDetailModel = $this->convertToOrganizationDetailModel($orgdatas, $organizationId);
            $orgDetailModel = $this->interface->saveOrganizationDetailModel($setOrgDetailModel);
            // $setOrganizationActivityIdModel=$this->covertToOrganizationActivityIdModel($orgdatas, $organizationId);
            // $setOrganizationSubsetIdModel=$this->covertToOrganizationSubsetIdModel($orgdatas, $organizationId);
            $setOrganizationMobileModel = $this->convertToOrganizationMobileModel($orgdatas, $organizationId);
            $orgMobileModel = $this->interface->saveOrganizationMobileModel($setOrganizationMobileModel);
            $setOrganizationEmailModel = $this->convertToOrganizationEmailModel($orgdatas, $organizationId);
            $orgEmailModel = $this->interface->saveOrganizationEmailModel($setOrganizationEmailModel);
            if($orgdatas->webLinks){
             $setOrganizationWebAddressModel = $this->convertToOrganizationWebAddressModel($orgdatas, $organizationId);
             $orgWebAddressModel = $this->interface->saveOrganizationWebAddressModel($setOrganizationWebAddressModel);
             }

            // $setOrganizationAddressModel = $this->convertToOrganizationAddressModel($orgdatas, $organizationId);
            $setOrganizationIdentityModel = $this->convertToOrganizationIdentityModel($orgdatas, $organizationId);
            // $orgAddressModel = $this->interface->saveOrganizationAddressModel($setOrganizationAddressModel);
            // Log::info('OrganizationService > Store After orgAddressModel. ' . json_encode($setOrganizationAddressModel));
             return true;
            $orgIdentityModel = $this->interface->saveOrganizationIdentityModel($setOrganizationIdentityModel);
            $setAdministratorModel=$this->convertToOrganizationAdminstratorModel($orgdatas,$organizationId);
            $administratorModel=$this->interface->saveOrganizationAdministratorModel($setAdministratorModel);   
                                      
         }
    }
    public function convertToOrganizationModel($datas)
    {
        
        $model = new Organization();
        $model->authorization_status ="1";
        $model->db_name=$datas->organizationName;
        $model->status = "1";
        return $model;
    }
    public function convertToOrganizationDetailModel($datas, $organizationId)
    {

        $model = new OrganizationDetail();
        $model->org_id=$organizationId;
        $model->title_id = isset($datas->org_title_id) ? $datas->org_title_id : "";
        $model->org_name =$datas->organizationName;
        $model->alias = "";
        // $model->started_date =""; 
        $model->year_of_yestablishment = null;
        $model->org_category_id = $datas->organizationCategory;
        $model->org_ownership_id = $datas->ownerShip;
        $model->org_register_status = 1;
        $model->status = 1;
        return $model;
        Log::info('convertToOrganizationDetailModel array'. json_encode($model));
    }
    public function covertToOrganizationActivityIdModel($datas, $organizationId)
{
//    $activity= count($datas->activities);
//    Log::info('covertToOrganizationActivityIdModel array'. json_encode($activity));
//    for ( $i=0; $i < $activity; $i++){

//    $model[$i]= new OrganizationActivityId();
//    $model[$i]->org_id=$organizationId;
//    $model[$i]->activity_id= $datas->activities[$i];
//    $model[$i]->save();
//    }
}
public function covertToOrganizationSubsetIdModel($datas, $organizationId){
//     $subset=count($datas->subset);
//     Log::info('covertToOrganizationSubsetIdModel array  '.json_encode($subset));
// for ($i=0; $i<$subset ; $i++){
//     $model[$i]= new OrganizationSubsetId();
//     $model[$i]->org_id=$organizationId;
//     $model[$i]->subset_id=$datas->subset[$i];
//     $model[$i]->save();
}
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
        Log::info('OrganizationService > Store web links.' . json_encode($datas->webLinks));
        $model = new OrganizationWebAddress();
        $model->org_id = $organizationId;
        $model->web_address = $datas->webLinks;
        $model->status = '1';
        return $model;
    }
    public function convertToOrganizationAddressModel($datas, $organizationId)
    {
        //  $address=count($datas->address_of);
  Log::info( 'organizationService address array   ' .json_encode($address));

        //  for ($i = 0; $i < $address;  $i++) {    
        //     $model[$i] = new OrganizationAddress();
        //     $model[$i]->org_id = $organizationId;
        //     $model[$i]->address_type_id = $datas->address_of[$i];
        //     $model[$i]->door_no = $datas->doorNo[$i];
        //     $model[$i]->building_name = $datas->buildingName[$i];
        //     $model[$i]->street = $datas->street[$i];
        //     $model[$i]->area = $datas->area[$i];
        //     $model[$i]->district_id = "1";
        //     $model[$i]->city = $datas->city[$i];
        //     $model[$i]->pincode = $datas->pinCode[$i];
        //     $model[$i]->landmark = $datas->landMark[$i];
        //     $model[$i]->location = " ";
        //     $model[$i]->status_id = '1';
        //     $model[$i]->save();
            // Log::info('organizationServices> convertToOrganizationAddressModel  ' .json_encode($address[$i]));
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
    public function convertToOrganizationIdentityModel($datas, $organizationId)
    {
      dd('well');
            $model = new OrganizationIdentity();
            $model->org_id = $organizationId;
            $model->doc_type_id = $datas->DocumentType;
            $model->doc_no = $datas->documentNumber;
            $model->doc_validity = $datas->validTill;
            $model->doc_attachment=$datas->attachments; 
            $model->status = '1';
            return $model;

            Log::info(' OrganizationIdentity datas    '.json_encode($model)); 

        }

      public function convertToOrganizationAdminstratorModel($datas ,$organizationId)
    { 
        $model= new organizationAdministrators();
        $model->org_id = $organizationId;
        $model->u_id="1";
        $model->administrator_type_id=$datas->administratorsType;
        $model->verification_status_id="1";
        return $model;
        log::info(  'organizationService> Admin   '   .json_encode($model));
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
            file_put_contents($path, str_replace(
                'REPLACE_DB_HERE',
                $new_env,
                file_get_contents($path)
            ));
        }

        //Creating Dynamic DB//
        $preDatabase = Config::get('database.connections.mysql.database');
        DB::statement("CREATE DATABASE IF NOT EXISTS $db_name");
        $new = Config::set('database.connections.mysql.database', $db_name);
        DB::purge('mysql');
        DB::reconnect('mysql');
        \Artisan::call('migrate');
        Config::set('database.connections.mysql.database', $preDatabase);
        return true;
    }
}