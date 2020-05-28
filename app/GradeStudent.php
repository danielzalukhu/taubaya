<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeStudent extends Model
{
    protected $table= 'grades_students';
    protected $fillable = ['STUDENTS_ID', 'GRADES_ID', 'ACADEMIC_YEAR_ID'];

    public function grade()
    {
        return $this->belongsTo('App\Grade', 'GRADES_ID');
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
