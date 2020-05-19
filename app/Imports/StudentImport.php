<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\User;
use DB;

class StudentImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    private $id_kelas;

    public function collection(Collection $collection)
    {
        // dd($collection);
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
                    $studentName = explode(" ", $row[5], 2);

                    $siswa = Student::create([
                        'NISN' => $row[4],
                        'FNAME' => $studentName[0],
                        'LNAME' => $studentName[1],
                        'GRADES_ID' => $id_kelas
                    ]); 

                    $user = User::create([
                        'name' => $student_full_name,
                        'email' => $studentName[0] . "@student.ac.id",
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
