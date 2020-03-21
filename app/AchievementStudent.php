<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AchievementStudent extends Model
{
    protected $table = 'achievements_students';
    protected $fillable = ['STUDENTS_ID', 'ACHIEVEMENTS_ID', 'DATE', 'DESCRIPTION', 'RANK', 'ACADEMIC_YEAR_ID' ,'STAFFS_ID'];

    public function achievement_student()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
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
