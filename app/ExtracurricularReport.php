<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ExtracurricularReport extends Model
{
    protected $table = 'extracurricular_reports';
    protected $fillable = ['EXTRACURRICULARS_ID', 'EXTRACURRICULAR_RECORD_ID', 'SCORE', 'NOTES'];

    public function extracurricular()
    {
        return $this->belongsTo('App\Extracurricular' ,'EXTRACURRICULARS_ID');
    }

    public function extracurricularrecord()
    {
        return $this->belongsTo('App\ExtracurricularRecord' ,'EXTRACURRICULAR_RECORD_ID');
    }    
}
