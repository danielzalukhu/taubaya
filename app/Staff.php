<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ViolationRecord;
use App\Absent;

class Staff extends Model
{
    protected $table = 'staffs';

    public function violationRecord()
    {
        return $this->hasMany('App\ViolationRecord');
    }
    
    public function absent()
    {
        return $this->hasMany('App\Absent');
    }      

    public function classes()
    {
        return $this->hasMany('App\Staff');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'USERS_EMAIL');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'DEPARTMENTS_ID');
    }

    public function extracurricular()
    {
        return $this->hasMany('App\Extracurricular');
    }

    public function achievement_student()
    {
        return $this->hasMany('App\AchievementStudent');
    }
}
