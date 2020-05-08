<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    
    public function departmentstaff()
    {
        return $this->belongsTo('App\DepartmentStaff', 'DEPARTMENTS_ID');
    }

    public function subject()
    {
        return $this->hasMany('App\Subject');
    }
}
