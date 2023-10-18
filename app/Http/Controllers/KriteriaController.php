<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Tahun;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $idTahun = $request->idTahun;
       if($idTahun){
        return \view('kriteria.kriteria-cari',[
            'kriterias' => Kriteria::where('tahun_id',$idTahun)->get(),
            'tahuns' => Tahun::all(),
            ]);
       }else{
           return \view('kriteria.index',[
               'tahuns' => Tahun::all(),
               ]);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('kriteria.create',[
            'tahuns' => Tahun::where('status','dibuat')->get()
        ]);
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
            'tahun_id' => 'required',
            'kode_kriteria' => 'required|unique:kriterias',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'label' => 'required'
          ]);
        //   $validateData['tahun_id'] = $request->tahun_id;
          Kriteria::create($validateData);
          return \redirect('/kriteria')->with('alert','Data kriteria disimpan');
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
        return \view('kriteria.edit',[
            'kriteria' => Kriteria::find($id)
        ]);
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
       $kriteria = Kriteria::find($id);
        $rules = [
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'label' => 'required'
        ];
        if($request->kode_kriteria != $kriteria->kode_kriteria){
           $rules['kode_kriteria'] ='required|unique:kriterias';
        }
        $validateData = $request->validate($rules);
          Kriteria::Where('id',$id)->update($validateData);
          return \redirect('/kriteria')->with('alert','Data kriteria diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kriteria::destroy($id);
        return \redirect('/kriteria')->with('alert','Data kriteria dihapus');
    }

    public function bobot(){
        $kriteria = Kriteria::all();
        $totalBobot =0;
        foreach($kriteria as $row){
            $totalBobot += $row['bobot'];
        }
        return \view('kriteria.bobot',[
            'kriterias' => $kriteria,
            'tahuns' => Tahun::all(),
            'totalBobot' => $totalBobot
            ]);
    }

    public function cariKriteria(Request $request){
      $validateData = $request->validate([
        'tahun_id' => 'required'
      ]);
      return \view('kriteria.kriteria-cari',[
        'kriterias' => Kriteria::where('tahun_id',$request->tahun_id)->get(),
        'tahun' => Tahun::find($request->tahun_id)
      ]);
    }

    public function cariKonversiBobot(Request $request){
        $kriteria = Kriteria::where('tahun_id',$request->tahun_id)->get();
        $totalBobot =0;
        foreach($kriteria as $row){
            $totalBobot += $row['bobot'];
        }
        return \view('kriteria.bobot-cari',[
            'kriterias' => $kriteria,
            'tahuns' => Tahun::all(),
            'totalBobot' => $totalBobot,
            'tahun' => Tahun::find($request->tahun_id)
            ]);
    }

  
}
