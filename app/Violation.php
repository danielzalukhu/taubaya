<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ViolationRecord;

class Violation extends Model
{
    protected $table = 'violations';
    protected $fillable = ['NAME', 'DESCRIPTION', 'POINT', 'STAFFS_ID'];
    
    public function violationRecord()
    {
        return $this->hasMany('App\ViolationRecord');
    }
}
