<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }

    public function report()
    {
        return $this->belongsToMany('App\Report', 'extracurriculars_reports')->withPivot(['DESCRIPTION']);
    }
}
