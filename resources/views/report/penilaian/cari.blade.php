@extends('layouts.app')
@section('content')
<a href="/laporan/penilaian" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
    <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Penilai Alternatif {{ $tahun->kode }}-{{ $tahun->tahun }}
        </h2>
        <a href="/laporan/penilaian/cetak/{{ $tahun->id }}" target="_blank" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Cetak Data </a>
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
                        @if ($penilaian->karyawan->status_alternatif == 'manusia')
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $penilaian->karyawan->nama }}</div>
                        </td>
                        @else
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $penilaian->karyawan->judul }}</div>
                        </td>
                        @endif
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
    {{-- modal  hapus --}}
    <div class="modal" id="delete-modal-preview">
        <div class="modal__content">
            <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Apakah anda yakin?</div>
                <div class="text-gray-600 mt-2">Data akan dihapus secara permanen.</div>
            </div>
            <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal"
                    class="button w-24 border bg-gray-300 mr-1">Cancel</button>
                    <form method="POST" id="form-hapus">
                        @csrf
                        @method('delete')
                        <button type="submit" class="button w-24 border bg-theme-6 text-white mt-3 mr-1" id="tombol-hapus">Hapus </button>
                    </form>
            </div>
        </div>
    </div>
    @endsection


