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

    public function forumlaAssesment()
    {
        $siswa = Student::find(1);

        $jurusan = $siswa->grade->NAME;
        $get_jurusan = explode(' ', $jurusan)[1];
        // dd($get_jurusan);

        $mapel = Subject::where('CODE', 'like', '%'.$get_jurusan.'%')->get();
        dd($mapel);
        $get_mapel = array([0]=>MTK, [1]=>10, [2]=>TKJ);

        if($get_jurusan == $get_mapel[2] && $siswa->grade->GRADE == $get_mapel[1])
        {
            $tmp_TUGAS = [];
            $tmp_PH = [];
            $tmp_PTS = [];
            $tmp_PAS = [];

            // PISAHIN DULU JENIS AKTIVITAS MASUKIN DALAM ARRAY 
            $aktivitas_mapel = ActivityStudent::all();
            foreach($aktivitas_mapel as $am)
            {
                if($am->activity->NAME == 'TUGAS')
                {
                    $tmp_TUGAS = array_push($tmp_TUGAS, $am->SCORE);
                }
                elseif($am->activity->NAME == 'PH')
                {
                    $tmp_PH = array_push($tmp_PH, $am->SCORE);
                }
                elseif($am->activity->NAME == 'PTS')
                {
                    $tmp_PTS = array_push($tmp_PTS, $am->SCORE);
                }
                elseif($am->activity->NAME == 'PTS')
                {
                    $tmp_PAS = array_push($tmp_PAS, $am->SCORE);
                }
            }

            // HITUNG NILAINYA
            $tmp_calculate_TUGAS = 0; 
            foreach($tmp_TUGAS as $t)
            {
                $tmp_calculate_TUGAS = $tmp_calculate_TUGAS + $t->SCORE;
                $tmp_calculate_TUGAS = $tmp_calculate_TUGAS / count($tmp_TUGAS) * (0.1);
            } 
            
            $tmp_calculate_PH = 0;
            foreach($tmp_PH as $t)
            {
                $tmp_calculate_PH = $tmp_calculate_PH + $t->SCORE;
                $tmp_calculate_PH = $tmp_calculate_PH / count($tmp_PH) * (0.3);
            } 
            
            $tmp_calculate_PTS = 0;
            foreach($tmp_PTS as $t)
            {
                $tmp_calculate_PTS = $tmp_calculate_PTS + $t->SCORE;
                $tmp_calculate_PTS = $tmp_calculate_PTS / count($tmp_PTS) * (0.3);
            } 
            
            $tmp_calculate_PAS = 0;
            foreach($tmp_PAS as $t)
            {
                $tmp_calculate_PAS = $tmp_calculate_PAS + $t->SCORE;
                $tmp_calculate_PAS = $tmp_calculate_PAS / count($tmp_PAS) * (0.4);
            } 
        }
    }
}
