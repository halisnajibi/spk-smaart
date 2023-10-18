@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Hasil Akhir Perhitungan & Perangkingan
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="button w-36 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white" type="button" id="simpan-riwayat">
                <i data-feather="save" class="w-4 h-4 mr-2"></i>Simpan Riwayat Perangkingan</button>
        </div>   
    </div>
    <div class="rounded-md px-5 py-4 mb-2 border text-gray-700">
        <div class="flex items-center">
            <div class="font-medium text-md">Tahun Pengambilan Keputusan :{{ $tahun->kode }}/{{ $tahun->tahun }}</div>
            <div class="text-xs bg-gray-600 px-1 rounded-md text-white ml-auto">{{ $tahun->status }}</div>
        </div>
        <div class="mt-3">{{ $tahun->keterangan }}.</div>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        @if (session()->has('alert'))
            <div class="modal" id="success-modal-preview" data-modal="1">
                <div class="modal__content">
                    <div class="p-5 text-center"> <i data-feather="check-circle"
                            class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Berhasil!</div>
                        <div class="text-gray-600 mt-2">{{ session('alert') }}</div>
                    </div>
                    <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal"
                            class="button w-24 bg-theme-1 text-white">Ok</button> </div>
                </div>
            </div>
        @endif
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
                    @if ($loop->first)
                        @php
                            $firstItemData = [
                                'tahun_id' => $item->tahun_id,
                                'karyawan_id' => $item->karyawan_id,
                            ];
                        @endphp
                    @endif
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

    {{-- simpan riwayat perangkingan --}}
    <input type="hidden" value="{{ $firstItemData['tahun_id'] }}" id="tahunID">
    <input type="hidden" value="{{ $firstItemData['karyawan_id'] }}" id="karyawanID">
@endsection
