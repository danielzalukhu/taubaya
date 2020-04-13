<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectRecord extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }
    
    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }
}
