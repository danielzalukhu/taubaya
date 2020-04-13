<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Absent;
use App\ViolationRecord;
use App\AcademicYear;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Student::all();
                               
        return view('student.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Student::whereId($id)->firstOrFail();
        $siswa->delete();
        return redirect(action('StudentController@index'))->with('sukses', 'Student has been deleted');
    }

    public function profile(Request $request, $id)
    {
        $siswa = Student::find($id);

        // LEFT COLOMN DATA
        $absen = DB::select('SELECT *
                            FROM absents 
                            WHERE STUDENTS_ID = ' . $id .' 
                            ORDER BY START_DATE, END_DATE ASC');

        $catatan_absen = DB::select('SELECT TYPE, COUNT(TYPE) as TOTAL			
                                     FROM absents 
                                     WHERE STUDENTS_ID = ' . $id . ' AND ACADEMIC_YEAR_ID = (SELECT MIN(id) FROM academic_years)
                                     GROUP BY TYPE');  

        // RIGHT COLOMN DATA
        $tahun_ajaran = AcademicYear::all();

        $catatan_pelanggaran = DB::select('SELECT *
                                        FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id
                                        WHERE STUDENTS_ID = '. $id);

        $point = DB::select('SELECT SUM(TOTAL) as point
                            FROM violation_records
                            WHERE STUDENTS_ID = ' . $id);

        for($i = 0; $i < count($point); $i++){
            $point_record = $point[$i]->point; 
        } 

        $achievement_point = DB::select('SELECT POINT
                                         FROM achievement_records JOIN achievements on achievements.id = achievement_records.ACHIEVEMENTS_ID 
                                         WHERE STUDENTS_ID = ' . $id);
        
        $total_achievement_point = 0;
        
        for($i = 0; $i < count($achievement_point); $i++){
            $total_achievement_point = $achievement_point[$i]->POINT; 
        } 

        $catatan_penghargaan = DB::select('SELECT *
                                        FROM achievement_records JOIN achievements on achievements.id = achievement_records.ACHIEVEMENTS_ID 
                                        WHERE STUDENTS_ID = ' . $id);

        // GRAFIK TAB VIOLATION

        $academic_year_id = 0;
        $maxId = DB::select('SELECT max(id) as id
                             FROM academic_years')[0]->id;

        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;
        }
        else{
            $academic_year_id = $maxId;
        }

        $kategori = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                        WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                        WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        WHEN v.NAME LIKE 'TTS%' THEN 'KETIDAKTUNTASAN'
                                END) AS KATEGORI
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id
                                GROUP BY KATEGORI ");

        $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                    WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                    WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                    WHEN v.NAME LIKE 'TTS%' THEN 'KETIDAKTUNTASAN'
                            END) AS KATEGORI, MONTH(vr.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                            FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id 
                            WHERE ACADEMIC_YEAR_ID = " . $academic_year_id . " AND STUDENTS_ID = " . $id . "
                            GROUP BY KATEGORI, BULAN
                            ORDER BY BULAN ASC");

        $selected_tahun_ajaran = DB::select("SELECT MONTH(START_DATE) AS STARTMONTH, MONTH(END_DATE) AS ENDMONTH
                                             FROM academic_years
                                             WHERE id = " . $academic_year_id . " ")[0];

        // GRAFIK TAB ACHIEVEMENT

        $type = DB::select("SELECT a.TYPE as TIPE
                                FROM achievements a
                                GROUP BY TIPE");
        
        $dataAchievement = DB::select("SELECT a.TYPE AS TIPE, MONTH(ass.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                                       FROM achievements a INNER JOIN achievement_records ass ON a.id = ass.ACHIEVEMENTS_ID
                                       WHERE ACADEMIC_YEAR_ID = " . $academic_year_id ."  AND STUDENTS_ID = " . $id . "
                                       GROUP BY TIPE, BULAN
                                       ORDER BY BULAN ASC");    
                                        
        // GRAFIK TAB ABSENT 
        
        $tipeAbsen = DB::select("SELECT TYPE AS TIPE
                            FROM absents 
                            GROUP BY TYPE");

        $dataAbsen = DB::select("SELECT a.TYPE AS TIPE, YEAR(a.START_DATE) AS TAHUN, COUNT(*) AS JUMLAH
                                 FROM absents a
                                 WHERE a.STUDENTS_ID = " . $id . "
                                 GROUP BY TIPE, TAHUN");

        // $selected_tahun_absen = DB::select("SELECT YEAR(THNKECIL) AS TAHUNTERKECIL, YEAR(THNBESAR) AS TAHUNTERBESAR
        //                              FROM (
        //                                     SELECT MIN(a.START_DATE) AS THNKECIL, MAX(a.START_DATE) AS THNBESAR
        //                                     FROM absents a ) AS INNERTABLE"
        //                                    )[0];
    
        return view('student.profile', compact('siswa', 'absen', 'catatan_absen', 'catatan_pelanggaran', 'tahun_ajaran', 'point_record',
                    'catatan_penghargaan', 'total_achievement_point',
                    'kategori', 'data', 'selected_tahun_ajaran', 'academic_year_id',
                    'type', 'dataAchievement',
                    'tipeAbsen', 'dataAbsen'));
    }

    public function showDetailAbsent(Request $request)
    {
        $absen = DB::select('SELECT TYPE, START_DATE, END_DATE, DESCRIPTION
                             FROM absents
                             WHERE STUDENTS_ID = ' . $request->studentId . ' AND TYPE = "' . $request->absentType .'"' );

        return $absen;                               
    }

    public function returnDataAchievementChart(Request $request)
    {
        $type = DB::select("SELECT a.TYPE as TIPE
                                FROM achievements a
                                GROUP BY TIPE");
        
        $dataAchievement = DB::select("SELECT a.TYPE AS TIPE, MONTH(ass.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                            FROM achievements a INNER JOIN achievement_records ass ON a.id = ass.ACHIEVEMENTS_ID
                            WHERE ACADEMIC_YEAR_ID = " . $request->academicYearId ."  AND STUDENTS_ID = " . $request->studentId . "
                            GROUP BY TIPE, BULAN
                            ORDER BY BULAN ASC");    
        
        $selected_tahun_ajaran = DB::select("SELECT MONTH(START_DATE) AS STARTMONTH, MONTH(END_DATE) AS ENDMONTH
                            FROM academic_years
                            WHERE id = " . $request->academicYearId . " ")[0];
        
        $data['type']=$type;
        $data['dataAchievement']=$dataAchievement;
        $data['selected_tahun_ajaran']=$selected_tahun_ajaran;

        return $data;                   
    }
}
