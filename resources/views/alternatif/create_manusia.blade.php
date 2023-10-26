@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Form Tambah Data Alternatif
        </h2>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <form class="validate-form"  method="POST" action="/alternatif">
            @csrf
            <input type="hidden" name="status_alternatif" value="manusia">
            <label>Tahun Keputusan</label>
            <div class="mb-2">
                <select class="select2 w-full" name="tahun_id">
                    <option value="">--Pilih--</option>
                    @foreach ($tahuns as $tahun)
                        <option value="{{ $tahun->id }}">{{ $tahun->tahun }}-{{ $tahun->keterangan }}</option>
                    @endforeach
                </select>
            <div class="mb-3">
                <label class="flex flex-col sm:flex-row"> Nama <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required</span>
                </label>
                <input type="text" name="nama" class="input w-full border mt-2 @error('nama') error @enderror()" placeholder="Nama"
                    minlength="2" value="{{ old('nama') }}">
                    @error('nama')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror
            </div>
            <div class="mb-3">
                <label class="flex flex-col sm:flex-row">Nik<span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required,Unique</span>
                </label>
                <input type="text" name="nik" class="input w-full border mt-2 @error('nik') error @enderror()" placeholder="Nik"
                    minlength="2" value="{{ old('nik') }}">
                    @error('nik')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror
            </div>
            <div class="mb-3">
                <label for="">Jenis Kelamin</label>
                <select class="input w-full border mr-2" name="jk">
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="save" class="w-4 h-4 mr-2"></i> Simpan</button>
        </form>
    </div>
@endsection
