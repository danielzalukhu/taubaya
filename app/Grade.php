<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Grade extends Model
{
    protected $table= 'grades';
    protected $fillable = ['NAME', 'DESCRIPTION', 'GRADE', 'PROGRAMS_ID', 'STAFFS_ID'];

    public function program()
    {
        return $this->belongsTo('App\Program', 'PROGRAMS_ID');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }

    public function gradestudent()
    {
        return $this->hasMany('App\GradeStudent');
    }
}
