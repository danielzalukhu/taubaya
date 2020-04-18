<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectReport extends Model
{
    protected $table = 'subject_reports';
    protected $fillable = ['SUBJECTS_ID', 'SUBJECT_RECORD_ID', 'FINAL_SCORE', 'IS_VERIFIED', 'TUGAS', 'PH', 'PTS', 'PAS',
                            'UN', 'US'];

    public function subject()
    {
        return $this->belongsTo('App\Subject' ,'SUBJECT_ID');
    }

    public function subjectrecord()
    {
        return $this->belongsTo('App\SubjectRecord' ,'SUBJECT_RECORD_ID');
    }
}
