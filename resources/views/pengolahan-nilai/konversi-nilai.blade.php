
@extends('layouts.app')
@section('content')
<a href="/pengolahan/nilai" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
    <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Nilai Alternatif & Bobot Kriteria
        </h2>
        @if ($tahun->status == 'dibuat')
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <form action="/perhitungan" method="post">
                @csrf
                <input type="hidden" name="tahun_id" value="{{ $tahun_id }}">
                <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white" type="submit">
                    <i data-feather="plus" class="w-2 h-4 mr-2"></i> Konversi Nilai</button>
            </form>
        </div>     
        @else
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="button w-38 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white" type="submit">
                <i data-feather="thumbs-up" class="w-4 h-4 mr-2"></i>Sudah Konversi</button>
        </div>
        @endif
    </div>
    <div class="rounded-md px-5 py-4 mb-2 border text-gray-700">
        <div class="flex items-center">
            <div class="font-medium text-md">Tahun Pengambilan Keputusan :{{ $tahun->kode }}/{{ $tahun->tahun }}</div>
            <div class="text-xs bg-gray-600 px-1 rounded-md text-white ml-auto">{{ $tahun->status }}</div>
        </div>
        <div class="mt-3">{{ $tahun->keterangan }}.</div>
    </div> 
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                        <th class="border-b-2 text-center">{{ $kriteria->nama_kriteria }} ({{ $kriteria->label }})</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($penilaians as $penilaian)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $penilaian->karyawan->nama }}</div>
                        </td>
                        </td>
                        @php
                            $nilai = PenelaianHelp::getKriteria($penilaian->karyawan_id);
                        @endphp
                        @foreach ($nilai as $a)
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{ $a->nilai }}</div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="border-t-3">Minimum</td>
                    <td class="border-t-3"></td>
                    @foreach ($kriterias as $kriteria)
                        @php
                            $minValue = PenelaianHelp::getMinValueByKriteria($kriteria->id);
                        @endphp
                        <td class="border-t-2 text-center">{{ $minValue }}</td>
                    @endforeach

                </tr>
                <tr>
                    <td class="border-t-1">Maximum</td>
                    <td class="border-t-3"></td>
                    @foreach ($kriterias as $kriteria)
                        @php
                            $maxValue = PenelaianHelp::getMaxValueByKriteria($kriteria->id);
                        @endphp
                        <td class="border-t-1 text-center">{{ $maxValue }}</td>
                    @endforeach

                </tr>
                <tr>
                    <td class="border-t-1">Bobot</td>
                    <td class="border-t-3"></td>
                    @foreach ($kriterias as $item)
                        <td class="border-t-1 text-center">{{ $item->bobot }}</td>
                    @endforeach

                </tr>
            </tfoot>
        </table>
    </div>
@endsection
