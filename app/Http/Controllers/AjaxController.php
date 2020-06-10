<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Violation;
use App\AcademicYear;
use App\GradeStudent;
use App\Grade;
use App\ViolationRecord;
use DB;
use Auth;

class AjaxController extends Controller
{
    public function showViolationItemByCategory(Request $request)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id; 

        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id; 
            
            $pelanggaran = Violation::join('violation_records', 'violations.id', 'violation_records.VIOLATIONS_ID')
                                ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                ->select('violations.*', DB::raw('COUNT(*) AS JUMLAHPERPELANGGARAN'))
                                ->where('NAME', 'LIKE', $request->violationName . '%' )
                                ->where('grades_students.GRADES_ID', $kelas_guru)
                                ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                ->groupBy('violations.id')
                                ->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $pelanggaran = Violation::join('violation_records', 'violations.id', 'violation_records.VIOLATIONS_ID')
                                ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                ->select('violations.*', DB::raw('COUNT(*) AS JUMLAHPERPELANGGARAN'))
                                ->where('NAME', 'LIKE', $request->violationName . '%' )
                                ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                ->groupBy('violations.id')
                                ->get();
        }
        
        return $pelanggaran;
    }

    public function getViolationRecord(Request $request)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id; 

        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id; 
            
            $catatan_pelanggaran = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                        ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('violation_records.*')
                                        ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->where('violations.id', $request->violationId)
                                        ->orderBy('violation_records.id', 'DESC')
                                        ->get();
        }                          
        
        return $catatan_pelanggaran;
    }
}
