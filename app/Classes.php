<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table= 'classes';

    public function student()
    {
        return $this->belongsToMany('App\Student', 'classes_students', 'STUDENTS_ID', 'CLASSES_ID');
    }    

    public function program()
    {
        return $this->belongsTo('App\Program', 'PROGRAMS_ID');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }
}
