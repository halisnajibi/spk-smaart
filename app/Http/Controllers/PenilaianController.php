<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\Karyawan;
use App\Models\Tahun;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penilaian =  Penilaian::all();
        $penilaian =  $penilaian->unique('karyawan_id');
        return \view('penilaian.index', [
            'tahuns' => Tahun::all(),
            'kriterias' => Kriteria::all(),
            'penilaians' => $penilaian
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return \view('penilaian.create', [
        //     'kriterias' => Kriteria::all(),
        //     'karyawans' => Karyawan::all()
        // ]);
        return \view('penilaian.create', [
            'tahuns' => Tahun::where('status','dibuat')->get(),
            'karyawans' => Karyawan::all()
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
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'karyawan_id' => 'required|integer|unique:penilaians',
            'kriteria_id' => 'required|array',
            'kriteria_id.*' => 'exists:kriterias,id',
            'nilai' => 'required|array',
            'nilai.*' => 'numeric',
        ]);

        // Simpan data ke dalam tabel penilaian
        foreach ($request->input('kriteria_id') as $index => $kriteriaId) {
            Penilaian::create([
                'tahun_id' => $request->input('tahun_id'),
                'karyawan_id' => $request->input('karyawan_id'),
                'kriteria_id' => $kriteriaId,
                'nilai' => $request->input('nilai')[$index],
            ]);
        }
        return \redirect('/penilaian')->with('alert', 'Data penilaian alternatif disimpan');
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
        $penilaian = Penilaian::where('karyawan_id', $id)->get();
        return \view('penilaian.edit', [
            'penilaian' => $penilaian,
            'kriterias' => Kriteria::all(),
            'karyawans' => Karyawan::all()
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
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'kriteria_id' => 'required|array',
            'kriteria_id.*' => 'exists:kriterias,id',
            'nilai' => 'required|array',
            'nilai.*' => 'numeric',
        ]);

        // Simpan data ke dalam tabel penilaian
        foreach ($request->input('kriteria_id') as $index => $kriteriaId) {
            $penilaian = Penilaian::where('karyawan_id', $request->input('karyawan_id_lama'))
                ->where('kriteria_id', $kriteriaId)
                ->first();
            if ($penilaian) {
                $penilaian->update([
                    'nilai' => $request->input('nilai')[$index],
                ]);
            } else {
                return 'gagal';
            }
        }
        return \redirect('/penilaian')->with('alert', 'Data penilaian alternatif diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penilaian::where('karyawan_id', $id)->delete();
        return \redirect('/penilaian')->with('alert', 'Data penilaian dihapus');
    }


   
}
