<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }

    public function extracurricularrecord()
    {
        return $this->belongsToMany('App\ExtracurricularRecord', 'extracurriculars_reports')->withPivot(['SCORE', 'NOTES']);
    }
}
