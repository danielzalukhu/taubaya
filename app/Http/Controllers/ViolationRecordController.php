<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViolationRecord;
use App\Staff;
use App\Student;
use App\Violation;
use App\AcademicYear;
use DB;

class ViolationRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catatan_pelanggaran = ViolationRecord::all(); 
        
        $tahun_ajaran = AcademicYear::all();
        $siswa = Student::all();
        $pelanggaran = Violation::all();
        $karyawan = Staff::all();
        
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

        $kategori = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                        WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                        WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        WHEN v.NAME LIKE 'TTS%' THEN 'KETIDAKTUNTASAN'
                                END) AS KATEGORI
                                FROM violationrecords vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id
                                GROUP BY KATEGORI ");

        $data = DB::select("SELECT (CASE WHEN v.NAME LIKE 'R%' THEN 'RINGAN'
                                        WHEN v.NAME LIKE 'B%' THEN 'BERAT'
                                        WHEN v.NAME LIKE 'SB%' THEN 'SANGATBERAT'
                                        WHEN v.NAME LIKE 'TTS%' THEN 'KETIDAKTUNTASAN'
                                END) AS KATEGORI, MONTH(vr.DATE) AS BULAN , COUNT(*) AS JUMLAH 
                                FROM violationrecords vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id 
                                WHERE ACADEMIC_YEAR_ID = " . $academic_year_id . "
                                GROUP BY KATEGORI, BULAN
                                ORDER BY BULAN ASC");

        $selected_tahun_ajaran = DB::select("SELECT MONTH(START_DATE) AS STARTMONTH, MONTH(END_DATE) AS ENDMONTH
                                             FROM academic_years
                                             WHERE id = " . $academic_year_id )[0];

        // -----------------------------------
        return view('violationrecord.index', compact('catatan_pelanggaran', 'tahun_ajaran', 'siswa', 'pelanggaran', 'karyawan', 'academic_year_id', 'kategori', 'data', 'selected_tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('violationrecord.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // $s_id = $request->get('vr_student_name');
        // $point_record = DB::select('SELECT SUM(vr.TOTAL) as pointRecord
        //                      FROM violationrecords as vr 
        //                      WHERE vr.STUDENTS_ID = ' . $s_id);
        // echo json_encode($point_record);
        
        $pelanggaran = Violation::all();
        $v_id = $request->get('vr_violation_name');
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
                
                $catatan_pelanggaran = new ViolationRecord([
                    'DATE' => $request->get('vr_date'),
                    'TOTAL' => $total_point,
                    'DESCRIPTION' => $request->get('vr_desc'),
                    'PUNISHMENT' => $request->get('vr_punishment'),
                    'STUDENTS_ID' => $request->get('vr_student_name'),
                    'VIOLATIONS_ID' => $v_id,
                    'ACADEMIC_YEAR_ID' => $request->get('vr_academic_year'),
                    'STAFFS_ID' => $request->get('vr_noted_by')
                ]);
            }
        }

        //dd($request->all());
        $catatan_pelanggaran->save();
        return redirect('violationrecord')->with('sukses', 'Record Violation has been created');
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
        $catatan_pelanggaran = ViolationRecord::find($id);
        
        $tahun_ajaran = AcademicYear::all();
        $siswa = Student::all();
        $pelanggaran = Violation::all();
        $karyawan = Staff::all();

        return view('violationrecord.edit', compact('catatan_pelanggaran', 'tahun_ajaran', 'siswa', 'pelanggaran', 'karyawan'));
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
        $catatan_pelanggaran = ViolationRecord::find($id);
        
        $catatan_pelanggaran->DATE = $request->get('vr_date');
        $catatan_pelanggaran->DESCRIPTION = $request->get('vr_desc');
        $catatan_pelanggaran->PUNISHMENT = $request->get('vr_punishment');
        $catatan_pelanggaran->STUDENTS_ID = $request->get('vr_student_name');
        $catatan_pelanggaran->VIOLATIONS_ID = $request->get('vr_violation_name');
        $catatan_pelanggaran->ACADEMIC_YEAR_ID = $request->get('vr_academic_year');
        $catatan_pelanggaran->STAFFS_ID = $request->get('vr_noted_by');

        $catatan_pelanggaran->save();

        return redirect(action('ViolationRecordController@index', $catatan_pelanggaran->id))->with('sukses', 'Violation Record has been chaged');
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
        return redirect(action('ViolationRecordController@index'))->with('sukses', 'Violation Record has been deleted');
    }
    
    public function ajaxChangeViolationRecord(Request $request)
    {
        $ajaxPelanggaran = DB::select('SELECT vr.DATE, v.NAME, v.DESCRIPTION, vr.TOTAL
                                       FROM violationrecords vr INNER JOIN violations v ON vr.VIOLATIONS_ID = v.id
                                       WHERE vr.ACADEMIC_YEAR_ID = ' . $request->academicYearId . ' AND  vr.STUDENTS_ID = "' . $request->studentId .'"');

        return $ajaxPelanggaran;
    }

    
}
