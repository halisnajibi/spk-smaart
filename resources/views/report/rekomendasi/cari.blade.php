@extends('layouts.app')
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Data Hasil Akhir & Rekomendasi {{ $tahun->kode }}-{{ $tahun->tahun }}
    </h2>
    <a href="/laporan/rekomendasi/cetak/{{ $tahun->id }}" target="_blank" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
        <i data-feather="printer" class="w-4 h-4 mr-2"></i> Cetak Data </a>
</div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="border-b-2 text-center">{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                    <th class="border-b-2 text-center whitespace-no-wrap">Total Nilai</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Rank</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Sort $hasil array based on $totalNilai in descending order
                    $sortedHasil = $hasil->sortByDesc(function ($item) {
                        $nilai = PenelaianHelp::getRangking($item->karyawan_id);
                        $totalNilai = 0;
                        foreach ($nilai as $a) {
                            $totalNilai += $a->hasil_akhir;
                        }
                        return $totalNilai;
                    });
                    $rank = 1;
                @endphp
                @foreach ($sortedHasil as $item)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                        @if ($item->karyawan->status_alternatif == 'manusia')
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $item->karyawan->nama }}</div>
                        </td>
                        @else
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $item->karyawan->judul }}</div>
                        </td>
                        @endif
                        @php
                            $nilai = PenelaianHelp::getRangking($item->karyawan_id);
                            $totalNilai = 0;
                        @endphp
                        @foreach ($nilai as $a)
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ round($a->hasil_akhir, 3) }}</div>
                            </td>
                            @php
                                $totalNilai += $a->hasil_akhir;
                            @endphp
                        @endforeach
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ round($totalNilai, 3) }}</div>
                        </td>
                        <td class="text-center border-b">
                            {{ $rank }}
                        </td>
                    </tr>
                    @php
                        $rank++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        
    </div>
@endsection
