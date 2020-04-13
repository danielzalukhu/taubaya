<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Staff;
use App\Student;
use App\Violation;
use App\AcademicYear;
use App\ViolationRecord;

class ViolationRecord extends Model
{
    protected $table = 'violation_records';
    protected $fillable = ['DATE', 'TOTAL', 'DESCRIPTION', 'PUNISHMENT', 'STUDENTS_ID', 'ACADEMIC_YEAR_ID',  'VIOLATIONS_ID', 'STAFFS_ID'];

    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }
    
    public function violation()
    {
        return $this->belongsTo('App\Violation', 'VIOLATIONS_ID');
    }
    
    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }
}
