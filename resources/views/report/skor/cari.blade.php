
@extends('layouts.app')
@section('content')
<a href="/laporan/skor" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
    <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Skor Penilaian Alternatif {{ $tahun->kode }}-{{ $tahun->tahun }}
        </h2>
        <a href="/laporan/skor/cetak/{{ $tahun->id }}" target="_blank" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Cetak Data </a>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>

                    <th class="border-b-2 text-center whitespace-no-wrap">Alternatif</th>
                    @foreach ($data->first()->penilaian as $penilaian)
                        <th class="border-b-2 text-center whitespace-no-wrap">{{ $penilaian->kriteria->nama_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                    @if ($d->status_alternatif == 'manusia')
                    <td class="text-center border-b">{{ $d->nama }}</td>
                    @else
                    <td class="text-center border-b">{{ $d->judul }}</td>
                    @endif
                        @foreach ($d->penilaian as $nilai)
                        <td class="text-center border-b">{{round($nilai->hasil->ui_ai,2)}}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
