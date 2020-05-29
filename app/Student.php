<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['ATT_ID', 'CARD_NUM', 'NIS', 'PASSWORD', 'NISN', 'NIK', 'FNAME', 'LNAME', 'GENDER',
                           'BPLACE', 'BDATE', 'MAIL', 'PHONE', 'ADDRESS', 'RT', 'RW', 'DISTRICT', 'SUBDISTRICT',
                           'CITY', 'PROVINCE', 'GR_FROM', 'BANK_ACC', 'STATUS', 'NOTES', 'IMG_PATH', 'BANKS_ID',
                           'RELIGIONS_ID', 'ACADEMICE_YEAR_ID', 'TOKENS_ID'];

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

    public function gradestudent()
    {
        return $this->hasMany('App\GradeStudent');
    }

    public function getGradeName(){
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;
        
        $grade = Grade::select('grades.NAME')
                        ->join('grades_students','grades.id','=','grades_students.GRADES_ID')                        
                        ->join('students','grades_students.STUDENTS_ID','=','students.id') 
                        ->where('grades_students.STUDENTS_ID', $this->id)
                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                        ->first();

        return $grade->NAME;
    }
                           
    public function violationrecord()
    {
        return $this->hasMany('App\ViolationRecord');
    }
    
    public function subjectrecord()
    {
        return $this->hasMany('App\SubjectRecord');
    }

    public function extracurricularrecord()
    {
        return $this->hasMany('App\ExtracurricularRecord');
    }

    public function achivement()
    {
        return $this->belongsToMany('App\Achivement', 'achievements_records')->withPivot(['DATE', 'DESCRIPTION']);
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

    public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'ACADEMIC_YEAR_ID');
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
