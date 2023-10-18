@extends('layouts.app')
@section('content')
<a href="/laporan/kriteria" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
    <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Kriteria & Bobot Tahun {{ $tahun->kode }}-{{ $tahun->tahun }}
        </h2>
        <a href="/laporan/kriteria/cetak/{{ $tahun->id }}" target="_blank" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Cetak Data </a>
    </div>
    {{-- <div class="rounded-md px-5 py-4 mb-2 border text-gray-700">
        <div class="flex items-center">
            <div class="font-medium text-md">Tahun Pengambilan Keputusan :{{ $tahun->kode }}/{{ $tahun->tahun }}</div>
            <div class="text-xs bg-gray-600 px-1 rounded-md text-white ml-auto">{{ $tahun->status }}</div>
        </div>
        <div class="mt-3">{{ $tahun->keterangan }}.</div>
    </div> --}}
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Kode Kriteria</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Nama Kriteria</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Bobot Awal</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Konversi</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Bobot Kriteria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriterias as $kriteria)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $kriteria->kode_kriteria }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-b">{{ $kriteria->nama_kriteria }}</td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $kriteria->bobot }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $kriteria->bobot }}/{{ $totalBobot }}%
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ round($kriteria->bobot/$totalBobot,2) }}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach()
            </tbody>
            <tfoot>
                <!-- Bagian footer tabel (tfoot) -->
                <tr>
                    <td colspan="3" class="text-right font-bold">Total Bobot:</td>
                    <td class="text-center font-bold">{{ $totalBobot }}%</td>
                    <td colspan="2"></td>
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


