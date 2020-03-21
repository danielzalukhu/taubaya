<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function classes()
    {
        return $this->hasMany('App\Classes');
    }
    
}
