<?php
namespace App\Services;

use App\Interfaces\PersonInterface;

class PersonService
{
    protected $personInterface;
    
    public function __construct(PersonInterface $personInterface)
    {
        $this->personInterface = $personInterface;
    }

    public function get_stage($data){
        $response=$this->personInterface->get_stage($data);
        return $response;
    }

    public function check_for_email($data)
    {
        $response=$this->personInterface->check_for_email($data);
        return $response;
    }

    public function update_person_details($data)
    {
        $response=$this->personInterface->update_person_details($data);
        return $response;
    }
    
    public function person_details_stage1($data){
        $response=$this->personInterface->person_details_stage1($data);
        return $response;
    }

    public function person_details_stage2($data){
        $response=$this->personInterface->person_details_stage2($data);
        return $response;
    }
    
    public function create_user($data){
        $response=$this->personInterface->create_user($data);
        return $response;
    }

    public function upload_pic($data){
        $response=$this->personInterface->upload_pic($data);
        return $response;
    }
    
    public function person_details_by_uid($data){
        $response=$this->personInterface->person_details_by_uid($data);
        return $response;
    }

    public function complete_profile($data){
        $response=$this->personInterface->complete_profile($data);
        return $response;
    }
    
 
}