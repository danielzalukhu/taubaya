<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Achievement;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penghargaan = Achievement::all();
        //dd($penghargaan);
        return view('achievement.index', compact('penghargaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penghargaan = new Achievement([
            'TYPE' => $request->get('a_type'),
            'DESCRIPTION' => $request->get('a_desc'),
            'POINT' => $request->get('a_point'),
            'GRADE' => $request->get('a_grade')
        ]);
        //dd($request->all());
        $penghargaan->save();

        return redirect('achievement')->with('sukses', 'Daftar penghargaan berhasil dibuat');
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
        $penghargaan = Achievement::find($id);
        return view('achievement.edit', compact('penghargaan'));
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
        $penghargaan = Achievement::find($id);
       
        $penghargaan->TYPE = $request->get('a_type');
        $penghargaan->DESCRIPTION = $request->get('a_desc');
        $penghargaan->POINT = $request->get('a_point');
        $penghargaan->GRADE = $request->get('a_grade');
        $penghargaan->save();

        return redirect(action('AchievementController@index', $penghargaan->id))->with('sukses', 'Penghargaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penghargaan = Achievement::whereId($id)->firstOrFail();
        $penghargaan->delete();
        return redirect(action('AchievementController@index'))->with('sukses', 'Penghargaan berhasil diubah');
    }
}
