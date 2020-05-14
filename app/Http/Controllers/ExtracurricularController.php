<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Extracurricular;
use App\ExtracurricularRecord;
use App\ExtracurricularReport;
use App\Staff;
use App\Student;
use Auth;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekskul = Extracurricular::all();    

        return view('extracurricular.index', compact('ekskul'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'e_name' => 'required',
            'e_desc' => 'required',
            ]);
         
        $ekskul = new Extracurricular([
            'NAME' => $request->get('e_name'),
            'DESCRIPTION' => $request->get('e_desc'),
        ]);
        $ekskul->save();

        return redirect('extracurricular')->with('sukses', 'Daftar ekskul baru berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ekskul = Extracurricular::find($id);
        $karyawan = Staff::join('departments_staffs', 'staffs.id', 'departments_staffs.STAFFS_ID')
                        ->where('departments_staffs.DEPARTMENTS_ID', 3)
                        ->get();

        return view('extracurricular.edit', compact('ekskul', 'karyawan'));
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
        $ekskul = Extracurricular::find($id);
       
        $ekskul->NAME = $request->get('e_name');
        $ekskul->DESCRIPTION = $request->get('e_desc');
        $ekskul->STAFFS_ID = $request->get('e_staff_id');
        $ekskul->save();

        return redirect(action('ExtracurricularController@index', $ekskul->id))->with('sukses', 'Daftar ekskul berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ekskul = Extracurricular::whereId($id)->firstOrFail();
        $ekskul->delete();
        return redirect(action('ExtracurricularController@index'))->with('sukses', 'Daftar ekskul berhasil dihapus');
    }

    public function ekskulAssesment(Request $request)
    {
        $ekskul = Extracurricular::all();
        $siswa = Student::all();
        $ekskul_report = ExtracurricularReport::all();
        $ekskulku = ExtracurricularRecord::join('extracurricular_reports', 'extracurricular_records.id', 'extracurricular_reports.EXTRACURRICULAR_RECORD_ID')
                                    ->select('extracurricular_reports.*', 'extracurricular_records.*')
                                    ->where('extracurricular_records.STUDENTS_ID', $request->session()->get('session_student_id'))
                                    ->get();

        if(Auth::guard('web')->user()->ROLE === "STAFF")
            return view('extracurricular.assesment', compact('ekskul', 'siswa', 'ekskul_report'));
        else
            return view('extracurricular.assesment', compact('ekskul', 'ekskulku', 'siswa', 'ekskul_report'));
    }

    public function storeAssesment(Request $request)
    {
        $this->validate($request, [
            'e_ekskul_name' => 'required',
            'e_student_name' => 'required',
            'e_nilai' => 'required',
            'e_desc' => 'required',
            ]);
         
        $ekskul_record = new ExtracurricularRecord();
        $ekskul_record->ACADEMIC_YEAR_ID = $request->session()->get('session_academic_year_id');
        $ekskul_record->STUDENTS_ID = $request->get('e_student_name');
        $ekskul_record->save();

        $ekskul_report = new ExtracurricularReport();
        $ekskul_report->EXTRACURRICULARS_ID = $request->get('e_ekskul_name');
        $ekskul_report->EXTRACURRICULAR_RECORD_ID = $ekskul_record->id;
        $ekskul_report->SCORE = $request->get('e_nilai');
        $ekskul_report->DESCRIPTION = $request->get('e_desc');

        $ekskul_report->save();
        
        return redirect('extracurricular/assesment')->with('sukses', 'Berhasil menambah nilai ekskul siswa');
    }

    public function editAssesment($id)
    {
        $ekskul_report = ExtracurricularReport::find($id);        
        $ekskul = Extracurricular::all();
        $siswa = Student::all();

        return view('extracurricular.editAssesment', compact('ekskul_report', 'ekskul', 'siswa'));
    }

    public function updateAssesment(Request $request, $id)
    {
        $ekskul_report = ExtracurricularReport::find($id);

        $ekskul_record = ExtracurricularRecord::find($ekskul_report->EXTRACURRICULAR_RECORD_ID);

        $ekskul_record->ACADEMIC_YEAR_ID = $request->session()->get('session_academic_year_id');
        $ekskul_record->STUDENTS_ID = $request->get('e_student_name');
        $ekskul_record->save();

        $ekskul_report->EXTRACURRICULARS_ID = $request->get('e_ekskul_name');
        $ekskul_report->EXTRACURRICULAR_RECORD_ID = $ekskul_record->id;
        $ekskul_report->SCORE = $request->get('e_nilai');
        $ekskul_report->DESCRIPTION = $request->get('e_desc');
        $ekskul_report->save();

        return redirect(action('ExtracurricularController@ekskulAssesment', $ekskul_report->id))->with('sukses', 'Data nilai ekskul berhasil diubah');
    }

    public function destroyAssesment($id)
    {
        $ekskul_report = ExtracurricularReport::whereId($id)->firstOrFail();
        $ekskul_report->delete();

        ExtracurricularRecord::where('id', $ekskul_report->EXTRACURRICULAR_RECORD_ID)->delete();

        return redirect(action('ExtracurricularController@ekskulAssesment'))->with('sukses', 'Data nilai ekskul berhasil dihaous');
    }
}

