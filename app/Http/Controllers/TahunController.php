<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return \view('tahun.index',[
        'tahuns' => Tahun::all()
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('tahun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $validateData = $request->validate([
        'kode' => 'required|unique:tahuns',
        'tahun' => 'required',
        'keterangan' => 'required'
     ]);
     $validateData['status'] = 'dibuat';
     Tahun::create($validateData);
     return \redirect('/tahun')->with('alert','Data tahun keputusan disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tahun  $tahun
     * @return \Illuminate\Http\Response
     */
    public function show(Tahun $tahun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tahun  $tahun
     * @return \Illuminate\Http\Response
     */
    public function edit(Tahun $tahun)
    {
      return \view('tahun.edit',[
        'tahun' => $tahun
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tahun  $tahun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tahun $tahun)
    {
        $rules =[ 
            'tahun' => 'required',
            'keterangan' => 'required'
         ];
         if($request->kode != $tahun->kode){
            $rules['kode'] = 'required|unique:tahuns';
         }
         $validateData = $request->validate($rules);
         $validateData['status'] = 'dibuat';
         Tahun::where('id',$tahun->id)->update($validateData);
         return \redirect('/tahun')->with('alert','Data tahun keputusan diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tahun  $tahun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tahun $tahun)
    {
      Tahun::destroy($tahun->id);
      return \redirect('/tahun')->with('alert','Data tahun keputusan dihapus');
    }
}
