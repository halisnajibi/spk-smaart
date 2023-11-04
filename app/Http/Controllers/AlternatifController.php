<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('alternatif.index', [
            'tahuns' => Tahun::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->status_alternatif == 'manusia') {
            return \view('alternatif.create_manusia', [
                'tahuns' => Tahun::where('status', 'dibuat')->get()
            ]);
        } else {
            return \view('alternatif.create', [
                'tahuns' => Tahun::where('status', 'dibuat')->get()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cek = Alternatif::where('tahun_id', $request->tahun_id)->first();
        if ($cek == null || $cek->status_alternatif == $request->status_alternatif) {
            if ($request->status_alternatif == 'manusia') {
                $validateData = $request->validate([
                    'tahun_id' => 'required',
                    'nama' => 'required',
                    'nik' => 'required|unique:alternatifs',
                    'jk' => 'required',
                    'status_alternatif' => 'required'
                ]);
            } else {
                $validateData = $request->validate([
                    'tahun_id' => 'required',
                    'judul' => 'required',
                    'keterangan' => 'required',
                    'status_alternatif' => 'required'
                ]);
            }
            Alternatif::create($validateData);
            return \redirect('/alternatif')->with('alert', 'Data alternatif disimpan');
        } else {
            return \redirect('/alternatif')->with('alert-error', 'Data alternatif dengan tahun ' . $cek->tahun->kode . ' sudah ada dengan status alternatif ' . $cek->status_alternatif);
        }
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
        $alternatif = Alternatif::find($id);
        if ($alternatif->status_alternatif == 'manusia') {
            return \view('alternatif.edit_manusia', [
                'alternatif' => $alternatif,
                'tahuns' => Tahun::where('status', 'dibuat')->get()
            ]);
        } else {
            return \view('alternatif.edit', [
                'alternatif' => $alternatif,
                'tahuns' => Tahun::where('status', 'dibuat')->get()
            ]);
        }
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
        $alternatif = Alternatif::find($id);
        if ($request->status_alternatif == 'manusia') {
            $rules = [
                'tahun_id' => 'required',
                'nama' => 'required',
                'jk' => 'required',
                'status_alternatif' => 'required'
            ];
            if ($request->nik != $alternatif->nik) {
                $rules['nik'] = 'required|unique:alternatifs';
            }
            $validateData = $request->validate($rules);
        } else {
            $validateData = $request->validate([
                'tahun_id' => 'required',
                'judul' => 'required',
                'keterangan' => 'required',
                'status_alternatif' => 'required'
            ]);
        }
        Alternatif::where('id', $id)->update($validateData);
        return \redirect('/alternatif')->with('alert', 'Data alternatif diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alternatif::destroy($id);
        return \redirect('/alternatif')->with('alert', 'Data alternatif dihapus');
    }

    public function cariAlternatif(Request $request)
    {
        return \view('alternatif.cari-alternatif', [
            'tahun' => Tahun::find($request->tahun_id),
            'alternatifs' => Alternatif::where('tahun_id', $request->tahun_id)->get()
        ]);
    }
}
