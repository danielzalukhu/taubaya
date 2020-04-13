<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements';
    protected $fillable = ['DESCRIPTION', 'POINT', 'GRADE', 'TYPE'];

    public function student()
    {
        return $this->belongsToMany('App\Student', 'achievements_records')->withPivot(['DATE', 'DESCRIPTION']);
    }
}
