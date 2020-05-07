<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['CODE', 'DESCRIPTION', 'MINIMALPOIN', 'TYPES'];

    public function subjectrecord()
    {
        return $this->belongsToMany('App\SubjectRecord', 'subject_reports')->withPivot(['FINAL_SCORE', 'IS_VERIFIED']);
    }

    public function kd()
    {
        return $this->hasMany('App\KD');
    }

    public function activitystudent()
    {
        return $this->hasMany('App\ActivityStudent');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'DEPARTMENTS_ID');
    }
}
