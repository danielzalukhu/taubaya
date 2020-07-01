<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $table = 'guardians';
    protected $fillable = ['FIRST_NAME', 'LAST_NAME', 'B_YEAR', 'STATUS', 'JOB', 'EDUCATION', 'PHONE', 'EMAIL',
                           'ADDRESS', 'STUDENTS_ID'];                   
    
    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
