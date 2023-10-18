@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Konversi Bobot Kriteria
        </h2>
    </div>
    <form action="/kriteria/bobot/cari" method="post">
        @csrf
        <select class="select2 sm:w-full" id="kriteria-tahun" name="tahun_id" required>
            <option value="">--Pilih--</option>
            @foreach ($tahuns as $tahun)
            <option value="{{ $tahun->id }}">{{ $tahun->kode }}-{{ $tahun->tahun }}</option>
            @endforeach
        </select>
        <button  class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-1 text-white" type="submit">
            <i data-feather="search" class="w-4 h-4 mr-2"></i> Cari Data</button>
        </form>
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
            {{-- <tbody>
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
            </tfoot> --}}
        </table>
    </div>
    @endsection
