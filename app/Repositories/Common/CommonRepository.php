<?php

namespace App\Repositories\Common;

use App\Interfaces\CommonInterface;
use App\Models\BasicModels\Salutation;

//use Your Model

/**
 * Class CommonRepository.
 */
class CommonRepository implements CommonInterface
{
    public function getAllSaluations()
    {
        return Salutation::get();
    }
}
