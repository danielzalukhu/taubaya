<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Student;
use App\AchievementRecord;
use App\ViolationRecord;
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
            $request->session()->put('session_user_id', Auth::user()->id);
        }
        else{
            $request->session()->put('session_student_class', Auth::user()->student->grade->NAME);
            $request->session()->put('session_student_id', Auth::user()->student->id);
        }
        // dd($request->session()->get('session_student_id'));

        //END GLOBAL SESSION 

        $jumlah_siswa = $this->countStudent()->siswa;
        $jumlah_penghargaan = $this->countAchievement()->penghargaan;
        $jumlah_pelanggaran = $this->countViolation()->pelanggaran;
        $siswa_bermasalah = $this->getTroubleStudent()->siswa;
        

        return view('dashboard.index', compact('tahun_ajaran', 'jumlah_siswa', 'jumlah_penghargaan', 'jumlah_pelanggaran', 'siswa_bermasalah'));
    }

    public function countStudent()
    {
        $siswa = Student::all()->count();
        return view('dashboard.index', compact('siswa'));
    }

    public function countAchievement()
    {
        $penghargaan = AchievementRecord::all()->count();
        return view('dashboard.index', compact('penghargaan'));
    }

    public function countViolation()
    {
        $pelanggaran = ViolationRecord::all()->count();
        return view('dashboard.index', compact('pelanggaran'));
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

        return view('dashboard.index', compact('siswa'));
    }
}

