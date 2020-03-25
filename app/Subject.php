<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['CODE', 'DESCRIPTION', 'MINIMALPOIN', 'TYPES'];
    protected $guarded = [];

    public function report()
    {
        return $this->belongsToMany('App\Report', 'reports_subjects')->withPivot(['FINAL_SCORE']);
    }

    public function kd()
    {
        return $this->hasMany('App\KD');
    }

    public function activityStudent()
    {
        return $this->hasMany('App\ActivityStudent');
    }
}
