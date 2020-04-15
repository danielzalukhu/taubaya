<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\AchievementRecord;
use App\ViolationRecord;
use App\Subject;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_siswa = $this->countStudent()->siswa;
        $jumlah_penghargaan = $this->countAchievement()->penghargaan;
        $jumlah_pelanggaran = $this->countViolation()->pelanggaran;
        $siswa_bermasalah = ViolationRecord::orderBy('id', 'DESC')->take(5)->get();

        return view('dashboard.index', compact('jumlah_siswa', 'jumlah_penghargaan', 'jumlah_pelanggaran', 'siswa_bermasalah'));
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

    public function troubleStudent()
    {
        
    }

    // public function getTroubleStudent()
    // {
    //     $siswa = DB::select('SELECT STUDENTS_ID AS IDSISWA
    //                          FROM violationrecords
    //                          GROUP BY STUDENTS_ID
    //                          HAVING SUM(TOTAL) >= "50"');
    //     //dd($siswa);
    //     return view('dashboard.index', compact('siswa'));
    // }
}

