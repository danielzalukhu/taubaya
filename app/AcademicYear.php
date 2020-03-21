<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $table = 'academic_years';
    protected $fillable = ['TYPE', 'START_DATE', 'END_DATE'];

    public function violationRecord()
    {
        return $this->hasMany('App\ViolationRecord');
    }

    public function report()
    {
        return $this->hasMany('App\Report');
    }

    public function student_class()
    {
        return $this->hasMany('App\StudentClasses');
    }
}
