<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViolationRecord;
use App\Staff;
use App\Student;
use App\Violation;
use App\AcademicYear;
use App\Grade;
use App\GradeStudent;
use Auth;
use DB;
use Carbon\Carbon;

class ViolationRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pelanggaran = Violation::all();
        $tahun_ajaran = AcademicYear::all();
        
        // UNTUK CEK REQUEST  DARI VIEW 

        $maxId = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id; 
                               
        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;
        }
        else{
            $academic_year_id = $maxId;
        }

        $catatan_pelanggaran = $this->showViolation($request->session()->get('session_user_id'), $academic_year_id);
        
        // UNTUK GRAFIK

        $kategori = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                        WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                        WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                END) AS KATEGORI
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id
                                WHERE v.NAME NOT LIKE 'TTS%'
                                GROUP BY KATEGORI ");

        $selected_tahun_ajaran = AcademicYear::select(DB::raw('MONTH(START_DATE) AS STARTMONTH'), 
                                                          DB::raw('MONTH(END_DATE) AS ENDMONTH'))                                            
                                ->where('id', $academic_year_id)
                                ->get()[0];
                                 
    
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;    

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))
                                ->first()->id; 

            $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                             WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                             WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        END) AS KATEGORI, MONTH(vr.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id 
                                INNER JOIN students s ON vr.STUDENTS_ID = s.id  
                                INNER JOIN grades_students gs ON gs.STUDENTS_ID = s.id                                          
                                WHERE vr.ACADEMIC_YEAR_ID = " . $academic_year_id . "  AND v.NAME NOT LIKE 'TTS%' AND gs.GRADES_ID = " . $kelas_guru . "  AND gs.ACADEMIC_YEAR_ID = ". $selected_student ." 
                                GROUP BY KATEGORI, BULAN
                                ORDER BY BULAN ASC");
        }       
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                             WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                             WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        END) AS KATEGORI, MONTH(vr.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id  
                                INNER JOIN students s ON vr.STUDENTS_ID = s.id  
                                INNER JOIN grades_students gs ON gs.STUDENTS_ID = s.id                                          
                                WHERE vr.ACADEMIC_YEAR_ID = " . $academic_year_id . "  AND v.NAME NOT LIKE 'TTS%' AND gs.ACADEMIC_YEAR_ID = ". $selected_student ."                     
                                GROUP BY KATEGORI, BULAN
                                ORDER BY BULAN ASC");
        }             
        elseif(Auth::guard('web')->user()->staff->ROLE == "ADVISOR"){                
            $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                             WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                             WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        END) AS KATEGORI, MONTH(vr.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id                       
                                INNER JOIN students s ON vr.STUDENTS_ID = s.id  
                                INNER JOIN grades_students gs ON gs.STUDENTS_ID = s.id                                          
                                WHERE vr.ACADEMIC_YEAR_ID = " . $academic_year_id . "  AND v.NAME NOT LIKE 'TTS%' AND gs.ACADEMIC_YEAR_ID = ". $selected_student ."                     
                                GROUP BY KATEGORI, BULAN
                                ORDER BY BULAN ASC");
        }                    
        else{
            $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                             WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                             WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        END) AS KATEGORI, MONTH(vr.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id                       
                                INNER JOIN students s ON vr.STUDENTS_ID = s.id  
                                INNER JOIN grades_students gs ON gs.STUDENTS_ID = s.id                                          
                                WHERE vr.ACADEMIC_YEAR_ID = " . $academic_year_id . "  AND v.NAME NOT LIKE 'TTS%' AND gs.ACADEMIC_YEAR_ID = ". $selected_student ."                     
                                GROUP BY KATEGORI, BULAN
                                ORDER BY BULAN ASC");            
        }
                
        return view('violationrecord.index', compact('catatan_pelanggaran', 'tahun_ajaran', 'pelanggaran', 'academic_year_id', 'kategori', 'data', 'selected_tahun_ajaran'));
    }

    public function showViolation($user_id, $ay)
    {
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   
    
        $r = Violation::select('id')->where('NAME', 'LIKE', 'R%')->get();
        $b = Violation::select('id')->where('NAME', 'LIKE', 'B%')->get();
        $sb = Violation::select('id')->where('NAME', 'LIKE', 'SB%')->get();
                
        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $user_id)->first()->id; 
            
            $pelanggaran = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                        ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('violation_records.*', 
                                                DB::raw('COUNT(*) AS JUMLAHPELANGGARAN'), 
                                                DB::raw('SUM(violation_records.TOTAL) AS POINPELANGGARAN'))
                                        ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('violation_records.ACADEMIC_YEAR_ID', $ay)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->groupBy('violation_records.STUDENTS_ID')
                                        ->orderBy('violation_records.id', 'DESC')
                                        ->get();    

            $count_r = $this->countViolationPerCategory($r, $ay, $kelas_guru, $selected_student)->first()->JMLH;
            $count_b = $this->countViolationPerCategory($b, $ay, $kelas_guru, $selected_student)->first()->JMLH;
            $count_sb = $this->countViolationPerCategory($sb, $ay, $kelas_guru, $selected_student)->first()->JMLH;
            
            $count_violation_list = Violation::select(DB::raw('COUNT(*) AS JUMLAH'))->where('NAME', 'NOT LIKE', 'TTS%')->first()->JUMLAH;
            
            $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                             WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                             WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        END) AS KATEGORI, 
                                COUNT(*) AS JUMLAH,
                                (SELECT 
                                    (CASE 
                                        WHEN KATEGORI = 'RINGAN' THEN ROUND( $count_r / $count_violation_list * 100) 
                                        WHEN KATEGORI = 'BERAT' THEN ROUND( $count_b / $count_violation_list * 100) 
                                        WHEN KATEGORI = 'SANGATBERAT' THEN ROUND( $count_sb / $count_violation_list * 100) 
                                    END)) 
                                AS PERSENTASE
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id 
                                INNER JOIN students s ON vr.STUDENTS_ID = s.id  
                                INNER JOIN grades_students gs ON gs.STUDENTS_ID = s.id                                          
                                WHERE vr.ACADEMIC_YEAR_ID = " . $ay . "  AND v.NAME NOT LIKE 'TTS%' AND gs.GRADES_ID = " . $kelas_guru . "  AND gs.ACADEMIC_YEAR_ID = ". $selected_student ." 
                                GROUP BY KATEGORI
                                ORDER BY KATEGORI DESC");       
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $pelanggaran = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                        ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('violation_records.*',
                                                DB::raw('COUNT(*) AS JUMLAHPELANGGARAN'), 
                                                DB::raw('SUM(violation_records.TOTAL) AS POINPELANGGARAN'))
                                        ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                        ->where('violation_records.ACADEMIC_YEAR_ID', $ay)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->groupBy('violation_records.STUDENTS_ID')
                                        ->orderBy('violation_records.id', 'DESC')
                                        ->get();                                                          

            $count_r = $this->countViolationPerCategoryKepsek($r, $ay, $selected_student)->first()->JMLH;
            $count_b = $this->countViolationPerCategoryKepsek($b, $ay, $selected_student)->first()->JMLH;
            $count_sb = $this->countViolationPerCategoryKepsek($sb, $ay, $selected_student)->first()->JMLH;

            $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                        WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                        WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                   END) AS KATEGORI, 
                                COUNT(*) AS JUMLAH,
                                (SELECT 
                                    (CASE 
                                        WHEN KATEGORI = 'RINGAN' THEN ROUND( $count_r / (SELECT COUNT(*) FROM violations WHERE violations.NAME LIKE 'R%') * 100) 
                                        WHEN KATEGORI = 'BERAT' THEN ROUND( $count_b / (SELECT COUNT(*) FROM violations WHERE violations.NAME LIKE 'B%') * 100) 
                                        WHEN KATEGORI = 'SANGATBERAT' THEN ROUND( $count_sb / (SELECT COUNT(*) FROM violations WHERE violations.NAME LIKE 'S%') * 100) 
                                    END)) 
                                AS PERSENTASE
                                FROM violation_records vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id 
                                INNER JOIN students s ON vr.STUDENTS_ID = s.id  
                                INNER JOIN grades_students gs ON gs.STUDENTS_ID = s.id                                          
                                WHERE vr.ACADEMIC_YEAR_ID = " . $ay . "  AND v.NAME NOT LIKE 'TTS%' AND gs.ACADEMIC_YEAR_ID = ". $selected_student ." 
                                GROUP BY KATEGORI
                                ORDER BY KATEGORI DESC");       
                        
        }
        else{
            $pelanggaran = ViolationRecord::where('violation_records.ACADEMIC_YEAR_ID', $ay)->orderBy('violation_records.id', 'DESC')->get();
        }
        
        
        $value["pelanggaran"] = $pelanggaran;
        $value["data"] = $data;
        return $value;  
    }

    public function countViolationPerCategory($array, $ay, $gsid, $gsay)
    {
        $count = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                            ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                            ->join('grades_students', 'grades_students.STUDENTS_ID', 'students.id')
                            ->select(DB::raw('COUNT(*) AS JMLH'))
                            ->whereIn('violation_records.VIOLATIONS_ID', $array)
                            ->where('violation_records.ACADEMIC_YEAR_ID', $ay)
                            ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                            ->where('grades_students.GRADES_ID', $gsid)
                            ->where('grades_students.ACADEMIC_YEAR_ID', $gsay)
                            ->get();

        return $count;
    }

    public function countViolationPerCategoryKepsek($array, $ay, $gsay)
    {
        $count = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                            ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                            ->join('grades_students', 'grades_students.STUDENTS_ID', 'students.id')
                            ->select(DB::raw('COUNT(*) AS JMLH'))
                            ->whereIn('violation_records.VIOLATIONS_ID', $array)
                            ->where('violation_records.ACADEMIC_YEAR_ID', $ay)
                            ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                            ->where('grades_students.ACADEMIC_YEAR_ID', $gsay)
                            ->get();

        return $count;
    }

    public function create(Request $request)
    {
        $pelanggaran = Violation::where('NAME', 'NOT LIKE', 'TTS%')->get();    
        $kelas = Grade::all();
                    
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if($request->has('gradeId')){
            $default_student = GradeStudent::where('GRADES_ID', $request->gradeId)
                                        ->where('ACADEMIC_YEAR_ID', $selected_student)                            
                                        ->get();
        }        
        else{
            $default_student = GradeStudent::where('GRADES_ID', 1)->where('ACADEMIC_YEAR_ID', $selected_student) ->get();
        }
        
        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){ 
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id; 

            $siswa = GradeStudent::where('GRADES_ID', $kelas_guru)->where('ACADEMIC_YEAR_ID', $selected_student)->get();
        }  
        elseif(Auth::guard('web')->user()->staff->ROLE == "ADVISOR"){                
            $siswa = $default_student;
        }
        else{
            $siswa = $default_student;
        }

        return view('violationrecord.create', compact('siswa', 'kelas', 'pelanggaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'vr_date' => 'required',
            'vr_desc' => 'required',
            'vr_punishment' => 'required',
            'vr_student_name' => 'required',
            'vr_violation_name' => 'required',
        ]);
        
        $tahun_ajaran = DB::select('SELECT *
                                    FROM `academic_years`
                                    WHERE id = (SELECT MAX(id) as id 
                                                FROM academic_years)');

        $pelanggaran = Violation::all();
        
        $v_id = $request->get('vr_violation_name');


        $date = $request->get('vr_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);

        foreach($pelanggaran as $p)
        {
            $point = 0;
            $total = 0;
            $total_point = 0;

            $id_p = $p->id;

            if($v_id == $p->id)
            {        
                $point = $p->POINT;
                $total_point = $total + $point;
                              
                if($check == false)
                {
                    return redirect(action('ViolationRecordController@create'))->with('error', 
                    'Input tanggal ' . $request->get('vr_date') . 
                    ' tidak sesuai dengan tahun ajaran yang berlaku (' . $session_start_ay . ' s.d ' . $session_end_ay . ')' );
                }
                else
                {
                    $catatan_pelanggaran = new ViolationRecord([
                        'DATE' => $request->get('vr_date'),
                        'TOTAL' => $total_point,
                        'DESCRIPTION' => $request->get('vr_desc'),
                        'PUNISHMENT' => $request->get('vr_punishment'),
                        'STUDENTS_ID' => $request->get('vr_student_name'),
                        'VIOLATIONS_ID' => $v_id,
                        'ACADEMIC_YEAR_ID' => $request->session()->get('session_academic_year_id'),
                        'STAFFS_ID' => $request->session()->get('session_user_id')
                    ]);

                    $catatan_pelanggaran->save();
                    return redirect('violationrecord')->with('sukses', 'Catatan pelanggaran baru berhasil dibuat');
                }                
            }            
        }           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $catatan_pelanggaran = ViolationRecord::find($id);
        $pelanggaran = Violation::where('NAME', 'NOT LIKE', 'TTS%')->get();
        $kelas = Grade::all();            

        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if($request->has('gradeId')){
            $default_student = GradeStudent::where('GRADES_ID', $request->gradeId)
                                ->where('ACADEMIC_YEAR_ID', $selected_student)                            
                                ->get();
        }        
        else{
            $default_student = GradeStudent::where('GRADES_ID', 1)->where('ACADEMIC_YEAR_ID', $selected_student) ->get();
        }
        
        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){ 
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id; 

            $siswa = GradeStudent::where('GRADES_ID', $kelas_guru)->where('ACADEMIC_YEAR_ID', $selected_student)->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "ADVISOR"){                
            $siswa = $default_student;
        }
        else{
            $siswa = $default_student;
        }
        
        return view('violationrecord.edit', compact('catatan_pelanggaran', 'kelas', 'siswa', 'pelanggaran'));
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
        $request->validate([
            'vr_date' => 'required',
            'vr_desc' => 'required',
            'vr_punishment' => 'required',
            'vr_student_name' => 'required',
            'vr_violation_name' => 'required',
        ]);
        
        $catatan_pelanggaran = ViolationRecord::find($id);

        $pelanggaran = Violation::all();
        
        $v_id = $request->get('vr_violation_name');
        
        $date = $request->get('vr_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);
        
        foreach($pelanggaran as $p)
        {
            $point = 0;
            $total = 0;
            $total_point = 0;

            $id_p = $p->id;

            if($v_id == $p->id)
            {
                $point = $p->POINT;
                $total_point = $total + $point;

                if($check == false)
                {
                    return redirect(action('ViolationRecordController@edit', $catatan_pelanggaran->id))->with('error', 
                    'Input tanggal ' . $request->get('vr_date') . 
                    ' tidak sesuai dengan tahun ajaran yang berlaku (' . $session_start_ay . 's.d' . $session_end_ay . ')' );
                }
                else
                {
                    $catatan_pelanggaran->DATE = $request->get('vr_date');
                    $catatan_pelanggaran->TOTAL = $total_point;
                    $catatan_pelanggaran->DESCRIPTION = $request->get('vr_desc');
                    $catatan_pelanggaran->PUNISHMENT = $request->get('vr_punishment');
                    $catatan_pelanggaran->STUDENTS_ID = $request->get('vr_student_name');
                    $catatan_pelanggaran->VIOLATIONS_ID = $request->get('vr_violation_name');
                    $catatan_pelanggaran->ACADEMIC_YEAR_ID = $request->session()->get('session_academic_year_id');
                    $catatan_pelanggaran->STAFFS_ID = $request->session()->get('session_user_id');
                }

                $catatan_pelanggaran->save();
                return redirect(action('ViolationRecordController@index', $catatan_pelanggaran->id))->with('sukses', 'Catatan pelanggaran berhasil diubah');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catatan_pelanggaran = ViolationRecord::whereId($id)->firstOrFail();
        $catatan_pelanggaran->delete();
        return redirect(action('ViolationRecordController@index'))->with('sukses', 'Catatan pelanggaran berhasil dihapus');
    }
    
    public function ajaxChangeViolationRecord(Request $request)
    {        
        $ajaxPelanggaran = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')                                       
                                        ->select('violation_records.*', 'violations.*')
                                        ->where('violation_records.ACADEMIC_YEAR_ID', $request->academicYearId)
                                        ->where('violation_records.STUDENTS_ID', $request->studentId)
                                        ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                        ->orderBy('violation_records.DATE', 'DESC')
                                        ->get();

        return $ajaxPelanggaran;
    }

    
}
