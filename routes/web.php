<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilSmartController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengolahanNilaiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\RangkingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\UserController;
use App\Models\HasilSmart;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class,'index'])->middleware('guest')->name('login');
Route::post('/', [LoginController::class,'authenticate']);
Route::get('/logout', [LoginController::class,'logout'])->middleware('auth'); 
Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');

//PROFIEL
Route::get('/user', [UserController::class,'index'])->middleware('auth');
Route::post('/user', [UserController::class,'update'])->middleware('auth');
Route::post('/rubahPassword', [UserController::class,'rubahPassword'])->middleware('auth');

//MASTER DATA
Route::resource('/tahun',TahunController::class)->middleware('auth');
Route::get('/kriteria/bobot',[KriteriaController::class,'bobot'])->middleware('auth');
Route::resource('/kriteria',KriteriaController::class)->middleware('auth');
Route::post('/kriteria/cari',[KriteriaController::class,'cariKriteria'])->middleware('auth');
Route::post('/kriteria/bobot/cari',[KriteriaController::class,'cariKonversiBobot'])->middleware('auth');
Route::resource('/alternatif',KaryawanController::class)->middleware('auth');
Route::post('/alternatif/cari',[KaryawanController::class,'cariAlternatif'])->middleware('auth');

// PENILAIAN
Route::resource('/penilaian',PenilaianController::class)->middleware('auth');
Route::get('/pengolahan/nilai',[PengolahanNilaiController::class,'index'])->middleware('auth');
Route::post('/pengolahan/nilai/cari',[PengolahanNilaiController::class,'pengolahanNilaiCari'])->middleware('auth');
Route::get('/penilaian/select/nested',[PengolahanNilaiController::class,'selectNested'])->middleware('auth');
Route::post('/penilaian/cari',[PengolahanNilaiController::class,'penilaianCari'])->middleware('auth');
Route::get('/perhitungan',[PerhitunganController::class,'index'])->middleware('auth');
Route::post('/perhitungan',[PerhitunganController::class,'hitung'])->middleware('auth');
Route::post('/perhitungan/cari',[PerhitunganController::class,'cariHasil'])->middleware('auth');

//PERANGKINGAN
Route::get('/perangkingan',[RangkingController::class,'index'])->middleware('auth');
Route::post('/perangkingan',[RangkingController::class,'rangking'])->middleware('auth');
Route::post('/perangkingan/cari',[RangkingController::class,'cariRangking'])->middleware('auth');
Route::post('/perangkingan/simpan-riwayat-perangkingan',[RangkingController::class,'simpanRiwayat'])->middleware('auth');

//LAPORAN
//kriteria
Route::get('/laporan/kriteria',[ReportController::class,'kriteriaReport'])->middleware('auth');
Route::post('/laporan/kriteria/cari',[ReportController::class,'kriteriaReportCari'])->middleware('auth');
Route::get('/laporan/kriteria/cetak/{idTahun}',[ReportController::class,'kriteriCetak'])->middleware('auth');
//alternatif
Route::get('/laporan/alternatif',[ReportController::class,'alternatifReport'])->middleware('auth');
Route::post('/laporan/alternatif/cari',[ReportController::class,'alternatifReportCari'])->middleware('auth');
Route::get('/laporan/alternatif/cetak/{idTahun}',[ReportController::class,'alternatifCetak'])->middleware('auth');
//penilaian
Route::get('/laporan/penilaian',[ReportController::class,'penilaianReport'])->middleware('auth');
Route::post('/laporan/penilaian/cari',[ReportController::class,'penilaianReportCari'])->middleware('auth');
Route::get('/laporan/penilaian/cetak/{idTahun}',[ReportController::class,'penilaianCetak'])->middleware('auth');
//skor
Route::get('/laporan/skor',[ReportController::class,'skorReport'])->middleware('auth');
Route::post('/laporan/skor/cari',[ReportController::class,'skorReportCari'])->middleware('auth');
Route::get('/laporan/skor/cetak/{idTahun}',[ReportController::class,'skorCetak'])->middleware('auth');
//rekomendasi
Route::get('/laporan/rekomendasi',[ReportController::class,'rekomendasiReport'])->middleware('auth');
Route::post('/laporan/rekomendasi/cari',[ReportController::class,'rekomendasiReportCari'])->middleware('auth');
Route::get('/laporan/rekomendasi/cetak/{idTahun}',[ReportController::class,'rekomendasiCetak'])->middleware('auth');
//riwayat
Route::get('/laporan/riwayat',[ReportController::class,'riwayatReport'])->middleware('auth');
Route::get('/laporan/riwayat/cetak',[ReportController::class,'riwayatCetak'])->middleware('auth');