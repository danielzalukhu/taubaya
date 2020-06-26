<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Extracurricular;
use App\ExtracurricularRecord;
use App\ExtracurricularReport;
use App\Staff;
use App\Student;
use App\Grade;
use App\AcademicYear;
use App\GradeStudent;
use Auth;
use DB;

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
        $ekskul_report = ExtracurricularReport::all();
        $ekskulku = ExtracurricularReport::join('extracurricular_records', 'extracurricular_reports.EXTRACURRICULAR_RECORD_ID', 'extracurricular_records.id')
                                    ->select('extracurricular_reports.*', 'extracurricular_records.*')
                                    ->where('extracurricular_records.STUDENTS_ID', $request->session()->get('session_student_id'))
                                    ->get();

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
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){                
            $siswa = $default_student;
        }
        else{
            $siswa = $default_student;
        }

        if(Auth::guard('web')->user()->ROLE === "STAFF")
            return view('extracurricular.assesment', compact('ekskul', 'siswa', 'ekskul_report'));
        else
            return view('extracurricular.ekskulku', compact('ekskulku'));
    }

    public function storeAssesment(Request $request)
    {
        $this->validate($request, [
            'e_ekskul_name' => 'required',
            'e_student_name' => 'required',
            'e_nilai' => 'required|integer|min:0|max:100',
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
        
        return redirect('extracurricular')->with('sukses', 'Berhasil menambah nilai ekskul siswa');
    }

    public function editAssesment($id)
    {
        $ekskul_report = ExtracurricularReport::find($id);        
        $ekskul = Extracurricular::all();
        
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

    public function showEkskul(Request $request)
    {
        $tahun_ajaran = AcademicYear::all();

        $max_academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;
        }
        else{
            $academic_year_id = $max_academic_year_id;
        }
        
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if(Auth::guard('web')->user()->staff->ROLE === "TEACHER"){
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id;

            $ekskul = ExtracurricularRecord::join('extracurricular_reports', 'extracurricular_records.id', 'extracurricular_reports.EXTRACURRICULAR_RECORD_ID')
                                        ->join('students', 'extracurricular_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')                                        
                                        ->select('extracurricular_records.*', 'extracurricular_reports.*')
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->where('extracurricular_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                        ->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE === "HEADMASTER") {
            $ekskul = ExtracurricularRecord::join('extracurricular_reports', 'extracurricular_records.id', 'extracurricular_reports.EXTRACURRICULAR_RECORD_ID')
                                        ->join('students', 'extracurricular_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->join('grades', 'grades_students.GRADES_ID', 'grades.id')
                                        ->select('extracurricular_records.*', 'extracurricular_reports.*', 'grades.NAME AS NAMAKELAS')
                                        ->where('extracurricular_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->get();
        }        

        return view('extracurricular.ekskul', compact('tahun_ajaran', 'ekskul', 'academic_year_id'));                            
    }

    public function showEkskulKu(Request $request)
    {
        $tahun_ajaran = AcademicYear::all();

        $max_academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;
        }
        else{
            $academic_year_id = $max_academic_year_id;
        }

        $ekskul = ExtracurricularRecord::join('extracurricular_reports', 'extracurricular_records.id', 'extracurricular_reports.EXTRACURRICULAR_RECORD_ID')
                                    ->select('extracurricular_records.*', 'extracurricular_reports.*')
                                    ->where('extracurricular_records.STUDENTS_ID', $request->session()->get('session_student_id'))
                                    ->where('extracurricular_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                    ->get();   

        return view('extracurricular.ekskul', compact('tahun_ajaran', 'ekskul', 'academic_year_id'));                                                                
    }
}

