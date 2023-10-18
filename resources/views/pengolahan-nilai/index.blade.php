
@extends('layouts.app')
@section('content')
   
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Nilai Alternatif & Bobot Kriteria
        </h2>
    </div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h6 class="text-sm font-medium mr-auto">
          Tahun Keputusan
        </h6>
    </div>
    <form action="/pengolahan/nilai/cari" method="post">
        @csrf
    <select class="select2 sm:w-full" name="tahun_id" required>
        <option value="">--Pilih--</option>
        @foreach ($tahuns as $tahun)
        <option value="{{ $tahun->id }}">{{ $tahun->tahun }}-{{ $tahun->keterangan }}</option>
        @endforeach
    </select>
    <button  class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-1 text-white" type="submit">
        <i data-feather="search" class="w-4 h-4 mr-2"></i> Cari Data</button>
    </form>
    <div class="rounded-md px-5 py-4 mb-2 border text-gray-700">
        <div class="flex items-center">
            <div class="font-medium text-lg">Pemberitahuan!!</div>
        </div>
        <div class="mt-3">Silahkan cari nilai alternatif & bobot kriteria berdasarkan tahun keputusan di atas,Setelah nya jika tombol konversi nilai tidak  tersedia berarti sudah dikonversi.</div>
    </div>
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

    @endsection
