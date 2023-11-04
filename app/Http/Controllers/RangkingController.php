<?php

namespace App\Http\Controllers;

use App\Models\HasilSmart;
use App\Models\Kriteria;
use App\Models\Perangkingan;
use App\Models\RiwayatPerangkingan;
use App\Models\Tahun;
use Illuminate\Http\Request;

class RangkingController extends Controller
{

  public function index()
  {
    $rangking =  Perangkingan::where('tahun_id', 1)->get();
    $rangking =  $rangking->unique('alternatif_id');
    return \view('hasil.rangking', [
      'kriterias' => Kriteria::where('tahun_id', 1)->get(),
      'hasil' => $rangking,
      'tahuns' => Tahun::all()
    ]);
  }

  public function rangking(Request $request)
  {
    $nilaiKonversi = HasilSmart::where('tahun_id', $request->tahun_id)->get();
    $kriteria = Kriteria::where('tahun_id', $request->tahun_id)->get();
    $totalBobot = 0;

    foreach ($kriteria as $k) {
      $totalBobot += $k->bobot;
    }


    foreach ($nilaiKonversi as $row) {
      $bobot = $row->penilaian->kriteria->bobot;
      $bobot /= $totalBobot;
      Perangkingan::create([
        'tahun_id' => $row->tahun_id,
        'alternatif_id' => $row->penilaian->alternatif->id,
        'penilaian_id' => $row->penilaian->id,
        'hasil_akhir' => $row->ui_ai * $bobot
      ]);

      Tahun::where('id', $request->tahun_id)->update(['status' => 'selesai']);
    }

    return \redirect('/perangkingan')->with('alert', 'Perhitungan dan perangkingan sudah ditentukan');
  }

  public function cariRangking(Request $request)
  {
    $rangking =  Perangkingan::where('tahun_id', $request->tahun_id)->get();
    $rangking =  $rangking->unique('alternatif_id');
    return \view('hasil.rangking-cari', [
      'kriterias' => Kriteria::where('tahun_id', $request->tahun_id)->get(),
      'hasil' => $rangking,
      'tahun' => Tahun::find($request->tahun_id)
    ]);
  }

  public function simpanRiwayat(Request $request)
  {
    $tahunId = $request->tahunId;
    $karyawanId = $request->karyawanId;
    RiwayatPerangkingan::firstOrCreate(
      [
        'tahun_id' => $tahunId,
        'alternatif_id' => $karyawanId
      ],
      [
        'tahun_id' => $tahunId,
        'alternatif_id' => $karyawanId,
        'tanggal_perangkingan' => \date('Y-m-d')
      ]
    );

    return 0;
  }
}
