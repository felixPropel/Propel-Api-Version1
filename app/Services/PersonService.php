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
    
 
}