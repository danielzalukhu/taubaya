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
        $aktivitas_siswa = ActivityStudent::all();     
        $laporan_mapel = SubjectReport::all();       
        
        foreach($aktivitas_siswa as $as)
        {
            $nilai_tugas = $this->showDetailTugasStudent($as->STUDENTS_ID)->tugas;
            $nilai_ph = $this->showDetailPHStudent($as->STUDENTS_ID)->ph;
            $nilai_pts = $this->showDetailPTSStudent($as->STUDENTS_ID)->pts;
            $nilai_pas = $this->showDetailPASStudent($as->STUDENTS_ID)->pas; 
        }
    
        // for($i = 0; $i < count($aktivitas_siswa); $i++){
        //     $id_siswa = $aktivitas_siswa[$i]->STUDENTS_ID;
        // }
        // dd($id_siswa);

        return view('subject.assesment', compact('aktivitas_siswa', 'laporan_mapel', 'nilai_tugas',
                                                 'nilai_ph', 'nilai_pts', 'nilai_pas'));
    }

    public function showDetailTugasStudent($id)
    {
        $tugas = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                        ->select('students.*', 'activities_students.SCORE')
                        ->where('activities_students.ACTIVITIES_ID', 1)
                        ->where('students.id', $id)
                        ->get();
        
        return view('subject.assesment', compact('tugas'));
    }

    public function showDetailPHStudent($id)
    {
        $ph = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                        ->select('students.*', 'activities_students.SCORE')
                        ->where('activities_students.ACTIVITIES_ID', 2)
                        ->where('students.id', $id)
                        ->get();
        
        return view('subject.assesment', compact('ph'));
    }

    public function showDetailPTSStudent($id)
    {
        $pts = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                        ->select('students.*', 'activities_students.SCORE')
                        ->where('activities_students.ACTIVITIES_ID', 3)
                        ->where('students.id', $id)
                        ->get();
        
        return view('subject.assesment', compact('pts'));
    }

    public function showDetailPASStudent($id)
    {
        $pas = ActivityStudent::join('students', 'activities_students.STUDENTS_ID', 'students.id')
                        ->select('students.*', 'activities_students.SCORE')
                        ->where('activities_students.ACTIVITIES_ID', 4)
                        ->where('students.id', $id)
                        ->get();
        
        return view('subject.assesment', compact('pas'));
    }
}
 