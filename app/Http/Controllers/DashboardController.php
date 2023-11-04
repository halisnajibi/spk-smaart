<?php

namespace App\Http\Controllers;

use App\Charts\AlternatifChart;
use App\Models\Tahun;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\RiwayatPerangkingan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(AlternatifChart $alternatifChart)
    {
        $alternatif = Alternatif::with('tahun') // Memuat relasi tahun
            ->select('tahun_id', Alternatif::raw('COUNT(id) as jumlah_alternatif'))
            ->groupBy('tahun_id')
            ->get();
        $kriteria = Kriteria::with('tahun')
            ->select('tahun_id', Kriteria::raw('COUNT(id) as jumlah_kriteria'))
            ->groupBy('tahun_id')->get();
        $riwayat = RiwayatPerangkingan::with('tahun')
            ->select('tahun_id', Kriteria::raw('COUNT(id) as jumlah_riwayat'))
            ->groupBy('tahun_id')->get();
        return \view('dashboard.index', [
            'alternatif' => Alternatif::count(),
            'kriteria' => Kriteria::count(),
            'tahun' => Tahun::count(),
            'riwayat' => RiwayatPerangkingan::count(),
            'chartAlternatif' => $alternatif,
            'chartKriteria' => $kriteria,
            'chartRiwayat' => $riwayat
        ]);
    }
}
