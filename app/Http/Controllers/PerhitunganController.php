<?php

namespace App\Http\Controllers;

use App\Models\HasilSmart;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Tahun;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{

    public function index()
    {
        return \view('hasil.perhitungan', [
            'tahuns' => Tahun::whereIn('status', ['dikonversi', 'selesai'])->get()
        ]);
    }

    public function hitung(Request $request)
    {
        $nilai = Penilaian::where('tahun_id', $request->tahun_id)->get();
        $hasil = []; // Membuat array untuk menyimpan hasil perhitungan

        foreach ($nilai as $n) {
            $label =  $n->kriteria->label;
            if ($label == 'const') {
                $min = Penilaian::where('kriteria_id', $n->kriteria_id)->min('nilai');
                $max = Penilaian::where('kriteria_id', $n->kriteria_id)->max('nilai');
                $ui_ai = ($max - $n->nilai) / ($max - $min); // Perbaikan operator perhitungan
                HasilSmart::create([
                    'tahun_id' => $request->tahun_id,
                    'penilaian_id' => $n->id,
                    'ui_ai' => $ui_ai
                ]);
            } else {
                $min = Penilaian::where('kriteria_id', $n->kriteria_id)->min('nilai');
                $max = Penilaian::where('kriteria_id', $n->kriteria_id)->max('nilai');
                $ui_ai = ($n->nilai - $min) / ($max - $min); // Perbaikan operator perhitungan
                HasilSmart::create([
                    'tahun_id' => $request->tahun_id,
                    'penilaian_id' => $n->id,
                    'ui_ai' => $ui_ai
                ]);
            }
        }

        //rubah status tahun keputusan
        Tahun::where('id', $request->tahun_id)->update(['status' => 'dikonversi']);

        return \redirect('/perhitungan')->with('alert', 'Data Alternatif dikonversi');
    }

    public function cariHasil(Request $request)
    {
        $tahunId = $request->tahun_id; // Mengambil tahun_id dari request
        $hasilPenilaian = Alternatif::whereHas('penilaian', function ($query) use ($tahunId) {
            $query->where('tahun_id', $tahunId);
        })
            ->with(['penilaian' => function ($query) use ($tahunId) {
                $query->where('tahun_id', $tahunId);
                $query->with('kriteria', 'hasil');
            }])
            ->get();

        return \view('hasil.perhitungan-cari', [
            'data' => $hasilPenilaian,
            'tahun_id' => $tahunId,
            'tahun' => Tahun::find($request->tahun_id)
        ]);
    }
}
