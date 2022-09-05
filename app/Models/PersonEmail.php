<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonEmail extends Model
{
    use HasFactory;
    protected $table = 'person_email';
    public function PersonDetail()
    {
        return $this->belongsTo(PersonDetails::class, 'uid', 'uid');
    }
}
