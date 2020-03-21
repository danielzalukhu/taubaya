<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }

    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }

    public function extracurricular()
    {
        return $this->belongsToMany('App\Extracurricular', 'extracurriculars_reports')->withPivot(['DESCRIPTION']);
    }

    public function subject()
    {
        return $this->belongsToMany('App\Subject', 'reports_subjects')->withPivot(['FINAL_SCORE']);
    }
}
