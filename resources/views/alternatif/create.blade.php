@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Form Tambah Data Alternatif
        </h2>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <form class="validate-form" novalidate="novalidate"  method="POST" action="/alternatif">
            @csrf
            <input type="hidden" name="status_alternatif" value="bukan_manusia">
            <label>Tahun Keputusan</label>
            <div class="mb-2">
                <select class="select2 w-full" name="tahun_id">
                    <option value="">--Pilih--</option>
                    @foreach ($tahuns as $tahun)
                    <option value="{{ $tahun->id }}">{{ $tahun->tahun }}-{{ $tahun->keterangan }}</option>
                    @endforeach
                </select>
            <div class="mb-3">
                <label class="flex flex-col sm:flex-row"> Judul <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required</span>
                </label>
                <input type="text" name="judul" class="input w-full border mt-2 @error('judul') error @enderror()" placeholder="Judul"
                    minlength="2">
                    @error('judul')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror
            </div>
            <div class="mb-3">
                <label class="flex flex-col sm:flex-row">Keterangan<span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required,Unique</span>
                </label>
                <input type="text" name="keterangan" class="input w-full border mt-2 @error('keterangan') error @enderror()" placeholder="Keterangan"
                    minlength="2">
                    @error('keterangan')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror
            </div>
            <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="save" class="w-4 h-4 mr-2"></i> Simpan</button>
        </form>
    </div>
@endsection
