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
        Excel::import(new SubjectImport, $request->file('assesment_import'));
        Session::flash('sukses','Import success');
		return redirect('assesment');
    }

    public function importStudent(Request $request)
    {
        //dd($request->all());

		// $this->validate($request, [
		// 	'file' => 'required|mimes:csv,xls,xlsx'
		// ]);

		Excel::import(new StudentImport, $request->file('student_import'));
		Session::flash('sukses','Import success');
		return redirect('student');
    }
}
