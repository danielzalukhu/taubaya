<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ViolationRecord;
use App\Absent;

class Staff extends Model
{
    protected $table = 'staffs';

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
        return $this->hasMany('App\Grade', 'GRADES_ID');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'USERS_EMAIL');
    }

    public function department()
    {
        return $this->belongsToMany('App\Department', 'extracurriculars_reports');
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
