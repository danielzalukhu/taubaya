<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }
}
