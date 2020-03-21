<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements';
    protected $fillable = ['DESCRIPTION', 'POINT', 'TYPE'];

    public function student()
    {
        return $this->belongsToMany('App\Student', 'achievements_students')->withPivot(['DATE', 'DESCRIPTION', 'RANK']);
    }
}
