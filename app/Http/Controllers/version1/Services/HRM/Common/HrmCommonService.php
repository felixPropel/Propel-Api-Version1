<?php

namespace App\Services\HRM\Common;

use App\Interfaces\Person\PersonInterface;

/**
 * Class HrmCommonService.
 * @package App\Services
 */
class HrmCommonService
{

    public function __construct(PersonInterface $personInterface)
    {
        $this->personInterface = $personInterface;
    }

    public function getPersonDataByEmailAndMobile($datas)
    {
        $datas = (object)$datas;
            
        $email = $datas->email;
        $mobile = $datas->mobile;
        $models = $this->personInterface->getPersonDataByEmailAndMobile($email, $mobile);
    }
}
