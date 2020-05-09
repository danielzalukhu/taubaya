<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Student;
use Hash;
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
                // dd($id_kelas);
                if($key >= 5)
                {
                    $studentName = explode(" ", $row[5], 2);

                    Student::create([
                        'NISN' => $row[4],
                        'FNAME' => $studentName[0],
                        'LNAME' => $studentName[1],
                        'GRADES_ID' => $id_kelas
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
