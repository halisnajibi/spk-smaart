@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Form Tambah Data Penilaian Alternatif
        </h2>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <form class="validate-form" novalidate="novalidate" method="POST" action="/penilaian">
            @csrf
            <label>Tahun Keputusan</label>
            <div class="my-2">
                <select class="select2 w-full" name="tahun_id" id="tahun_keputusan_penilaian">
                    <option value="">--Pilih--</option>
                    @foreach ($tahuns as $tahun)
                        <option value="{{ $tahun->id }}">{{ $tahun->tahun }}-{{ $tahun->keterangan }}</option>
                    @endforeach
                </select>
                @error('tahun_id')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                @enderror
            </div>

            <div class="my-2">
                <select class="select2 w-full " name="karyawan_id" id="alternatif">
                    <option value="">--Pilih--</option>
                </select>
            </div>

            <div class="mb-3" id="alternatif-box">

            </div>
            <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="save" class="w-4 h-4 mr-2"></i> Simpan
            </button>
        </form>



        {{-- <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#basic-modal-preview" class="button inline-block bg-theme-1 text-white">Show Modal</a> </div> --}}
        <div class="modal hidden" id="basic-modal-preview">
            <div class="modal__content p-10 text-center"> This is totally awesome blank modal! </div>
        </div>


    </div>
@endsection
