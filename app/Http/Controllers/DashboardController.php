<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Student;
use App\AchievementRecord;
use App\ViolationRecord;
use App\Grade;
use App\GradeStudent;
use App\AcademicYear;
use App\Absent;
use Session;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // GLOBAL SESSION FOR WHOLE SYSTEM (SESSION ACADEMIC YEAR, SESSION USER LOGIN)
        
        $tahun_ajaran = DB::select('SELECT *
                                    FROM `academic_years`
                                    WHERE id = (SELECT MAX(id) as id 
                                                FROM academic_years)');           
        
        $request->session()->put('session_academic_year_id', $tahun_ajaran[0]->id);
        $request->session()->put('session_start_ay', $tahun_ajaran[0]->START_DATE);
        $request->session()->put('session_end_ay', $tahun_ajaran[0]->END_DATE);
        
        if(Auth::guard('web')->user()->ROLE === "STAFF"){
            $request->session()->put('session_user_id', Auth::user()->staff->id);
            $request->session()->put('session_user_email', Auth::user()->email);
        }
        elseif(Auth::guard('web')->user()->ROLE === "PARENT"){
            $request->session()->put('session_guardian_id', Auth::user()->guardian->student->id);            
            $request->session()->put('session_guardian_student_class', Auth::user()->guardian->student->getGradeName());
            $request->session()->put('session_user_email', Auth::user()->email);
        }
        else{
            $request->session()->put('session_student_class', Auth::user()->student->getGradeName());
            $request->session()->put('session_student_id', Auth::user()->student->id);
            $request->session()->put('session_user_email', Auth::user()->email);
        }        
        // dd($request->session()->get('session_guardian_student_class'));
        //END GLOBAL SESSION 
        
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;      

        if(Auth::guard('web')->user()->ROLE === "STAFF"){            
            $jumlah_siswa = $this->countStudent($request->session()->get('session_user_id'));

            $jumlah_penghargaan = $this->countAchievement($request->session()->get('session_user_id'));

            $jumlah_pelanggaran = $this->countViolation($request->session()->get('session_user_id'));

            $siswa_bermasalah = $this->getTroubleStudent($request->session()->get('session_user_id'), $selected_student, $request->session()->get('session_academic_year_id'));                                

            $daftar_ketidaktuntasan = $this->showStudentIncompleteness($request->session()->get('session_user_id'), $selected_student, $request->session()->get('session_academic_year_id'));
            
            $grafik_absen_data = $this->showAbsent($request->session()->get('session_user_id'));
            
            $daftar_penghargaan_siswa = $this->studentAchievements($request->session()->get('session_user_id'), $request->session()->get('session_academic_year_id'));            
            
            $daftar_pelanggaran_sering_terjadi = $this->violationListOftenOccur($request->session()->get('session_user_id'));

            return view('dashboard.index', compact('tahun_ajaran', 'jumlah_siswa', 'jumlah_penghargaan', 'jumlah_pelanggaran', 'siswa_bermasalah',
                                                   'daftar_ketidaktuntasan', 'grafik_absen_data',
                                                   'daftar_penghargaan_siswa'));
        }
        elseif(Auth::guard('web')->user()->ROLE === "PARENT"){
            $jumlah_penghargaan = $this->countAchievementKu($request->session()->get('session_guardian_id'));
            
            $jumlah_pelanggaran = $this->countViolationKu($request->session()->get('session_guardian_id'));

            $daftar_ketidaktuntasan = $this->myIncompleteness($request->session()->get('session_guardian_id'), $request->session()->get('session_academic_year_id'));
            
            $grafik_absen_data = $this->showAbsentKu($request->session()->get('session_guardian_id'));
            
            $daftar_penghargaan_siswa = $this->myAchievement($request->session()->get('session_guardian_id'), $request->session()->get('session_academic_year_id'));            
            
            return view('dashboard.index', compact('tahun_ajaran', 'jumlah_penghargaan', 'jumlah_pelanggaran', 'daftar_ketidaktuntasan',
                                                   'grafik_absen_data', 'daftar_penghargaan_siswa'));
        }
        else{
            $jumlah_penghargaan = $this->countAchievementKu($request->session()->get('session_student_id'));

            $jumlah_pelanggaran = $this->countViolationKu($request->session()->get('session_student_id'));

            $daftar_ketidaktuntasan = $this->myIncompleteness($request->session()->get('session_student_id'), $request->session()->get('session_academic_year_id'));
            
            $grafik_absen_data = $this->showAbsentKu($request->session()->get('session_student_id'));
            
            $daftar_penghargaan_siswa = $this->myAchievement($request->session()->get('session_student_id'), $request->session()->get('session_academic_year_id'));            
            
            return view('dashboard.index', compact('tahun_ajaran', 'jumlah_penghargaan', 'jumlah_pelanggaran', 'daftar_ketidaktuntasan',
                                                   'grafik_absen_data', 'daftar_penghargaan_siswa'));
        }            
    }

    public function countStudent($user_id)
    {
        if(Auth::guard('web')->user()->staff->ROLE === "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $user_id)
                                    ->first()->id; 
    
            $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;                                       
    
            $siswa = Student::join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                        ->select(DB::raw('COUNT(*) AS BANYAKSISWA'))
                        ->where('grades_students.GRADES_ID', $kelas_guru)
                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                        ->first()->BANYAKSISWA;                
        }
        elseif(Auth::guard('web')->user()->staff->ROLE === "HEADMASTER"){
            $siswa = Student::all()->count();               
        }
        else{
            $siswa = Student::all()->count();               
        }

        return $siswa;
    }

    public function countAchievement($user_id)
    {
        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $user_id)
                                    ->first()->id; 

            $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;  

            $penghargaan = AchievementRecord::join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select(DB::raw('COUNT(*) AS BANYAKPENGHARGAAN'))
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->first()->BANYAKPENGHARGAAN;
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $penghargaan = AchievementRecord::all()->count();
        }
        else{
            $penghargaan = AchievementRecord::all()->count();
        }
        
        return $penghargaan;
    }

    public function countAchievementKu($student_id)
    {
        $penghargaan = AchievementRecord::join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                    ->select(DB::raw('COUNT(*) AS BANYAKPENGHARGAAN'))
                                    ->where('students.id', $student_id)
                                    ->first()->BANYAKPENGHARGAAN;

        return $penghargaan;
    }

    public function countViolation($user_id)
    {        
        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $user_id)
                                    ->first()->id; 

            $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;

            $pelanggaran = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                        ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select(DB::raw('COUNT(*) AS BANYAKPELANGGARAN'))
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                        ->first()->BANYAKPELANGGARAN;
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $pelanggaran = ViolationRecord::all()->count();
        }
        else{
            $pelanggaran = ViolationRecord::all()->count();
        }
        
        return $pelanggaran;
    }

    public function countViolationKu($student_id)
    {
        $pelanggaran = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                    ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                    ->select(DB::raw('COUNT(*) AS BANYAKPELANGGARAN'))
                                    ->where('students.id', $student_id)
                                    ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                    ->first()->BANYAKPELANGGARAN;

        return $pelanggaran;                                            
    }

    public function getTroubleStudent($iduser, $selected_student, $tahun_ajaran)
    {
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $kelas_guru = Grade::where('STAFFS_ID', $iduser)->first()->id;            
            $siswa = GradeStudent::where('GRADES_ID', $kelas_guru)->where('ACADEMIC_YEAR_ID', $selected_student)->get();                    
            $arr_siswa = [];                                
            foreach($siswa as $s){
                array_push($arr_siswa, $s->STUDENTS_ID);
            }
            $siswa = ViolationRecord::join('students', 'violation_records.STUDENTS_ID', 'students.id')                           
                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                ->join('grades', 'grades.id', 'grades_students.GRADES_ID')
                                ->select('students.*', 'grades.NAME AS NAMAKELAS' ,
                                        DB::raw('COUNT(*) as BANYAKPELANGGARAN'), 
                                        DB::raw('SUM(violation_records.TOTAL) as TOTALPOIN'))
                                ->whereIn('violation_records.STUDENTS_ID', $arr_siswa)  
                                ->where('violation_records.ACADEMIC_YEAR_ID', $tahun_ajaran)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                ->groupBy('students.id')
                                ->orderBy('violation_records.id', 'DESC')->take(5)
                                ->having('TOTALPOIN', ">=", 50 )
                                ->get();    

        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $siswa = ViolationRecord::join('students', 'violation_records.STUDENTS_ID', 'students.id')                           
                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                ->join('grades', 'grades.id', 'grades_students.GRADES_ID')
                                ->select('students.*', 'grades.NAME AS NAMAKELAS' ,
                                        DB::raw('COUNT(*) as BANYAKPELANGGARAN'), 
                                        DB::raw('SUM(violation_records.TOTAL) as TOTALPOIN'))
                                ->where('violation_records.ACADEMIC_YEAR_ID', $tahun_ajaran)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                ->groupBy('students.id')
                                ->orderBy('violation_records.id', 'DESC')->take(5)
                                ->having('TOTALPOIN', ">=", 50 )
                                ->get();
        }
        
        return $siswa;
    }

    public function showStudentIncompleteness($iduser, $selected_student, $tahun_ajaran)
    {
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $kelas_guru = Grade::where('STAFFS_ID', $iduser)->first()->id;            
            
            $siswa = GradeStudent::where('GRADES_ID', $kelas_guru)->where('ACADEMIC_YEAR_ID', $selected_student)->get();
            
            $arr_siswa = [];                                
            foreach($siswa as $s){
                array_push($arr_siswa, $s->STUDENTS_ID);
            }
            
            $ketidaktuntasan = ViolationRecord::join('violations','violation_records.VIOLATIONS_ID','=','violations.id')
                                            ->join('students', 'violation_records.STUDENTS_ID', 'students.id')                           
                                            ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                            ->join('grades', 'grades.id', 'grades_students.GRADES_ID')
                                            ->select('violation_records.*', 'grades.NAME AS NAMAKELAS')
                                            ->where('violations.NAME','TTS')
                                            ->whereIn('violation_records.STUDENTS_ID', $arr_siswa)
                                            ->where('violation_records.ACADEMIC_YEAR_ID', $tahun_ajaran)
                                            ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                            ->orderBy('violation_records.id', 'DESC')->take(5)
                                            ->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $ketidaktuntasan = ViolationRecord::join('violations','violation_records.VIOLATIONS_ID','=','violations.id')
                                            ->join('students', 'violation_records.STUDENTS_ID', 'students.id')                           
                                            ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                            ->join('grades', 'grades.id', 'grades_students.GRADES_ID')
                                            ->select('violation_records.*', 'grades.NAME AS NAMAKELAS')
                                            ->where('violations.NAME','TTS')
                                            ->where('violation_records.ACADEMIC_YEAR_ID', $tahun_ajaran)
                                            ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                            ->orderBy('violation_records.id', 'DESC')->take(5)
                                            ->get();
        }        

        return $ketidaktuntasan;
    }

    public function myIncompleteness($idsiswa)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        $ketidaktuntasan = ViolationRecord::join('violations','violation_records.VIOLATIONS_ID','=','violations.id')
                                                ->select('violation_records.*')
                                                ->where('violations.NAME','TTS')
                                                ->where('violation_records.STUDENTS_ID', $idsiswa)
                                                ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                                ->orderBy('violation_records.id', 'DESC')->take(5)
                                                ->get();

        return $ketidaktuntasan;                            
    }
    
    public function studentAchievements($iduser, $tahun_ajaran)
    {
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;

            $kelas_guru = Grade::where('STAFFS_ID', $iduser)->first()->id;
            
            $siswa = GradeStudent::where('GRADES_ID', $kelas_guru)->where('ACADEMIC_YEAR_ID', $selected_student)->get();
                    
            $arr_siswa = [];                                
            foreach($siswa as $s){
                array_push($arr_siswa, $s->STUDENTS_ID);
            }

            $penghargaan_siswa = AchievementRecord::join('achievements', 'achievement_records.ACHIEVEMENTS_ID', 'achievements.id')
                                                ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')                           
                                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                                ->join('grades', 'grades.id', 'grades_students.GRADES_ID')
                                                ->select('achievement_records.*', 'grades.NAME AS NAMAKELAS',
                                                         DB::raw('COUNT(*) AS BANYAKPENGHARGAAN'),
                                                         DB::raw('SUM(POINT) AS POINPENGHARGAAN'))
                                                ->whereIn('achievement_records.STUDENTS_ID', $arr_siswa)
                                                ->where('achievement_records.ACADEMIC_YEAR_ID', $tahun_ajaran)
                                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                                ->groupBy('achievement_records.STUDENTS_ID')
                                                ->orderBy('achievement_records.id', 'DESC')->take(5)
                                                ->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $penghargaan_siswa = AchievementRecord::join('achievements', 'achievement_records.ACHIEVEMENTS_ID', 'achievements.id')
                                                ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')                           
                                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                                ->join('grades', 'grades.id', 'grades_students.GRADES_ID')
                                                ->select('achievement_records.*', 'grades.NAME AS NAMAKELAS',
                                                         DB::raw('COUNT(*) AS BANYAKPENGHARGAAN'),
                                                         DB::raw('SUM(POINT) AS POINPENGHARGAAN'))
                                                ->where('achievement_records.ACADEMIC_YEAR_ID', $tahun_ajaran)
                                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                                ->groupBy('achievement_records.STUDENTS_ID')
                                                ->orderBy('achievement_records.id', 'DESC')->take(5)
                                                ->get();
        }

        return $penghargaan_siswa;
    }

    public function myAchievement($idsiswa, $tahun_ajaran)
    {
        
        $penghargaan_siswa = AchievementRecord::join('achievements', 'achievement_records.ACHIEVEMENTS_ID', 'achievements.id')
                                            ->select('achievement_records.*', DB::raw('COUNT(*) AS BANYAKPENGHARGAAN'),
                                                    DB::raw('SUM(POINT) AS POINPENGHARGAAN'))
                                            ->where('achievement_records.STUDENTS_ID', $idsiswa)
                                            ->where('achievement_records.ACADEMIC_YEAR_ID', $tahun_ajaran)
                                            ->groupBy('achievement_records.STUDENTS_ID')
                                            ->orderBy('achievement_records.id', 'DESC')->take(5)
                                            ->get();        

        return $penghargaan_siswa;                                        
    }

    public function violationListOftenOccur($iduser)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        $kategori = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                WHEN v.NAME LIKE 'TTS%' THEN 'KETIDAKTUNTASAN'
                        END) AS KATEGORI
                        FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id
                        GROUP BY KATEGORI ");

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;

            $kelas_guru = Grade::where('STAFFS_ID', $iduser)->first()->id;
            
            $siswa = GradeStudent::join('students', 'grades_students.STUDENTS_ID', 'students.id')
                                ->select('students.id')
                                ->where('grades_students.GRADES_ID', $kelas_guru)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)->get();
                    
            $arr_siswa = [];                                
            foreach($siswa as $s){
                array_push($arr_siswa, $s->id);
            }    
            
            $data = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                ->select(DB::raw('(CASE
                                            WHEN violations.NAME LIKE "R%" THEN "RINGAN"
                                            WHEN violations.NAME LIKE "B%" THEN "BERAT" 
                                            WHEN violations.NAME LIKE "SB%" THEN "SANGATBERAT"
                                            WHEN violations.NAME LIKE "TTS%" THEN "KETIDAKTUNTASAN"
                                            END) AS KATEGORI'),
                                        DB::raw('MONTH(violation_records.DATE) AS BULAN'),
                                        DB::raw('COUNT(*) AS JUMLAH'))
                                ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                ->whereIn('violation_records.STUDENTS_ID', $arr_siswa)
                                ->groupBy('KATEGORI')->groupBy('BULAN')
                                ->orderBy('BULAN', 'ASC')->get();

        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $data = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                ->select(DB::raw('(CASE
                                            WHEN violations.NAME LIKE "R%" THEN "RINGAN"
                                            WHEN violations.NAME LIKE "B%" THEN "BERAT" 
                                            WHEN violations.NAME LIKE "SB%" THEN "SANGATBERAT"
                                            WHEN violations.NAME LIKE "TTS%" THEN "KETIDAKTUNTASAN"
                                            END) AS KATEGORI'),
                                        DB::raw('MONTH(violation_records.DATE) AS BULAN'),
                                        DB::raw('COUNT(*) AS JUMLAH'))
                                ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                ->groupBy('KATEGORI')->groupBy('BULAN')
                                ->orderBy('BULAN', 'ASC')->get();
        }
    }

    public function showAbsent($iduser)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        $count_total_day_each_ay = AcademicYear::select(DB::raw('DATEDIFF(END_DATE, START_DATE) AS TOTALHARI'))
                                            ->where('id', $academic_year_id)->first()->TOTALHARI; 

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $type = Absent::select(DB::raw('TYPE AS TIPE'))->groupBy('TYPE')->get();    
    
            $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;

            $kelas_guru = Grade::where('STAFFS_ID', $iduser)->first()->id;
            
            $siswa = GradeStudent::join('students', 'grades_students.STUDENTS_ID', 'students.id')
                                ->select('students.id')
                                ->where('grades_students.GRADES_ID', $kelas_guru)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)->get();
                    
            $arr_siswa = [];                                
            foreach($siswa as $s){
                array_push($arr_siswa, $s->id);
            }
        
            $data = Absent::select(DB::raw('TYPE AS TIPE'), DB::raw('ACADEMIC_YEAR_ID AS TAHUNAJARAN'), DB::raw('COUNT(*) AS JUMLAH'))                                    
                            ->where('ACADEMIC_YEAR_ID', $academic_year_id)
                            ->whereIn('STUDENTS_ID', $arr_siswa)
                            ->groupBy('TIPE', 'TAHUNAJARAN')
                            ->get();                                     
            
            $absen = Absent::where('ACADEMIC_YEAR_ID', $academic_year_id)->whereIn('STUDENTS_ID', $arr_siswa)->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $data = Absent::select(DB::raw('TYPE AS TIPE'), DB::raw('ACADEMIC_YEAR_ID AS TAHUNAJARAN'), DB::raw('COUNT(*) AS JUMLAH'))                                    
                            ->where('ACADEMIC_YEAR_ID', $academic_year_id)                            
                            ->groupBy('TIPE', 'TAHUNAJARAN')
                            ->get();      
        }       
        
        // $value["count_total_day_each_ay"] = $count_total_day_each_ay;
        // $value["type"] = $type;
        $value["data"] = $data;        
        
        return $value;
    }

    public function showAbsentKu($idsiswa)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        $count_total_day_each_ay = AcademicYear::select(DB::raw('DATEDIFF(END_DATE, START_DATE) AS TOTALHARI'))
                                            ->where('id', $academic_year_id)->first()->TOTALHARI; 

        $type = Absent::select(DB::raw('TYPE AS TIPE'))
                            ->groupBy('TIPE')
                            ->get();
            
        $data = Absent::select(DB::raw('TYPE AS TIPE'), DB::raw('ACADEMIC_YEAR_ID AS TAHUNAJARAN'), DB::raw('COUNT(*) AS JUMLAH'))
                            ->where('ACADEMIC_YEAR_ID', $academic_year_id)
                            ->where('STUDENTS_ID', $idsiswa)                                    
                            ->groupBy('TIPE', 'TAHUNAJARAN')
                            ->get();   
        
        $ketidakhadiran = Absent::select(DB::raw('SUM(TYPE) AS JUMLAHKETIDAKHADIRAN'))
                                ->where('ACADEMIC_YEAR_ID', $academic_year_id)
                                ->where('STUDENTS_ID', $idsiswa)
                                ->first()->JUMLAHKETIDAKHADIRAN;
        
        $kehadiran = (($count_total_day_each_ay - $ketidakhadiran) / $count_total_day_each_ay) * 100; 
        
        // $value["count_total_day_each_ay"] = $count_total_day_each_ay;
        // $value["type"] = $type;        
            
        $value["data"] = $data;
        $value["kehadiran"] = $kehadiran;
        
        return $value;
    }
}

