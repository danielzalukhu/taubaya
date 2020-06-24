<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\User;
use App\GradeStudent;
use DB;

class StudentImport implements ToCollection
{
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    /**
    * @param Collection $collection
    */
    private $id_kelas;

    public function collection(Collection $collection)
    {
        foreach($collection as $key => $row)
        {          
            if($key >= 3)
            {
                $grade_id = $row[4];                
                $tmp_id_grade = $this->selectGradeId($grade_id);
                
                foreach($tmp_id_grade as $ig)
                {
                    $id_kelas = $ig->id;
                }
                
                if($key >= 5)
                {
                    $student_full_name = $row[5];
                    $studentName = explode(" ", $student_full_name, 2); 
                    
                    $siswa = new Student();
                    $siswa->NISN = $row[4];
                    $siswa->FNAME = $studentName[0];
                    $siswa->LNAME = $studentName[1];
                    $siswa->ACADEMIC_YEAR_ID = $this->request->session()->get("session_academic_year_id");
                    $siswa->save();

                    $kelas_siswa = GradeStudent::create([
                        'STUDENTS_ID' => $siswa->id,
                        'GRADES_ID' => $id_kelas,
                        'ACADEMIC_YEAR_ID' => $this->request->session()->get("session_academic_year_id")
                    ]);
                    
                    $user = User::create([
                        'name' => $student_full_name,
                        'email' => "s" . $row[4] . "@student.ac.id",
                        'password' => Hash::make($studentName[0]),
                        'ROLE' => 'STUDENT',
                        'STUDENTS_ID' => $siswa->id                                             
                    ]);
                    
                }   
            }            
        }    
    }

    public function selectGradeId($value)
    {
        $kelas = DB::SELECT('SELECT id
                             FROM grades 
                             WHERE grades.NAME = "' . $value . '"');
        return $kelas;                            
    }
}

