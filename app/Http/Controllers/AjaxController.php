<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Violation;
use App\Achievement;
use App\AcademicYear;
use App\GradeStudent;
use App\Grade;
use App\ViolationRecord;
use App\AchievementRecord;
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
                                        ->join('academic_years', 'violation_records.ACADEMIC_YEAR_ID', 'academic_years.id')
                                        ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('violation_records.*', 'students.FNAME', 'students.LNAME', 'academic_years.*')
                                        ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->where('violations.id', $request->violationId)
                                        ->orderBy('violation_records.id', 'DESC')
                                        ->get();
        }           
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $catatan_pelanggaran = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                        ->join('academic_years', 'violation_records.ACADEMIC_YEAR_ID', 'academic_years.id')
                                        ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('violation_records.*', 'students.FNAME', 'students.LNAME', 'academic_years.*')
                                        ->where('violations.NAME', 'NOT LIKE', 'TTS%')
                                        ->where('violation_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->where('violations.id', $request->violationId)
                                        ->orderBy('violation_records.id', 'DESC')
                                        ->get();
        }
        
        return $catatan_pelanggaran;
    }

    public function studentDetailViolation(Request $request)
    {
        $pelanggaran_tiap_siswa = ViolationRecord::join('violations', 'violation_records.VIOLATIONS_ID', 'violations.id')
                                            ->join('academic_years', 'violation_records.ACADEMIC_YEAR_ID', 'academic_years.id')
                                            ->join('students', 'violation_records.STUDENTS_ID', 'students.id')
                                            ->select('violation_records.id', 'violation_records.DATE' ,'violation_records.PUNISHMENT', 'violations.DESCRIPTION',
                                                     'students.FNAME', 'students.LNAME', 
                                                     'academic_years.TYPE', 'academic_years.NAME')
                                            ->where('STUDENTS_ID', $request->studentId)
                                            ->orderBy('violation_records.id', 'DESC')
                                            ->get();

        return $pelanggaran_tiap_siswa;
    }

    public function showAchievementItemByGrade(Request $request)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id; 

        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id; 
            
            $penghargaan = Achievement::join('achievement_records', 'achievements.id', 'achievement_records.ACHIEVEMENTS_ID')
                                ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                ->select('achievements.*', DB::raw('COUNT(*) AS JUMLAHPERPENGHARGAAN'))
                                ->where('GRADE', $request->achievementGrade)
                                ->where('grades_students.GRADES_ID', $kelas_guru)
                                ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                ->groupBy('achievements.id')
                                ->get();
        }
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $penghargaan = Achievement::join('achievement_records', 'achievements.id', 'achievement_records.ACHIEVEMENTS_ID')
                                ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                ->select('achievements.*', DB::raw('COUNT(*) AS JUMLAHPERPENGHARGAAN'))
                                ->where('GRADE', $request->achievementGrade)
                                ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                ->groupBy('achievements.id')
                                ->get();
        }
        
        return $penghargaan;
    }

    public function getAchievementRecord(Request $request)
    {
        $academic_year_id = AcademicYear::select(DB::raw('MAX(id) as id'))->get()[0]->id; 

        $selected_student = GradeStudent::select(DB::raw('MAX(ACADEMIC_YEAR_ID) AS id'))->limit(1)->first()->id;   

        if(Auth::guard('web')->user()->staff->ROLE == "TEACHER"){  
            $kelas_guru = Grade::where('STAFFS_ID', $request->session()->get('session_user_id'))->first()->id; 
            
            $catatan_penghargaan = AchievementRecord::join('achievements', 'achievement_records.ACHIEVEMENTS_ID', 'achievements.id')
                                        ->join('academic_years', 'achievement_records.ACADEMIC_YEAR_ID', 'academic_years.id')
                                        ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('achievement_records.*', 'students.FNAME', 'students.LNAME', 'academic_years.*')
                                        ->where('grades_students.GRADES_ID', $kelas_guru)
                                        ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->where('achievements.id', $request->achievementId)
                                        ->orderBy('achievement_records.id', 'DESC')
                                        ->get();
        }           
        elseif(Auth::guard('web')->user()->staff->ROLE == "HEADMASTER"){
            $catatan_penghargaan = AchievementRecord::join('achievements', 'achievement_records.ACHIEVEMENTS_ID', 'achievements.id')
                                        ->join('academic_years', 'achievement_records.ACADEMIC_YEAR_ID', 'academic_years.id')
                                        ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                        ->join('grades_students', 'students.id', 'grades_students.STUDENTS_ID')
                                        ->select('achievement_records.*', 'students.FNAME', 'students.LNAME', 'academic_years.*')
                                        ->where('achievement_records.ACADEMIC_YEAR_ID', $academic_year_id)
                                        ->where('grades_students.ACADEMIC_YEAR_ID', $selected_student)
                                        ->where('achievements.id', $request->achievementId)
                                        ->orderBy('achievement_records.id', 'DESC')
                                        ->get();
        }
        
        return $catatan_penghargaan;
    }

    public function studentDetailAchievement(Request $request)
    {
        $penghargaan_tiap_siswa = AchievementRecord::join('achievements', 'achievement_records.ACHIEVEMENTS_ID', 'achievements.id')
                                            ->join('academic_years', 'achievement_records.ACADEMIC_YEAR_ID', 'academic_years.id')
                                            ->join('students', 'achievement_records.STUDENTS_ID', 'students.id')
                                            ->select('achievement_records.id', 'achievement_records.DATE' ,'achievement_records.DESCRIPTION AS DESKRIPSI1', 'achievements.DESCRIPTION AS DESKRIPSI2' ,'achievements.GRADE',
                                                     'students.FNAME', 'students.LNAME', 
                                                     'academic_years.TYPE', 'academic_years.NAME')
                                            ->where('STUDENTS_ID', $request->studentId)
                                            ->orderBy('achievement_records.id', 'DESC')
                                            ->get();
        
        return $penghargaan_tiap_siswa;                                            
    }
}
