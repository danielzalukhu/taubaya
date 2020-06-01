<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function getEkskulName(){    
        $ekskul = Extracurricular::select('extracurriculars.NAME')                   
                        ->join('extracurricular_reports', 'extracurriculars.id', 'extracurricular_reports.EXTRACURRICULARS_ID')
                        ->join('extracurricular_records', 'extracurricular_reports.EXTRACURRICULAR_RECORD_ID', 'extracurricular_records.id')
                        ->first();  

        return $ekskul->NAME;
        
    }
}
