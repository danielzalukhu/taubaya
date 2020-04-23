<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Extracurricular;
use App\Staff;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekskul = Extracurricular::all();
        return view('extracurricular.index', compact('ekskul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'e_name' => 'required',
            'e_desc' => 'required',
            ]);
         
        $ekskul = new Extracurricular([
            'NAME' => $request->get('e_name'),
            'DESCRIPTION' => $request->get('e_desc'),
        ]);
        $ekskul->save();

        return redirect('extracurricular')->with('sukses', 'Daftar ekskul baru berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ekskul = Extracurricular::find($id);
        $karyawan = Staff::select('staffs.*')
                        ->where('DEPARTMENTS_ID', 3)
                        ->get();

        return view('Extracurricular.edit', compact('ekskul', 'karyawan'));
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
        $ekskul = Extracurricular::find($id);
       
        $ekskul->NAME = $request->get('e_name');
        $ekskul->DESCRIPTION = $request->get('e_desc');
        $ekskul->STAFFS_ID = $request->get('e_staff_id');
        $ekskul->save();

        return redirect(action('ExtracurricularController@index', $ekskul->id))->with('sukses', 'Daftar ekskul berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ekskul = Extracurricular::whereId($id)->firstOrFail();
        $ekskul->delete();
        return redirect(action('ExtracurricularController@index'))->with('sukses', 'Daftar ekskul berhasil dihapus');
    }
}
