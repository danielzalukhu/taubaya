<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\AchievementRecord;
use App\ViolationRecord;
use App\Subject;
use Session;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun_ajaran = DB::select('SELECT *
                                    FROM `academic_years`
                                    WHERE id = (SELECT MAX(id) as id 
                                                FROM academic_years)');

        $request->session()->put('session_academic_year_id', $tahun_ajaran[0]->id);

        $jumlah_siswa = $this->countStudent()->siswa;
        $jumlah_penghargaan = $this->countAchievement()->penghargaan;
        $jumlah_pelanggaran = $this->countViolation()->pelanggaran;
        $siswa_bermasalah = $this->getTroubleStudent()->siswa;
        // dd($siswa_bermasalah);

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

        //dd($siswa);
        return view('dashboard.index', compact('siswa'));
    }
}

