<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityStudent extends Model
{
    protected $table = 'activities_students';
    protected $fillable = ['STUDENTS_ID', 'ACTIVITIES_ID', 'SUBJECTS_ID', 'SCORE'];
    
    public function activity()
    {
        return $this->belongsTo('App\Activity' ,'ACTIVITIES_ID');
    }

    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'SUBJECTS_ID');
    }
}
