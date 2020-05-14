<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absent;
use App\Student;
use App\Staff;
use App\AcademicYear;
use DB;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {         
        $absen = Absent::all();  
        
        $karyawan = Staff::all();
        $siswa = Student::all();
        $tahun_ajaran = AcademicYear::all();
        
        $maxId = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;
        }
        else{
            $academic_year_id = $maxId;
        }
            
        $type = Absent::select(DB::raw('TYPE AS TIPE'))                            
                        ->groupBy('TYPE')
                        ->get();
             
        $datas = Absent::select(DB::raw('TYPE AS TIPE'), DB::raw('ACADEMIC_YEAR_ID AS TAHUNAJARAN'), DB::raw('COUNT(*) AS JUMLAH'))                                    
                             ->where('ACADEMIC_YEAR_ID', $academic_year_id)
                             ->groupBy('TIPE', 'TAHUNAJARAN')
                             ->get();                             

        return view('absent.index', compact('absen', 'karyawan', 'siswa', 'tahun_ajaran', 'type', 'datas', 'academic_year_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $absen = new Absent([
            'START_DATE' => $request->get('a_start_date'),
            'END_DATE' => $request->get('a_end_date'),
            'TYPE' => $request->get('a_type'),
            'DESCRIPTION' => $request->get('a_desc'),
            'RECEIPT_IMG' => $request->get('a_image'),
            'STUDENTS_ID' => $request->get('a_s_name'),
            'STAFFS_ID' => $request->session()->get('session_user_id')
        ]);
        
        if($request->hasFile('a_image'))
        {
            $request->file('a_image')->move('images/', $request->file('a_image')->getClientOriginalName());
            $absen->RECEIPT_IMG = $request->file('a_image')->getClientOriginalName();
            $absen->save();
        }

        $absen->save();

        return redirect('absent')->with('sukses', 'Absent has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $absen = Absent::find($id);

        $karyawan = Staff::all();
        $siswa = Student::all();

        return view('absent.edit', compact('absen', 'karyawan', 'siswa'));
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
        $absen = Absent::find($id);

        $absen->START_DATE = $request->get('a_start_date');
        $absen->END_DATE = $request->get('a_end_date');
        $absen->TYPE = $request->get('a_type');
        $absen->DESCRIPTION = $request->get('a_desc');
        $absen->RECEIPT_IMG = $request->get('a_image');
        $absen->STUDENTS_ID = $request->get('a_s_name');
        $absen->STAFFS_ID = $request->session()->get('session_user_id');

        if($request->hasFile('a_image'))
        {
            $request->file('a_image')->move('images/', $request->file('a_image')->getClientOriginalName());
            $absen->RECEIPT_IMG = $request->file('a_image')->getClientOriginalName();
            $absen->save();
        }
        
        $absen->save();

        return redirect(action('AbsentController@index', $absen->id))->with('sukses', 'Absent has been chaged');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absen = Absent::whereId($id)->firstOrFail();
        $absen->delete();
        return redirect(action('AbsentController@index'))->with('sukses', 'Absent has been deleted');
    }

    public function ajaxChangeAbsentRecord(Request $request)
    {
        $ajaxAbsen = Absent::select('TYPE', DB::raw('COUNT(TYPE) AS TOTAL'))                                 
                        ->where('ACADEMIC_YEAR_ID', $request->academicYearId)
                        ->where('STUDENTS_ID', $request->studentId)
                        ->groupBy('TYPE')
                        ->get();
        return $ajaxAbsen;
    }
}
