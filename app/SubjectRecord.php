<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectRecord extends Model
{
    protected $fillable = ['ACADEMIC_YEAR_ID', 'STUDENTS_ID'];

    public function subject()
    {
        return $this->belongsToMany('App\Subject', 'subject_reports')->withPivot(['FINAL_SCORE', 'IS_VERIFIED']);
    }

    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }
    
    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }
}
