<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AchievementRecord extends Model
{
    protected $table = 'achievement_records';
    protected $fillable = ['STUDENTS_ID', 'ACHIEVEMENTS_ID', 'DATE', 'DESCRIPTION', 'ACADEMIC_YEAR_ID' ,'STAFFS_ID'];

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }

    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }

    public function achievement()
    {
        return $this->belongsTo('App\Achievement', 'ACHIEVEMENTS_ID');
    }
}
