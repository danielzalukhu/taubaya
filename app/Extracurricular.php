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
}
