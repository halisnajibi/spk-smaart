
@extends('layouts.app')
@section('content')
<a href="/perhitungan" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
    <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Koversi Nilai Alternatif
        </h2>
        @if ($tahun->status == 'selesai')
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="button w-38 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white" type="submit">
                <i data-feather="thumbs-up" class="w-4 h-4 mr-2"></i>Sudah Rangking</button>
        </div>
        @elseif($tahun->status == 'dikonversi')
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <form action="/perangkingan" method="post">
                @csrf
                <input type="hidden" name="tahun_id" value="{{ $tahun_id }}">
                <button class="button w-38 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white" type="submit">
                    <i data-feather="plus" class="w-2 h-4 mr-2"></i> Perangkingan Smart</button>
            </form>
        </div>
        @endif

    </div>
    <div class="rounded-md px-5 py-4 mb-2 border text-gray-700">
        <div class="flex items-center">
            <div class="font-medium text-md">Tahun Pengambilan Keputusan :{{ $tahun->kode }}-{{ $tahun->tahun }}</div>
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
                      @if ($d->status_alternatif =='manusia')
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
