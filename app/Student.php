<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['ATT_ID', 'CARD_NUM', 'NIS', 'PASSWORD', 'NISN', 'NIK', 'FNAME', 'LNAME', 'GENDER',
                           'BPLACE', 'BDATE', 'MAIL', 'PHONE', 'ADDRESS', 'RT', 'RW', 'DISTRICT', 'SUBDISTRICT',
                           'CITY', 'PROVINCE', 'GR_FROM', 'BANK_ACC', 'STATUS', 'NOTES', 'IMG_PATH', 'BANKS_ID',
                           'RELIGIONS_ID', 'YEAR_IN', 'TOKENS_ID', 'USERS_EMAIL'];

    public function violationRecord()
    {
        return $this->hasMany('App\ViolationRecord');
    }
    
    public function absent()
    {
        return $this->hasMany('App\Absent');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank', 'BANKS_ID');
    }

    public function religion()
    {
        return $this->belongsTo('App\Religion', 'RELIGIONS_ID');
    }

    public function classes()
    {
        return $this->belongsToMany('App\Classes', 'classes_students', 'STUDENTS_ID', 'CLASSES_ID');
    }

    public function report()
    {
        return $this->hasMany('App\Report');
    }

    public function achivement()
    {
        return $this->belongsToMany('App\Achivement', 'achievements_students')->withPivot(['DATE', 'DESCRIPTION', 'RANK']);
    }

    public function activity()
    {
        return $this->belongsToMany('App\Activity', 'activities_students')->withPivot(['SCORE']);
    }

    public function user()
    {
        return $this->hasOne('App\User', 'USERS_EMAIL');
    }

    public function token()
    {
        return $this->hasOne('App\Token', 'TOKENS_ID');
    }

    public function getPhoto()
    {
        if(!$this->img_PATH)
        {
            return asset('images/default.jpg');
        }
        return asset('images/'.$this->img_PATH);
    }
    
}
