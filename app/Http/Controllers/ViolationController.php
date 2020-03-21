<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Staff;
use App\Violation;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggaran = Violation::all();
        return view('violation.index', compact('pelanggaran'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('violation.create');
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
            'v_name' => 'required',
            'v_desc' => 'required',
            'v_point' => 'required',
            ]);
        
        $pelanggaran = new Violation([
            'NAME' => $request->get('v_name'),
            'DESCRIPTION' => $request->get('v_desc'),
            'POINT' => $request->get('v_point')
        ]);
        
        $pelanggaran->save();

        return redirect('violation')->with('sukses', 'New Violation has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggaran = Violation::findOrFail($id);
        return view('violation.show', compact('pelanggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggaran = Violation::find($id);
        return view('violation.edit', compact('pelanggaran'));
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
        $pelanggaran = Violation::find($id);
       
        $pelanggaran->NAME = $request->get('v_name');
        $pelanggaran->DESCRIPTION = $request->get('v_desc');
        $pelanggaran->POINT = $request->get('v_point');
        $pelanggaran->save();

        return redirect(action('ViolationController@index', $pelanggaran->id))->with('sukses', 'Violation has been chaged');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggaran = Violation::whereId($id)->firstOrFail();
        $pelanggaran->delete();
        return redirect(action('ViolationController@index'))->with('sukses', 'Violation has been deleted');
    }
}
