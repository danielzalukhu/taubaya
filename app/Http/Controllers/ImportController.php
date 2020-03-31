<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Session;
use App\Imports\SubjectImport;
use App\Imports\StudentImport;

class ImportController extends Controller
{
    public function assesmentPercentage(Request $request)
    {
        $p_tugas = $request->get('input_persentase_tugas');
        $p_ph = $request->get('input_persentase_ph');
        $p_pts = $request->get('input_persentase_pts');
        $p_pas = $request->get('input_persentase_pas');
        dd($request->all());
    }

    public function importAssesment(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
			'assesment_import' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        Excel::import(new SubjectImport, $request->file('assesment_import'));
        Session::flash('sukses','Import success');
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
