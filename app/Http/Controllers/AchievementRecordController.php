<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AchievementRecord;
use App\Staff;
use App\Student;
use App\Achievement;
use App\AcademicYear;
use DB;
use Carbon\Carbon;

class AchievementRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catatan_penghargaan = AchievementRecord::all(); 
        
        $siswa = Student::all();
        $penghargaan = Achievement::all();
        $karyawan = Staff::all();
        $tahun_ajaran = AcademicYear::all();

        // utk grafik
        $academic_year_id = 0;
        $maxId = DB::select('SELECT max(id) as id
                                FROM academic_years')[0]->id;

        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;
        }
        else{
            $academic_year_id = $maxId;
        }

        $type = DB::select("SELECT a.GRADE as TINGKAT
                            FROM achievements a
                            GROUP BY TINGKAT");
        
        $data = DB::select("SELECT a.GRADE AS TINGKAT, MONTH(ass.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                            FROM achievements a INNER JOIN achievement_records ass ON a.id = ass.ACHIEVEMENTS_ID
                            WHERE ACADEMIC_YEAR_ID = " . $academic_year_id ." 
                            GROUP BY TINGKAT, BULAN
                            ORDER BY BULAN ASC");                             
        
        $selected_tahun_ajaran = DB::select("SELECT MONTH(START_DATE) AS STARTMONTH, MONTH(END_DATE) AS ENDMONTH
                                             FROM academic_years
                                             WHERE id = " . $academic_year_id )[0];                                           

        return view('achievementrecord.index', compact('catatan_penghargaan', 'siswa', 'penghargaan', 'karyawan', 'tahun_ajaran', 'type', 'data', 'selected_tahun_ajaran', 'academic_year_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('achivementrecord.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->get('ar_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);
        // $a = array($request_date, $start_ay, $end_ay);
        // dd($a);
        
        if($check == false)
        {
            return redirect('achievementrecord')->with('error', 'Input tanggal tidak sesuai dengan tahun ajaran yang berlaku');
        }
        else
        {
            $catatan_penghargaan = new AchievementRecord([
                'STUDENTS_ID' => $request->get('ar_student_name'),
                'ACHIEVEMENTS_ID' => $request->get('ar_achievement_name'),
                'DATE' => $request->get('ar_date'),
                'DESCRIPTION' => $request->get('ar_desc'),
                'ACADEMIC_YEAR_ID' => $request->session()->get('session_academic_year_id'),
                'STAFFS_ID' => $request->session()->get('session_user_id')
            ]);
        }

        // dd($request->all());
        $catatan_penghargaan->save();
        return redirect('achievementrecord')->with('sukses', 'New achivement record has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catatan_penghargaan = AchievementRecord::find($id);
        
        $siswa = Student::all();
        $penghargaan = Achievement::all();
        $karyawan = Staff::all();
        $tahun_ajaran = AcademicYear::all();
        //return 'helo';
        return view('achievementrecord.edit', compact('catatan_penghargaan', 'siswa', 'penghargaan', 'karyawan', 'tahun_ajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $catatan_penghargaan = AchievementRecord::find($id);

        $date = $request->get('ar_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);

        if($check == false)
        {
            return redirect(action('AchievementRecordController@edit', $catatan_penghargaan->id))->with('error', 'Input tanggal tidak sesuai dengan tahun ajaran yang berlaku');
        }
        else
        {                                
            $catatan_penghargaan->STUDENTS_ID = $request->get('ar_student_name');
            $catatan_penghargaan->ACHIEVEMENTS_ID = $request->get('ar_achievement_name');
            $catatan_penghargaan->DATE = $request->get('ar_date');
            $catatan_penghargaan->DESCRIPTION = $request->get('ar_desc');
            $catatan_penghargaan->ACADEMIC_YEAR_ID = $request->session()->get('session_academic_year_id');
            $catatan_penghargaan->STAFFS_ID = $request->session()->get('session_user_id');
        }
        //dd($request->all());
        $catatan_penghargaan->save();
        return redirect(action('AchievementRecordController@index', $catatan_penghargaan->id))->with('sukses', 'Achievement Record has been chaged');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catatan_penghargaan = AchievementRecord::whereId($id)->firstOrFail();
        $catatan_penghargaan->delete();
        return redirect(action('AchievementRecordController@index'))->with('sukses', 'Achievement Record has been deleted');
    }

    public function ajaxChangeAchievementRecord(Request $request)
    {
        $ajaxPenghargaan = DB::select('SELECT ass.DATE, a.TYPE, ass.DESCRIPTION, a.POINT
                                       FROM achievement_records ass INNER JOIN achievements a ON ass.ACHIEVEMENTS_ID = a.id
                                       WHERE ass.ACADEMIC_YEAR_ID = ' . $request->academicYearId . ' AND  ass.STUDENTS_ID = "' . $request->studentId .'"');    

        return $ajaxPenghargaan;
    }
}
