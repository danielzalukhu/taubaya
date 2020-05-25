<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $fillable = ['NIK', 'NAME', 'ROLE', 'created_at', 'updated_at'];

    public function violationrecord()
    {
        return $this->hasMany('App\ViolationRecord');
    }
    
    public function absent()
    {
        return $this->hasMany('App\Absent');
    }      

    public function grade()
    {
        return $this->hasMany('App\Grade');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'USERS_EMAIL');
    }

    public function departmentstaff()
    {
        return $this->belongsTo('App\DepartmentStaff', 'STAFFS_ID');
    }

    public function getDepartmentName(){
        $department = DepartmentStaff::select("departments.NAME")
                        ->join('departments','departments.id','=','departments_staffs.DEPARTMENTS_ID')
                        ->WHERE("departments_staffs.STAFFS_ID", $this->id)
                        ->first();

        return $department->NAME;
    }

    public function extracurricular()
    {
        return $this->hasMany('App\Extracurricular');
    }

    public function achievementrecord()
    {
        return $this->hasMany('App\AchievementRecord');
    }
}
