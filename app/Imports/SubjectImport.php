<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Imports\SubjectImport;
use App\Subject;
use App\Student;
use App\Activity;
use App\ActivityStudent;
use App\ActivityKD;
use App\SubjectRecord;
use App\SubjectReport;
use App\KD;
use DB;
use Session;

class SubjectImport implements ToCollection
{
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    /**
    * @param Collection $collection
    */
    private $mapel;
    private $kodeKelas;

    public function collection(Collection $collection)
    {   
        foreach($collection as $key => $row)
        {
            if($key >= 1)
            {
                $subject_name = $row[4];
                $tmp_mapel = $this->selectSubjectDescription($subject_name);
                
                foreach($tmp_mapel as $tmp)
                {
                    $mapel = $tmp->DESCRIPTION;
                }
                
                if($key >= 3)
                {
                    $grade_code = $row[4];                
                    $tmp_grade = $this->selectGradeCode($grade_code);
                
                    foreach($tmp_grade as $tm)
                    {
                        $kodeKelas = $tm->NAME;
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
                        
                        $tmp_id_mapel = $this->selectSubjectId($mapel, $kodeKelas);

                        foreach($tmp_id_mapel as $tim)
                        {
                            $id_mapel = $tim->id;
                        }

                        $a = ActivityStudent::create([
                            'STUDENTS_ID' => $id_siswa,
                            'ACTIVITIES_ID' => $id_aktivitas,
                            'SUBJECTS_ID' => $id_mapel,
                            'ACADEMIC_YEAR_ID' => $this->request->session()->get("session_academic_year_id"),
                            'SCORE' => $nilai,                     
                        ]);
                        dd($a);
                        ActivityKD::create([
                            'KD_ID' => $id_kd,
                            'ACTIVITIES_ID' => $id_aktivitas,
                        ]);
                    }      
                }
                
            }            
        }        
        $this->formula($a->SUBJECTS_ID);    
    }

    public function formula($mapel_id)
    {                    
        $tmp_nilai = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                                ->select('students.*', 'activities_students.*')
                                ->where('activities_students.SUBJECTS_ID', $mapel_id)
                                ->where('activities_students.ACADEMIC_YEAR_ID', $this->request->session()->get("session_academic_year_id"))
                                ->get();  
        
        $arrayOfStudent = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                                ->select('students.*', 'activities_students.*')
                                ->where('activities_students.SUBJECTS_ID', $mapel_id)
                                ->where('activities_students.ACADEMIC_YEAR_ID', $this->request->session()->get("session_academic_year_id"))
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
                if($nilai->STUDENTS_ID === $student->STUDENTS_ID){
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
 
            $count_tugas = $this->countActivity($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 1));
            $sum_score_tugas = $this->sumTotalScore($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 1));

            $count_ph = $this->countActivity($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 2));
            $sum_score_ph = $this->sumTotalScore($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 2));

            $count_pts = $this->countActivity($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 3));
            $sum_score_pts = $this->sumTotalScore($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 3));

            $count_pas = $this->countActivity($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 4));
            $sum_score_pas = $this->sumTotalScore($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 4));

            $count_us = $this->countActivity($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 5));
            $sum_score_us = $this->sumTotalScore($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 5));

            $count_un = $this->countActivity($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 6));
            $sum_score_un = $this->sumTotalScore($student->STUDENTS_ID, ($student->ACTIVITIES_ID = 6));

            // dd($count_tugas);

            foreach($count_tugas as $ct){
                $tmp_ct = $ct->BANYAKAKTIVITAS;
                foreach($sum_score_tugas as $sct){
                    $tmp_sct = $sct->TOTALNILAI;
                }
                $avarage_tugas = ($tmp_sct / $tmp_ct) * 0.1;
            }

            foreach($count_ph as $cph){
                $tmp_cph = $cph->BANYAKAKTIVITAS;
                foreach($sum_score_ph as $scph){
                    $tmp_scph = $scph->TOTALNILAI;
                }
                $avarage_ph = ($tmp_scph / $tmp_cph) * 0.2;
            }

            foreach($count_pts as $cpts){
                $tmp_cpts = $cpts->BANYAKAKTIVITAS;
                foreach($sum_score_pts as $scpts){
                    $tmp_scpts = $scpts->TOTALNILAI;
                }
                $avarage_pts = ($tmp_scpts / $tmp_cpts) * 0.3;
            }

            foreach($count_pas as $cpas){
                $tmp_cpas = $cpas->BANYAKAKTIVITAS;
                foreach($sum_score_pas as $scpas){
                    $tmp_scpas = $scpas->TOTALNILAI;
                }
                $avarage_pas = ($tmp_scpas / $tmp_cpas) * 0.4;
            }
            
            $total_score_student = $avarage_tugas + $avarage_ph + $avarage_pts + $avarage_pas;            
            $fix_total_score_round = round($total_score_student, 2);
            
            // dd($fix_total_score_round);
            // $a = array($avarage_tugas, $avarage_ph, $avarage_pts, $avarage_pas, $total_score_student);
            // dd($a);
            // dd($student->SUBJECTS_ID);

            $subject_report = SubjectReport::create([
                'SUBJECTS_ID' => $student->SUBJECTS_ID,
                'SUBJECT_RECORD_ID' => $subject_record->id,
                'FINAL_SCORE' => $fix_total_score_round,
                'IS_VERIFIED' => 0,
                'TUGAS' => json_encode($tmp_tugas),
                'PH' => json_encode($tmp_ph),
                'PTS' => json_encode($tmp_pts),
                'PAS' => json_encode($tmp_pas),
                'US' => json_encode($tmp_us),
                'UN' => json_encode($tmp_un),
            ]);

            //array_push($result, "SubjectRecordId: ". $subject_record->id ."tugas: ".json_encode($tmp_tugas));
        }
    }

    public function countActivity($id, $activity_id)
    {
        $tmp_count_activity = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                                        ->select('students.NISN', DB::raw('COUNT(*) AS BANYAKAKTIVITAS'))
                                        ->where('STUDENTS_ID', $id)
                                        ->where('ACTIVITIES_ID', $activity_id)
                                        ->get();
        return $tmp_count_activity;                                                
    }

    public function sumTotalScore($id, $activity_id)
    {
        $tmp_sum_score = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                                ->select('students.NISN', DB::raw('SUM(SCORE) AS TOTALNILAI'))
                                ->where('STUDENTS_ID', $id)
                                ->where('ACTIVITIES_ID', $activity_id)
                                ->get();
        return $tmp_sum_score;                                
    }

    public function selectStudentId($value)
    {
        $siswa = DB::SELECT('SELECT id
                             FROM students 
                             WHERE students.NISN = "' . $value . '"');
        return $siswa;                            
    }

    public function selectActivityId($value)
    {
        $aktivitas = DB::SELECT('SELECT id
                                 FROM activities 
                                 WHERE activities.MODULE = "' . $value . '"');
        return $aktivitas;
    }

    public function selectSubjectDescription($value)
    {
        $mapel = DB::SELECT('SELECT DESCRIPTION
                             FROM subjects 
                             WHERE subjects.DESCRIPTION = "' . $value . '"');
        return $mapel;
    }

    public function selectGradeCode($value)
    {
        $kelas = DB::SELECT('SELECT NAME
                             FROM grades 
                             WHERE grades.NAME = "' . $value . '"');
        return $kelas;                            
    }

    public function selectSubjectId($subjectName, $gradeCode)
    {
        $mapel = Subject::select('id')
                        ->where('DESCRIPTION', $subjectName)
                        ->where('CODE', 'LIKE' , '%'. $gradeCode .'%')
                        ->get();
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
