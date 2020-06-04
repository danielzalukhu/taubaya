<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AchievementRecord;
use App\Staff;
use App\Student;
use App\Achievement;
use App\AcademicYear;
use App\Grade;
use App\GradeStudent;
use DB;
use Auth;
use Carbon\Carbon;

class AchievementRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $penghargaan = Achievement::all();
        $tahun_ajaran = AcademicYear::all();

        // UNTUK CEK REQUEST DARI VIEW

        $maxId = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id;
        
        if($request->has('academicYearId')){
            $academic_year_id = $request->academicYearId;
        }        
        else{
            $academic_year_id = $maxId;
        }

        $catatan_penghargaan = $this->showAchievement($request->session()->get('session_user_id'), $academic_year_id);        

        // UNTUK GRAFIK

        $type = Achievement::select(DB::raw('GRADE AS TINGKAT'))->groupBy('TINGKAT')->get();          
        
        $selected_tahun_ajaran = AcademicYear::select(DB::raw('MONTH(START_DATE) AS STARTMONTH'), 
                                                          DB::raw('MONTH(END_DATE) AS ENDMONTH'))                                            
                                ->where('id', $academic_year_id)
                                ->get()[0];
        
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;    

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){ 
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id; 
            
            $data = Achievement::join('achievement_records', 'achievements.id', 'achievement_records.ACHIEVEMENTS_ID')
                            ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                            ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                            ->select(DB::raw('GRADE AS TINGKAT'), DB::raw('MONTH(achievement_records.DATE) AS BULAN'), DB::raw('COUNT(*) AS JUMLAH'))
                            ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                            ->where('grades_students.GRADES_ID', $kelas_guru)
                            ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                            ->groupBy('TINGKAT', 'BULAN')
                            ->orderBy('BULAN', 'ASC')
                            ->get();                                         
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $data = Achievement::join('achievement_records', 'achievements.id', 'achievement_records.ACHIEVEMENTS_ID')
                            ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')    
                            ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                            ->select(DB::raw('GRADE AS TINGKAT'), DB::raw('MONTH(achievement_records.DATE) AS BULAN'), DB::raw('COUNT(*) AS JUMLAH'))
                            ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                            ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                            ->groupBy('TINGKAT', 'BULAN')
                            ->orderBy('BULAN', 'ASC')
                            ->get();     
        }   
        elseif(Auth::guard('web')->user()->staff->ROLE == "ADVISOR"){                
            $data = Achievement::join('achievement_records', 'achievements.id', 'achievement_records.ACHIEVEMENTS_ID')
                            ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                            ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                            ->select(DB::raw('GRADE AS TINGKAT'), DB::raw('MONTH(achievement_records.DATE) AS BULAN'), DB::raw('COUNT(*) AS JUMLAH'))
                            ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                            ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                            ->groupBy('TINGKAT', 'BULAN')
                            ->orderBy('BULAN', 'ASC')
                            ->get();  
        }
        else{
            $data = Achievement::join('achievement_records', 'achievements.id', 'achievement_records.ACHIEVEMENTS_ID')
                            ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                            ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')            
                            ->select(DB::raw('GRADE AS TINGKAT'), DB::raw('MONTH(achievement_records.DATE) AS BULAN'), DB::raw('COUNT(*) AS JUMLAH'))
                            ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                            ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                            ->groupBy('TINGKAT', 'BULAN')
                            ->orderBy('BULAN', 'ASC')
                            ->get();  
        }
        
        return view('achievementrecord.index', compact('catatan_penghargaan', 'penghargaan', 'tahun_ajaran', 'type', 'data', 'selected_tahun_ajaran', 'academic_year_id'));     
    }

    public function showAchievement($user_id, $ay)
    {
        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   
        
        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $user_id)->first()->id; 

            $penghargaan = AchievementRecord::join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('achievement_records.*')
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('achievement_records.ACADEMIC_YEAR_ID', $ay)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $penghargaan = AchievementRecord::where('achievement_records.ACADEMIC_YEAR_ID', $ay)->get();
        }
        else{
            $penghargaan = AchievementRecord::where('achievement_records.ACADEMIC_YEAR_ID', $ay)->get();
        }
        
        return $penghargaan;
    }

    public function create(Request $request)
    {
        $penghargaan = Achievement::all();    
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
        
        return view('achievementrecord.create', compact('siswa', 'kelas', 'penghargaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->get('ar_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);

        if($check == false)
        {
            return redirect('achievementrecord')->with('error', 'Input tanggal tidak sesuai dengan tahun ajaran yang berlaku');
        }
        else
        {
            $catatan_penghargaan = new AchievementRecord([
                'STUDENTS_ID' => $request->get('ar_student_name'),
                'ACHIEVEMENTS_ID' => $request->get('ar_achievement_name'),
                'DATE' => $request->get('ar_date'),
                'DESCRIPTION' => $request->get('ar_desc'),
                'ACADEMIC_YEAR_ID' => $request->session()->get('session_academic_year_id'),
                'STAFFS_ID' => $request->session()->get('session_user_id')
            ]);
        }

        $catatan_penghargaan->save();
        return redirect('achievementrecord')->with('sukses', 'Daftar penghargaan baru berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $catatan_penghargaan = AchievementRecord::find($id);
        $penghargaan = Achievement::all();
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
    
        return view('achievementrecord.edit', compact('catatan_penghargaan', 'kelas', 'siswa', 'penghargaan'));
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
        $catatan_penghargaan = AchievementRecord::find($id);

        $date = $request->get('ar_date');
        $request_date = Carbon::parse($date);

        $session_start_ay = $request->session()->get('session_start_ay');
        $start_ay = Carbon::parse($session_start_ay);

        $session_end_ay = $request->session()->get('session_end_ay');
        $end_ay = Carbon::parse($session_end_ay);

        $check = $request_date->between($start_ay,$end_ay);

        if($check == false)
        {
            return redirect(action('AchievementRecordController@edit', $catatan_penghargaan->id))->with('error', 'Input tanggal tidak sesuai dengan tahun ajaran yang berlaku');
        }
        else
        {                                
            $catatan_penghargaan->STUDENTS_ID = $request->get('ar_student_name');
            $catatan_penghargaan->ACHIEVEMENTS_ID = $request->get('ar_achievement_name');
            $catatan_penghargaan->DATE = $request->get('ar_date');
            $catatan_penghargaan->DESCRIPTION = $request->get('ar_desc');
            $catatan_penghargaan->ACADEMIC_YEAR_ID = $request->session()->get('session_academic_year_id');
            $catatan_penghargaan->STAFFS_ID = $request->session()->get('session_user_id');
        }

        $catatan_penghargaan->save();
        return redirect(action('AchievementRecordController@index', $catatan_penghargaan->id))->with('sukses', 'Daftar penghargaan siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catatan_penghargaan = AchievementRecord::whereId($id)->firstOrFail();
        $catatan_penghargaan->delete();
        return redirect(action('AchievementRecordController@index'))->with('sukses', 'Daftar penghargaan siswa berhasil dihapus');
    }

    public function ajaxChangeAchievementRecord(Request $request)
    {
        $ajaxPenghargaan = DB::select('SELECT ass.DATE, a.GRADE, ass.DESCRIPTION, a.POINT
                                       FROM achievement_records ass INNER JOIN achievements a ON ass.ACHIEVEMENTS_ID = a.id
                                       WHERE ass.ACADEMIC_YEAR_ID = ' . $request->academicYearId . ' AND  ass.STUDENTS_ID = "' . $request->studentId .'"');    

        return $ajaxPenghargaan;
    }
}
