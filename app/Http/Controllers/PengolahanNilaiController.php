<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Tahun;

class PengolahanNilaiController extends Controller
{
    public function index()
    {
        return \view('pengolahan-nilai.index', [
            'tahuns' => Tahun::all(),
        ]);
    }

    public function pengolahanNilaiCari(Request $request)
    {
        $penilaian =  Penilaian::where('tahun_id', $request->tahun_id)->get();
        $penilaian =  $penilaian->unique('alternatif_id');
        return \view('pengolahan-nilai.konversi-nilai', [
            'kriterias' => Kriteria::where('tahun_id', $request->tahun_id)->get(),
            'penilaians' => $penilaian,
            'tahun_id' => $request->tahun_id,
            'tahun' => Tahun::find($request->tahun_id)
        ]);
    }

    public function selectNested(Request $request)
    {
        $idTahun = $request->idTahun;
        $alternatif = Alternatif::where('tahun_id', $idTahun)->get();
        $kriteria = Kriteria::where('tahun_id', $idTahun)->get();

        $result = [
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
        ];

        // Mengubah array menjadi JSON dan mengembalikannya sebagai response
        return response()->json($result);
    }

    public function penilaianCari(Request $request)
    {
        $penilaian =  Penilaian::where('tahun_id', $request->tahun_id)->get();
        $penilaian =  $penilaian->unique('alternatif_id');
        return \view('penilaian.penilaian-cari', [
            'penilaians' => $penilaian,
            'kriterias' => Kriteria::where('tahun_id', $request->tahun_id)->get(),
            'tahun' => Tahun::find($request->tahun_id)
        ]);
    }
}
