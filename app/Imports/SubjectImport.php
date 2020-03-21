<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Subject;
use App\Student;
use DB;
use App\Activity;

class SubjectImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //dd($collection);        
        foreach($collection as $key => $row)
        {          
            // if($key >= 1)
            // {
            //     $subjects_id = $this->selectSubjectId($row[4]);
            //     dd($subjects_id);
            // }
            
            if($key >= 5)
            {
                $id_siswa = $this->selectStudentId($row[4]);
                dd($id_siswa);
                $activity_id = explode("; ", $row[6])[1];
                // dd($activity_id);
                $id_aktivitas = $this->selectActivityId($activity_id);
                //dd($id_aktivitas);
                
                // ActivityStudent::create([
                //     'STUDENTS_ID' => $id_siswa,
                //     'ACTIVITIES_ID' => 'ID',
                //     'SCORE' => '8',
                // ]);
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
                                 WHERE activities.MODULE = ' . $value);
        return $aktivitas;
    }

    public function selectSubjectId($value)
    {
        $mapel = DB::SELECT('SELECT id
                             FROM subjects 
                             WHERE subjects.DESCRIPTION = ' . $value);
        return $mapel;
    }
}
