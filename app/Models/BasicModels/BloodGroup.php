<?php

namespace App\Models\BasicModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use HasFactory;
    protected $table = 'pims_person_blood_groups';
}
