<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityKD extends Model
{
    protected $table = 'activities_kd';
    protected $fillable = ['KD_ID', 'ACTIVITIES_ID'];
}
