<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'banks';

    public function student()
    {
        return $this->hasMany('App\Student');
    }
}
