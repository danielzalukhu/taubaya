<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Subject;
use App\Student;
use App\Activity;
use App\ActivityStudent;
use DB;


class SubjectImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);   
        foreach($collection as $key => $row)
        {           
            if($key >=1 && $key >= 5)
            {
                $subject_id = $row[4];
                $id_mapel = $this->selectSubjectId($subject_id);

                $student_id = $row[4];
                $id_siswa = $this->selectStudentId($student_id);    

                $activity_id = explode("; ", $row[6])[1];
                $id_aktivitas = $this->selectActivityId($activity_id);

                $nilai = $row[8];                

                ActivityStudent::create([
                    'STUDENTS_ID' => $id_siswa,
                    'ACTIVITIES_ID' => $id_aktivitas,
                    'SUBJECTS_ID' => $id_mapel,
                    'SCORE' => $nilai,
                ]);
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
}
