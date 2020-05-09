<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\ViolationRecord;
use App\Student;
use App\Staff;
use App\Violation;
use App\AcademicYear;
use App\ActivityStudent;
use App\SubjectReport;
use App\SubjectRecord;
use DB;
use Carbon\Carbon;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Subject::all();
        return view('subject.index', compact('mapel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $mapel = new Subject([
            'CODE' => $request->get('s_code'),
            'DESCRIPTION' => $request->get('s_desc'),
            'MINIMALPOIN' => $request->get('s_kkm'),
            'TYPE' => $request->get('s_type')
        ]);

        $mapel->save();

        return redirect('subject')->with('sukses', 'New Subject has been created');

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mapel = Subject::find($id);
        return view('subject.edit', compact('mapel'));
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
        $mapel = Subject::find($id);
       
        $mapel->CODE = $request->get('s_code');
        $mapel->DESCRIPTION = $request->get('s_desc');
        $mapel->MINIMALPOIN = $request->get('s_kkm');
        $mapel->TYPE = $request->get('s_type');
        $mapel->save();

        return redirect(action('SubjectController@index', $mapel->id))->with('sukses', 'Subject has been chaged');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Subject::whereId($id)->firstOrFail();
        $mapel->delete();
        return redirect(action('SubjectController@index'))->with('sukses', 'Subject has been deleted');
    }

    public function incomplete()
    {
        $ketidaktuntasan = ViolationRecord::join('violations','violation_records.VIOLATIONS_ID','=','violations.id')
                            ->select('violation_records.*')
                            ->where('violations.NAME','TTS')
                            ->get();

        $siswa = Student::all();
        $pelanggaran = Violation::all();
        $karyawan = Staff::all();
        $tahun_ajaran = AcademicYear::all();

        return view('subject.incomplete', compact('ketidaktuntasan', 'siswa', 'pelanggaran', 'karyawan', 'tahun_ajaran'));
    }

    public function storeIncomplete(Request $request)
    {           
        $point = 0;
        $hukuman = "-";

        $date = $request->get('vr_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);

        if($check == false)
        {
            return redirect('incomplete')->with('error', 'Input tanggal tidak sesuai dengan tahun ajaran yang berlaku');
        }
        else
        {
            $ketidaktuntasan = new ViolationRecord([
                'DATE' => $request->get('vr_date'),
                'STUDENTS_ID' => $request->get('vr_student_name'),
                'DESCRIPTION' => $request->get('vr_description'),
                'PUNISHMENT' => $hukuman,
                'VIOLATIONS_ID' => $request->get('vr_violation_name'),
                'STAFFS_ID' => $request->session()->get('session_user_id'),
                'TOTAL' => $point,
                'ACADEMIC_YEAR_ID' => $request->session()->get('session_academic_year_id')
            ]);

            $ketidaktuntasan->save();
            return redirect('incomplete')->with('sukses', 'Incomplete Report has been created');
        }
    }
    
    public function editIncomplete($id)
    {
        $ketidaktuntasan = ViolationRecord::find($id);

        $tahun_ajaran = AcademicYear::all();
        $siswa = Student::all();
        $pelanggaran = Violation::all();
        $karyawan = Staff::all();

        return view('subject.editincomplete', compact('ketidaktuntasan','tahun_ajaran','siswa','pelanggaran','karyawan'));
    }

    public function updateIncomplete(Request $request, $id)
    {
        $ketidaktuntasan = ViolationRecord::find($id);
        
        $point = 0;
        $hukuman = "-";

        $date = $request->get('vr_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);

        if($check == false)
        {
            return redirect(action('SubjectController@editIncomplete', $ketidaktuntasan->id))->with('error', 'Input tanggal tidak sesuai dengan tahun ajaran yang berlaku');
        }
        else{
            $ketidaktuntasan->DATE = $request->get('vr_date');
            $ketidaktuntasan->DESCRIPTION = $request->get('vr_desc');
            $ketidaktuntasan->STUDENTS_ID = $request->get('vr_student_name');
            $ketidaktuntasan->VIOLATIONS_ID = $request->get('vr_violation_name');
            $ketidaktuntasan->ACADEMIC_YEAR_ID = $request->session()->get('session_academic_year_id');
            $ketidaktuntasan->STAFFS_ID = $request->session()->get('session_user_id');
            $ketidaktuntasan->PUNISHMENT = $hukuman;
            $ketidaktuntasan->TOTAL = $point;
        }

        $ketidaktuntasan->save();

        return redirect(action('SubjectController@incomplete', $ketidaktuntasan->id))->with('sukses', 'Laporan ketidaktuntasan berhasil dibuat');
    }

    public function destroyIncomplete($id)
    {
        $ketidaktuntasan = ViolationRecord::whereId($id)->firstOrFail();
        $ketidaktuntasan->delete();
        return redirect(action('SubjectController@incomplete'))->with('sukses', 'Laporan ketidaktuntasan berhasil dibuat');
    }

    public function assesmentImport() 
    {    
        $laporan_mapel = SubjectReport::where('IS_VERIFIED', '=', 0)->get();
        // dd($laporan_mapel);
    
        return view('subject.assesment', compact('laporan_mapel'));
    }

    public function editAssesment($id)
    {
        $laporan_mapel = SubjectReport::find($id);
        $siswa = Student::all();
        $mapel = Subject::all();
        
        return view('subject.editassesment', compact('laporan_mapel', 'siswa', 'mapel'));
    }

    public function updateAssesment(Request $request, $id)
    {
        $laporan_mapel = SubjectReport::find($id);
       
        $array_tugas = $request->get('a_nilai_tugas');
        $array_ph = $request->get('a_nilai_ph');
        $array_pts = $request->get('a_nilai_pts');
        $array_pas = $request->get('a_nilai_pas');        
        $array_un = array();
        $array_us = array();
        $final_score = 0;        
        
        $sum_nilai_tugas = 0;
        $rata_nilai_tugas = 0;
        $final_nilai_tugas = 0;
        foreach($array_tugas as $tugas){
            $sum_nilai_tugas = $sum_nilai_tugas + $tugas;
        }
        $rata_nilai_tugas = $sum_nilai_tugas / count($array_tugas);
        $final_nilai_tugas = $rata_nilai_tugas * 0.1;

        $sum_nilai_ph = 0;
        $rata_nilai_ph = 0;
        $final_nilai_ph = 0;
        foreach($array_ph as $ph){
            $sum_nilai_ph = $sum_nilai_ph + $ph;
        }
        $rata_nilai_ph = $sum_nilai_ph / count($array_ph);
        $final_nilai_ph = $rata_nilai_ph * 0.2;

        $sum_nilai_pts = 0;
        $rata_nilai_pts = 0;
        $final_nilai_pts = 0;
        foreach($array_pts as $pts){
            $sum_nilai_pts = $sum_nilai_pts + $pts;
        }
        $rata_nilai_pts = $sum_nilai_pts / count($array_pts);
        $final_nilai_pts = $rata_nilai_pts * 0.3;

        $sum_nilai_pas = 0;
        $rata_nilai_pas = 0;
        $final_nilai_pas = 0;
        foreach($array_pas as $pas){
            $sum_nilai_pas = $sum_nilai_pas + $pas;
        }
        $rata_nilai_pas = $sum_nilai_pas / count($array_pas);
        $final_nilai_pas = $rata_nilai_pas * 0.4;

        $final_score = $final_nilai_tugas + $final_nilai_ph + $final_nilai_pts + $final_nilai_pas;
        $fix_final_score = round($final_score, 2);

        $laporan_mapel->SUBJECTS_ID = $request->get('a_subject_id');
        $laporan_mapel->SUBJECT_RECORD_ID = $laporan_mapel->SUBJECT_RECORD_ID;
        $laporan_mapel->TUGAS = json_encode($array_tugas);
        $laporan_mapel->PH = json_encode($array_ph);
        $laporan_mapel->PTS = json_encode($array_pts);
        $laporan_mapel->PAS = json_encode($array_pas);
        $laporan_mapel->UN = json_encode($array_un);
        $laporan_mapel->US = json_encode($array_us);
        $laporan_mapel->FINAL_SCORE = $fix_final_score;
    
        $laporan_mapel->save();

        return redirect(action('SubjectController@assesmentImport', $laporan_mapel->id))->with('sukses', 'Data nilai siswa berhasil diubah');
    }

    public function destroyAssesment($id)
    {
        $laporan_mapel = SubjectReport::whereId($id)->firstOrFail();
        $laporan_mapel->delete();
        return redirect(action('SubjectController@assesmentImport'))->with('sukses', 'Data nilai siswa berhasil dihapus');
    }

    public function setStatus(Request $request)
    {
        $laporan_mapel = SubjectReport::where('IS_VERIFIED', 0)->get();
        foreach($laporan_mapel as $lm){
            $lm->IS_VERIFIED = $request->status;
            $lm->save();
        }                

        return redirect(action('SubjectController@assesmentImport'))->with('sukses', 'Daftar nilai berhasil di verifikasi dan tersimpan!');
    }

    public function subjectDetail($id)
    {
        $mapel = Subject::find($id);
        
        $detail_mapel = SubjectReport::where('SUBJECTS_ID', $mapel->id)->get();  
        
        return view('student.detail-subject', compact('detail_mapel'));
    }   
}
 

