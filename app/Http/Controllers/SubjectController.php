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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //dd($request->all())
        $mapel->save();

        return redirect('subject')->with('sukses', 'New Subject has been created');

        
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
        // dd($ketidaktuntasan);
        return view('subject.incomplete', compact('ketidaktuntasan', 'siswa', 'pelanggaran', 'karyawan', 'tahun_ajaran'));
    }

    public function storeIncomplete(Request $request)
    {           
        $point = 0;
        $hukuman = "-";

        $ketidaktuntasan = new ViolationRecord([
            'DATE' => $request->get('vr_date'),
            'STUDENTS_ID' => $request->get('vr_student_name'),
            'DESCRIPTION' => $request->get('vr_description'),
            'PUNISHMENT' => $hukuman,
            'VIOLATIONS_ID' => $request->get('vr_violation_name'),
            'STAFFS_ID' => $request->get('vr_noted_by'),
            'TOTAL' => $point,
            'ACADEMIC_YEAR_ID' => $request->get('vr_academic_year')  
        ]);
        //dd($request->all());
        $ketidaktuntasan->save();
        return redirect('incomplete')->with('sukses', 'Incomplete Report has been created');
    }
    
    public function editIncomplete($id)
    {
        $ketidaktuntasan = ViolationRecord::find($id);

        $tahun_ajaran = AcademicYear::all();
        $siswa = Student::all();
        $pelanggaran = Violation::all();
        $karyawan = Staff::all();

        // dd($ketidaktuntasan);
        return view('subject.editincomplete', compact('ketidaktuntasan','tahun_ajaran','siswa','pelanggaran','karyawan'));
    }

    public function updateIncomplete(Request $request, $id)
    {
        $ketidaktuntasan = ViolationRecord::find($id);
        
        $point = 0;
        $hukuman = "-";

        $ketidaktuntasan->DATE = $request->get('vr_date');
        $ketidaktuntasan->DESCRIPTION = $request->get('vr_desc');
        $ketidaktuntasan->STUDENTS_ID = $request->get('vr_student_name');
        $ketidaktuntasan->VIOLATIONS_ID = $request->get('vr_violation_name');
        $ketidaktuntasan->ACADEMIC_YEAR_ID = $request->get('vr_academic_year');
        $ketidaktuntasan->STAFFS_ID = $request->get('vr_noted_by');
        $ketidaktuntasan->PUNISHMENT = $hukuman;
        $ketidaktuntasan->TOTAL = $point;
        //dd($request->all());
        $ketidaktuntasan->save();

        return redirect(action('SubjectController@incomplete', $ketidaktuntasan->id))->with('sukses', 'Incomplete report has been chaged');
    }

    public function destroyIncomplete($id)
    {
        $ketidaktuntasan = ViolationRecord::whereId($id)->firstOrFail();
        $ketidaktuntasan->delete();
        return redirect(action('SubjectController@incomplete'))->with('sukses', 'Incomplete report has been chaged');
    }

    public function assesmentImport() 
    {
        $aktivitas_siswa = ActivityStudent::all();
        $laporan_mapel = SubjectReport::all();

        return view('subject.assesment', compact('aktivitas_siswa', 'laporan_mapel'));
    }
}
 