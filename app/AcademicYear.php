<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $table = 'academic_years';
    protected $fillable = ['NAME', 'TYPE', 'START_DATE', 'END_DATE'];

    public function absent()
    {
        return $this->hasMany('App\Absent');
    }

    public function violationrecord()
    {
        return $this->hasMany('App\ViolationRecord');
    }

    public function achievementrecord()
    {
        return $this->hasMany('App\AchievementRecord');
    }

    public function extracurricularrecord()
    {
        return $this->hasMany('App\ExtracurricularRecord');
    }

    public function subjectrecord()
    {
        return $this->hasMany('App\SubjectRecord');
    }

    public function activitystudent()
    {
        return $this->hasMany('App\ActivityStudent');
    }
}
