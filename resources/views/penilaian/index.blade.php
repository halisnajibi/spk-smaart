@extends('layouts.app')
@section('content')
   
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Penilaian Alternatif
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="/penilaian/create" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="plus" class="w-2 h-4 mr-2"></i> Tambah Data </a>
        </div>
    </div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h6 class="text-sm font-medium mr-auto">
          Tahun Keputusan
        </h6>
        <div>
       
        </div>
        
    </div>
    <form action="/penilaian/cari" method="post">
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
