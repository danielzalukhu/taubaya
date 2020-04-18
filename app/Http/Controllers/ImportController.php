<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Session;
use App\Imports\SubjectImport;
use App\Imports\StudentImport;

class ImportController extends Controller
{
    public function importAssesment(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
			'assesment_import' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        Excel::import(new SubjectImport($request), $request->file('assesment_import'));
        Session::flash('sukses','Import berhasil');
        return redirect('assesment');    		
    }

    public function importStudent(Request $request)
    {
        // dd($request->all());

		$this->validate($request, [
			'student_import' => 'required|mimes:csv,xls,xlsx'
		]);

		Excel::import(new StudentImport, $request->file('student_import'));
		Session::flash('sukses','Import success');
		return redirect('student');
    }
}
