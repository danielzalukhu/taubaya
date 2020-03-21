<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table='religions';

    public function student()
    {
        return $this->hasMany('App\Student');
    }
}
