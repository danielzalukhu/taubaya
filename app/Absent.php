<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Absent extends Model
{
    protected $table = 'absents';
    protected $fillable = ['START_DATE', 'END_DATE', 'TYPE', 'DESCRIPTION', 'RECEIPT_IMG', 'STUDENTS_ID', 'ACADEMIC_YEAR_ID' ,'STAFFS_ID'];

    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }

    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }
}
