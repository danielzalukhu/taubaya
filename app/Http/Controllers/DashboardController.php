<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_siswa = $this->countStudent()->js;
        // $siswa_bermasalah = $this->getTroubleStudent()->siswa;                

        return view('dashboard.index', compact('jumlah_siswa'));
    }

    public function countStudent()
    {
        $siswa = DB::select('SELECT COUNT(*) as JUMLAHSISWA FROM students');
        $js = "";
        for($i = 0; $i < count($siswa); $i++)
        {
            $js = $siswa[$i]->JUMLAHSISWA;
            //echo $js;
        }
        return view('dashboard.index', compact('js'));
    }

    // public function getTroubleStudent()
    // {
    //     $siswa = DB::select('SELECT STUDENTS_ID AS IDSISWA
    //             FROM violationrecords
    //             GROUP BY STUDENTS_ID
    //             HAVING SUM(TOTAL) >= "50"');
    //     //dd($siswa);
    //     return view('dashboard.index', compact('siswa'));
    // }
}
