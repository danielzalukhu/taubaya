<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Student;
use App\AchievementRecord;
use App\ViolationRecord;
use App\Grade;
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
        }
        else{
            $request->session()->put('session_student_class', Auth::user()->student->grade->NAME);
            $request->session()->put('session_student_id', Auth::user()->student->id);
        }        
        
        //END GLOBAL SESSION 
                
        $jumlah_siswa = $this->countStudent($request->session()->get('session_user_id'));
        $jumlah_penghargaan = $this->countAchievement();
        $jumlah_pelanggaran = $this->countViolation();
        $siswa_bermasalah = $this->getTroubleStudent();
        
        // dd($kelas_guru);
        return view('dashboard.index', compact('tahun_ajaran', 'jumlah_siswa', 'jumlah_penghargaan', 'jumlah_pelanggaran', 'siswa_bermasalah'));
    }

    public function countStudent($user_id)
    {
        if(Auth::guard('web')->user()->staff->ROLE === "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $user_id)
                                    ->first()->id; 
            $siswa = Student::select(DB::raw('COUNT(*) AS BANYAKSISWA'))->where('GRADES_ID', $kelas_guru)->first()->BANYAKSISWA;                
        }
        elseif(Auth::guard('web')->user()->staff->ROLE === "HEADMASTER"){
            $siswa = Student::all()->count();               
        }
        return $siswa;
    }

    public function countAchievement()
    {
        $penghargaan = AchievementRecord::all()->count();   
        return $penghargaan;
    }

    public function countViolation()
    {
        $pelanggaran = ViolationRecord::all()->count();
        return $pelanggaran;
    }

    public function getTroubleStudent()
    {
        $siswa = ViolationRecord::join('students', 'violation_records.STUDENTS_ID', 'students.id')                           
                            ->select('students.*', 
                                     DB::raw('COUNT(*) as BANYAKPELANGGARAN'), 
                                     DB::raw('SUM(violation_records.TOTAL) as TOTALPOIN')) 
                            ->groupBy('students.id')
                            ->having('TOTALPOIN', ">=", 50 )
                            ->get();                             

        return $siswa;
    }
}

