@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Alternatif
        </h2>
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
@if (session()->has('alert-error'))
<div class="modal" id="warning-modal-preview" data-modal="1">
    <div class="modal__content">
        <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Oops...</div>
            <div class="text-gray-600 mt-2">{{ session('alert-error') }}</div>
        </div>
        <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white">Ok</button> </div>
    </div>
</div>
@endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h6 class="text-sm font-medium mr-auto">
          Tahun Keputusan
        </h6>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="plus" class="w-2 h-4 mr-2"></i> Tambah Data </a>
        </div>
        
    </div>
    <form action="/alternatif/cari" method="post">
    @csrf
    <select class="select2 sm:w-full" id="kriteria-tahun" name="tahun_id" required>
        <option value="">--Pilih--</option>
        @foreach ($tahuns as $tahun)
        <option value="{{ $tahun->id }}">{{ $tahun->tahun }}-{{ $tahun->keterangan }}</option>
        @endforeach
    </select>
    <button  class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-1 text-white" type="submit">
        <i data-feather="search" class="w-4 h-4 mr-2"></i> Cari Data</button>
    </form>
{{-- modal tambah --}}
<div class="modal" id="header-footer-modal-preview">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Pilih Status Alternatif</h2>
        </div>
        <div class="mt-3 ml-3">
            <form action="/alternatif/create" method="GET">
            <div class="flex flex-col sm:flex-row mt-2">
                <div class="flex items-center text-gray-700 mr-2"> <input type="radio" class="input border mr-2" id="manusia" name="status_alternatif" value="manusia" checked> <label class="cursor-pointer select-none" for="manusia">Manusia</label> </div>
                <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="bukan_manusia" name="status_alternatif" value="bukan_manusia"> <label class="cursor-pointer select-none" for="bukan_manusia">Bukan Manusia</label> </div>
            </div>
        </div>
      <button type="submit" class="button w-20 bg-theme-1 text-white my-3 ml-3">Lanjut</button> 
    </div>
    </form>
    </div>
</div>
    @endsection
