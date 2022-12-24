<?php

namespace App\Models\BasicModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;
    protected $table = 'pims_person_marital_statues';

}
