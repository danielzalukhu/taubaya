<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtracurricularRecord extends Model
{
    protected $table = 'extracurricular_records';
    protected $fillable = ['STUDENTS_ID', 'ACADEMIC_YEAR_ID'];

    public function extracurricularreport()
    {
        return $this->hasMany('App\ExtracurricularReport');
    }

    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }
}
