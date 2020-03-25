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
    public function collection(Collection $collection)
    {
        //dd($collection);
        foreach($collection as $key => $row)
        {          
            if($key >= 5)
            {
                $studentName = explode(" ", $row[5], 2);
                // dd($studentName);
                Student::create([
                    'NISN' => $row[4],
                    'FNAME' => $studentName[0],
                    'LNAME' => $studentName[1],
                ]); 
            }   
        }    
    }
}
