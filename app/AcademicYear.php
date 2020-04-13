<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $table = 'academic_years';
    protected $fillable = ['TYPE', 'START_DATE', 'END_DATE'];

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
}
