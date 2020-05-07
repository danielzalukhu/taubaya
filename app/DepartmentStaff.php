<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentStaff extends Model
{
    protected $table = 'departments_staffs';
    protected $fillable = ['STAFFS_ID', 'DEPARTMENTS_ID'];

    public function department()
    {
        return $this->belongsTo('App\Department' ,'DEPARTMENTS_ID');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff' ,'STAFFS_ID');
    }
}
