<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absent;
use App\Student;
use App\Staff;
use App\AcademicYear;
use App\GradeStudent;
use App\Grade;
use Auth;
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
        $siswa = Student::all();
        $tahun_ajaran = AcademicYear::all();
        
        $maxId = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;

        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;            
        }
        else{
            $academic_year_id = $maxId;
        }
        
        $catatan_absen = $this->showAbsent($request->session()->get('session_user_id'), $academic_year_id);
        
        $type = Absent::select(DB::raw('TYPE AS TIPE'))->groupBy('TYPE')->get();
        
        $count_total_day_each_ay = AcademicYear::select(DB::raw('DATEDIFF(END_DATE, START_DATE) AS TOTALHARI'))
                                            ->where('id', $academic_year_id)->first()->TOTALHARI;  

        if(Auth::guard('web')->user()->staff->ROLE === "TEACHER"){                    
            $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;

            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id;
            
            $siswa = GradeStudent::join('students', 'grades_students.STUDENTS_ID', 'students.id')
                                ->select('students.id')
                                ->where('grades_students.GRADES_ID', $kelas_guru)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)->get();
                    
            $arr_siswa = [];                                
            foreach($siswa as $s){
                array_push($arr_siswa, $s->id);
            }
        
            $data = Absent::select(DB::raw('TYPE AS TIPE'), DB::raw('ACADEMIC_YEAR_ID AS TAHUNAJARAN'), DB::raw('COUNT(*) AS JUMLAH'))                                    
                            ->where('ACADEMIC_YEAR_ID', $academic_year_id)
                            ->whereIn('STUDENTS_ID', $arr_siswa)
                            ->groupBy('TIPE', 'TAHUNAJARAN')
                            ->get();                  
            
        }
        else{
            $data = Absent::select(DB::raw('TYPE AS TIPE'), DB::raw('ACADEMIC_YEAR_ID AS TAHUNAJARAN'), DB::raw('COUNT(*) AS JUMLAH'))                                    
                             ->where('ACADEMIC_YEAR_ID', $academic_year_id)
                             ->groupBy('TIPE', 'TAHUNAJARAN')
                             ->get();     
        }
                               
        return view('absent.index', compact('catatan_absen', 'tahun_ajaran', 'academic_year_id', 'type', 'data', 'count_total_day_each_ay'));
    }

    public function showAbsent($user_id, $ay)
    {
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $user_id)->first()->id; 

            $absen = Absent::join('students', 'absents.STUDENTS_ID', 'students.id')
                        ->join('grades_students', 'grades_students.STUDENTS_ID', 'students.id')
                        ->select('absents.TYPE', DB::raw('COUNT(*) ABSENPERTIPE'), 'grades_students.GRADES_ID')
                        ->where('grades_students.GRADES_ID', $kelas_guru)
                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                        ->where('absents.ACADEMIC_YEAR_ID', $ay)
                        ->groupBy('absents.TYPE')
                        ->get();  
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){  
            $absen = Absent::join('students', 'absents.STUDENTS_ID', 'students.id')
                        ->join('grades_students', 'grades_students.STUDENTS_ID', 'students.id')
                        ->join('grades', 'grades_students.GRADES_ID', 'grades.id')
                        ->select('grades.id AS GRADES_ID', 'grades.NAME AS NAMAKELAS', DB::raw('COUNT(*) AS TOTALKETIDAKHADIRANPERKELAS'))
                        ->where('absents.ACADEMIC_YEAR_ID', $ay)
                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                        ->groupBy('grades_students.GRADES_ID')
                        ->get();                               
        }

        return $absen;             
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
