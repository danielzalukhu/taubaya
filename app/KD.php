<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KD extends Model
{
    public function subject()
    {
        return $this->belongsTo('App\Subject', 'SUBJECTS_ID');
    }

    public function activity()
    {
        return $this->belongsToMany('App\Activity', 'activity_KD');
    }
}
