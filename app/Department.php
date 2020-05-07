<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function staff()
    {
        return $this->belongsToMany('App\Staff', 'extracurriculars_reports');
    }

    public function subject()
    {
        return $this->hasMany('App\Subject');
    }
}
