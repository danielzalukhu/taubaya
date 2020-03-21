<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $fillable = ['MODULE', 'DESCRIPTION'];
    
    public function kd()
    {
        return $this->belongsToMany('App\KD', 'activity_KD');
    }

    public function student()
    {
        return $this->belongsToMany('App\Student', 'activities_students')->withPivot(['SCORE']);
    }
}
