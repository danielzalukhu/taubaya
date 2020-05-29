<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $table = 'extracurriculars';
    protected $fillable = ['NAME', 'DESCRIPTION', 'STAFFS_ID']; 

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }

    public function extracurricularreport()
    {
        return $this->hasMany('App\ExtracurricularReport');
    }

    public function getEkskulName(){
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;
        
        $ekskul = Grade::select('extracurriculars.NAME')
                        ->join('extracurricular_reports','extracurriculars.id','=','extracurricular_reports.EXTRACURRICULARS_ID')                        
                        ->join('extracurricular_records','extracurricular_reports.EXTRACURRICULAR_RECORD_ID','=','extracurricular_records.id') 
                        ->where('extracurricular_reports.EXTRACURRICULARS_ID', $this->id)
                        ->where('extracurricular_records.ACADEMIC_YEAR_ID', $selected_student)
                        ->first();                     

        return $ekskul->NAME;
    }
}
