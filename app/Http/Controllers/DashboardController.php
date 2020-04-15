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
        // dd($tahun_ajaran[0]->id);
        $request->session()->put('session_academic_year_id', $tahun_ajaran[0]->id);
        // $request->session()->put('session_user_id', Auth::guard('web')->user()->name);
        // if($request->session()->has('session_user_id'))
        //     echo $request->session()->get('session_user_id');
        // else
        //     echo 'No data in the session';

        $jumlah_siswa = $this->countStudent()->siswa;
        $jumlah_penghargaan = $this->countAchievement()->penghargaan;
        $jumlah_pelanggaran = $this->countViolation()->pelanggaran;
        $siswa_bermasalah = ViolationRecord::orderBy('id', 'DESC')->take(5)->get();
        // $siswa_bermasalah = $this->getTroubleStudent()->siswa;

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
        $siswa = DB::select('SELECT students.NISN, students.FNAME, students.LNAME, count(*) as BANYAKPELANGGARAN, sum(violation_records.TOTAL) as TOTALPOIN
                             FROM violation_records INNER JOIN students ON violation_records.STUDENTS_ID = students.id
                             GROUP BY students.id
                             HAVING SUM(TOTAL) >= "50"');
        //dd($siswa);
        return view('dashboard.index', compact('siswa'));
    }
}

