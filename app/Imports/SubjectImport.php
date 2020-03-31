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
use App\KD;
use App\Imports\SubjectImport;
use DB;


class SubjectImport implements ToCollection
{
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

                    ActivityStudent::create([
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
                          WHERE NUMBER = ' . $value);
        return $kd;                          
    }
}
