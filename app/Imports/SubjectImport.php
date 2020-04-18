<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Subject;
use App\Student;
use App\Activity;
use App\ActivityStudent;
use App\ActivityKD;
use App\SubjectRecord;
use App\SubjectReport;
use App\KD;
use App\Imports\SubjectImport;
use DB;

class SubjectImport implements ToCollection
{
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    /**
    * @param Collection $collection
    */
    private $id_mapel;

    public function collection(Collection $collection)
    {
        foreach($collection as $key => $row)
        {
            if($key >= 1)
            {
                $subject_id = $row[4];
                $tmp_id_mapel = $this->selectSubjectId($subject_id);
                
                foreach($tmp_id_mapel as $im)
                {
                    $id_mapel = $im->id;
                }

                if($key >= 5)
                {                  
                    $student_id = $row[4];
                    $id_siswa = $this->selectStudentId($student_id)[0]->id;

                    $activity_id = explode("; ", $row[6])[1];
                    $id_aktivitas = $this->selectActivityId($activity_id)[0]->id;

                    $kd_id = $row[7];
                    $id_kd = $this->selectKdId($kd_id)[0]->id;

                    $nilai = $row[8];        

                    $a = ActivityStudent::create([
                        'STUDENTS_ID' => $id_siswa,
                        'ACTIVITIES_ID' => $id_aktivitas,
                        'SUBJECTS_ID' => $id_mapel,
                        'SCORE' => $nilai,                    
                    ]);

                    ActivityKD::create([
                        'KD_ID' => $id_kd,
                        'ACTIVITIES_ID' => $id_aktivitas,
                    ]);
                }      
            }            
        }         
        $this->formula();    
    }

    public function formula()
    {
        $tmp_nilai = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                                    ->select('students.*', 'activities_students.*')
                                    ->get();

        $arrayOfStudent = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                                ->select('students.*', 'activities_students.*')
                                ->groupBy('activities_students.STUDENTS_ID')
                                ->get();            
                                                    
        foreach ($arrayOfStudent as $student) 
        {
            $tmp_nama = $student->FNAME ." ". $student->LNAME;
            $tmp_nisn = $student->NISN;
            $tmp_tugas = [];
            $tmp_ph = [];
            $tmp_pts = [];
            $tmp_pas = [];
            $tmp_us = [];
            $tmp_un = [];

            $subject_record = new SubjectRecord();
            $subject_record->ACADEMIC_YEAR_ID = $this->request->session()->get("session_academic_year_id");
            $subject_record->STUDENTS_ID = $student->STUDENTS_ID;
            $subject_record->save();
        
            foreach ($tmp_nilai as $nilai)
            {             
                if($nilai->STUDENTS_ID){
                    if($nilai->ACTIVITIES_ID === 1){  
                        array_push($tmp_tugas, $nilai->SCORE);
                    }else if($nilai->ACTIVITIES_ID === 2){
                        array_push($tmp_ph, $nilai->SCORE);
                    }else if($nilai->ACTIVITIES_ID === 3){     
                        array_push($tmp_pts, $nilai->SCORE);
                    }else if($nilai->ACTIVITIES_ID === 4){
                        array_push($tmp_pas, $nilai->SCORE);
                    }else if($nilai->ACTIVITIES_ID === 5){
                        array_push($tmp_us, $nilai->SCORE);
                    }else if($nilai->ACTIVITIES_ID === 6){
                        array_push($tmp_un, $nilai->SCORE);
                    }
                }                                                       
            }             
                    
            $subject_report = SubjectReport::create([
                'SUBJECTS_ID' => $student->SUBJECTS_ID,
                'SUBJECT_RECORD_ID' => $subject_record->id,
                'IS_VERIFIED' => '0',
                'TUGAS' => json_encode($tmp_tugas),
                'PH' => json_encode($tmp_ph),
                'PTS' => json_encode($tmp_pts),
                'PAS' => json_encode($tmp_pas),
                'US' => json_encode($tmp_us),
                'UN' => json_encode($tmp_un),
            ]);
        }
    }

    public function selectStudentId($value)
    {
        $siswa = DB::SELECT('SELECT id
                             FROM students 
                             WHERE students.NISN = ' . $value);
        return $siswa;                            
    }

    public function selectActivityId($value)
    {
        $aktivitas = DB::SELECT('SELECT id
                                 FROM activities 
                                 WHERE activities.MODULE = "' . $value . '"');
        return $aktivitas;
    }

    public function selectSubjectId($value)
    {
        $mapel = DB::SELECT('SELECT id
                             FROM subjects 
                             WHERE subjects.DESCRIPTION = "' . $value . '"');
        return $mapel;
    }

    public function selectKdId($value)
    {
        $kd = DB::SELECT('SELECT id
                          FROM KD
                          WHERE NUMBER =  "' . $value . '"');
        return $kd;                          
    }
}
