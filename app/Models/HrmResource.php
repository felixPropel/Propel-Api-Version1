<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmResource extends Model
{
    use HasFactory;
    public function __construct()
    {
        parent::__construct();
        $this->connection = 'mysql_external';
    }
    public function Person()
    {
        return $this->hasOne(Person::class, 'uid', 'uid');
    }
}
