<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityStudent extends Model
{
    protected $table = 'activities_students';
    protected $fillable = ['STUDENTS_ID', 'ACTIVITIES_ID', 'SUBJECTS_ID', 'SCORE'];
    
    public function subject()
    {
        return $this->belongsTo('App\Subject', 'SUBJECTS_ID');
    }
}
