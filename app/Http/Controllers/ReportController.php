<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Perangkingan;
use App\Models\RiwayatPerangkingan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function kriteriaReport()
    {
        return \view('report.kriteria.index', [
            'tahuns' => Tahun::where('status', 'selesai')->get()
        ]);
    }
    public function kriteriaReportCari(Request $request)
    {
        $kriteria = Kriteria::where('tahun_id', $request->tahun_id)->get();
        $totalBobot = 0;
        foreach ($kriteria as $row) {
            $totalBobot += $row['bobot'];
        }
        return \view('report.kriteria.cari', [
            'kriterias' => $kriteria,
            'tahuns' => Tahun::all(),
            'totalBobot' => $totalBobot,
            'tahun' => Tahun::find($request->tahun_id)
        ]);
    }

    public function kriteriCetak($idTahun)
    {
        $kriteria = Kriteria::where('tahun_id', $idTahun)->get();
        $totalBobot = 0;
        foreach ($kriteria as $row) {
            $totalBobot += $row['bobot'];
        }
        $pdf = Pdf::loadView('report.kriteria.pdf', [
            'kriterias' => $kriteria,
            'tahuns' => Tahun::all(),
            'totalBobot' => $totalBobot,
            'tahun' => Tahun::find($idTahun)
        ]);
        return $pdf->stream('laporan-kriteria.pdf');
    }

    //alternatif
    public function alternatifReport()
    {
        return \view('report.alternatif.index', [
            'tahuns' => Tahun::where('status', 'selesai')->get()
        ]);
    }
    public function alternatifReportCari(Request $request)
    {
        $alternatif = Alternatif::where('tahun_id', $request->tahun_id)->get();
        return \view('report.alternatif.cari', [
            'alternatifs' => $alternatif,
        ]);
    }

    public function alternatifCetak($idTahun)
    {
        $alternatif = Alternatif::where('tahun_id', $idTahun)->get();
        $pdf = Pdf::loadView('report.alternatif.pdf', [
            'alternatifs' => $alternatif,
            'tahun' => Tahun::find($idTahun)
        ]);
        return $pdf->stream('laporan-alternatif.pdf');
    }

    //penilaian
    public function penilaianReport()
    {
        return \view('report.penilaian.index', [
            'tahuns' => Tahun::where('status', 'selesai')->get()
        ]);
    }
    public function penilaianReportCari(Request $request)
    {
        $penilaian =  Penilaian::where('tahun_id', $request->tahun_id)->get();
        $penilaian =  $penilaian->unique('alternatif_id');
        return \view('report.penilaian.cari', [
            'kriterias' => Kriteria::where('tahun_id', $request->tahun_id)->get(),
            'penilaians' => $penilaian,
            'tahun_id' => $request->tahun_id,
            'tahun' => Tahun::find($request->tahun_id)
        ]);
    }

    public function penilaianCetak($idTahun)
    {
        $penilaian =  Penilaian::where('tahun_id', $idTahun)->get();
        $penilaian =  $penilaian->unique('alternatif_id');
        $pdf = Pdf::loadView('report.penilaian.pdf', [
            'kriterias' => Kriteria::where('tahun_id', $idTahun)->get(),
            'penilaians' => $penilaian,
            'tahun_id' => $idTahun,
            'tahun' => Tahun::find($idTahun)
        ]);
        return $pdf->stream('laporan-penilaian-alternatif.pdf');
    }

    //skor
    public function skorReport()
    {
        return \view('report.skor.index', [
            'tahuns' => Tahun::where('status', 'selesai')->get()
        ]);
    }
    public function skorReportCari(Request $request)
    {
        $tahunId = $request->tahun_id;
        $hasilPenilaian = Alternatif::whereHas('penilaian', function ($query) use ($tahunId) {
            $query->where('tahun_id', $tahunId);
        })
            ->with(['penilaian' => function ($query) use ($tahunId) {
                $query->where('tahun_id', $tahunId);
                $query->with('kriteria', 'hasil');
            }])
            ->get();

        return \view('report.skor.cari', [
            'data' => $hasilPenilaian,
            'tahun_id' => $tahunId,
            'tahun' => Tahun::find($request->tahun_id)
        ]);
    }

    public function skorCetak($tahunId)
    {

        $hasilPenilaian = Alternatif::whereHas('penilaian', function ($query) use ($tahunId) {
            $query->where('tahun_id', $tahunId);
        })
            ->with(['penilaian' => function ($query) use ($tahunId) {
                $query->where('tahun_id', $tahunId);
                $query->with('kriteria', 'hasil');
            }])
            ->get();

        $pdf = Pdf::loadView('report.skor.pdf', [
            'data' => $hasilPenilaian,
            'tahun_id' => $tahunId,
            'tahun' => Tahun::find($tahunId)
        ]);
        return $pdf->stream('laporan-skor-alternatif.pdf');
    }

    //rekomendasi
    public function rekomendasiReport()
    {
        return \view('report.rekomendasi.index', [
            'tahuns' => Tahun::where('status', 'selesai')->get()
        ]);
    }
    public function rekomendasiReportCari(Request $request)
    {
        $rangking =  Perangkingan::where('tahun_id', $request->tahun_id)->get();
        $rangking =  $rangking->unique('alternatif_id');
        return \view('report.rekomendasi.cari', [
            'kriterias' => Kriteria::where('tahun_id', $request->tahun_id)->get(),
            'hasil' => $rangking,
            'tahun' => Tahun::find($request->tahun_id)
        ]);
    }

    public function rekomendasiCetak($idTahun)
    {
        $rangking =  Perangkingan::where('tahun_id', $idTahun)->get();
        $rangking =  $rangking->unique('alternatif_id');
        $pdf = Pdf::loadView('report.rekomendasi.pdf', [
            'kriterias' => Kriteria::where('tahun_id', $idTahun)->get(),
            'hasil' => $rangking,
            'tahun' => Tahun::find($idTahun)
        ]);
        return $pdf->stream('laporan-rekomendasi.pdf');
    }

    //riwayat
    public function riwayatReport()
    {
        return \view('report.riwayat.index', [
            'riwayats' => RiwayatPerangkingan::orderBy('tahun_id', 'desc')->get()
        ]);
    }

    public function riwayatCetak()
    {
        $pdf = Pdf::loadView('report.riwayat.pdf', [
            'riwayats' => RiwayatPerangkingan::orderBy('tahun_id', 'desc')->get()
        ]);
        return $pdf->stream('laporan-riwayat-perangkingan.pdf');
    }
}
