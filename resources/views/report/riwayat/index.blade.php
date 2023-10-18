
@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Riwayat Perangkingan
        </h2>
        <a href="/laporan/riwayat/cetak" target="_blank" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Cetak Data </a>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>
                    <th class="border-b-2 whitespace-no-wrap">Kode Tahun Keputusan</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Tahun Keputusan</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Keterangan</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Rekomendasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $riwayat)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $riwayat->tahun->kode }}</div>
                        </td>
                        <td class="text-center border-b">{{ $riwayat->tahun->tahun }}</td>
                        <td class="text-center border-b">{{ $riwayat->tahun->keterangan }}</td>
                     @if ($riwayat->karyawan->status_alternatif == 'manusia')
                     <td class="text-center border-b">{{ $riwayat->karyawan->nama }}</td>
                     @else
                     <td class="text-center border-b">{{ $riwayat->karyawan->judul }}</td>
                     @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
