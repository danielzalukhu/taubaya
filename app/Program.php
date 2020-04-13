<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function grade()
    {
        return $this->hasMany('App\Grade', 'GRADES_ID');
    }
    
}
