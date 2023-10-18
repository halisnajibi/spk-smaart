@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Form Edit Data Kriteria
        </h2>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <form class="validate-form" novalidate="novalidate"  method="POST" action="/kriteria/{{ $kriteria->id }}">
            @method('put')
            @csrf
            <div class="mb-3">
                <label class="flex flex-col sm:flex-row"> Kode Kriteria <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Unique</span>
                </label>
                <input type="text" name="kode_kriteria" class="input w-full border mt-2 @error('kode_kriteria') error @enderror()" placeholder="Kode Kriteria"
                    minlength="2" value="{{ old('kode_kriteria',$kriteria->kode_kriteria) }}">
                    @error('kode_kriteria')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror
            </div>
            <div class="mb-3">
                <label class="flex flex-col sm:flex-row">Nama Kriteria <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required</span>
                </label>
                <input type="text" name="nama_kriteria" class="input w-full border mt-2 @error('nama_kriteria') error @enderror()" placeholder="Nama Kriteria"
                    minlength="2"  value="{{ old('nama_kriteria',$kriteria->nama_kriteria) }}">
                    @error('nama_kriteria')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror
            </div>
            <div class="mb-3">
                <label class="flex flex-col sm:flex-row"> Bobot <span
                        class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required</span>
                </label>
                <input type="text" name="bobot" class="input w-full border mt-2 @error('bobot') error @enderror()" placeholder="Bobot"
                    minlength="2" value="{{ old('bobot',$kriteria->bobot) }}">
                    @error('bobot')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror
            </div>
            <div class="mb-3">
                 <label>Label Kriteria</label>
                <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-chris-evans" name="label" value="const"{{ ($kriteria->label == 'const') ? 'checked' : '' }}> 
                    <label class="cursor-pointer select-none" for="vertical-radio-chris-evans">Const</label> 
                </div>
                <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="benefit" name="label" value="benefit"{{ ($kriteria->label == 'benefit') ? 'checked' : '' }}> <label class="cursor-pointer select-none" for="benefit">Benefit</label> 
                </div>
                @error('label')
                <label id="name-error" class="error" for="name">{{ $message }}</label>
                @enderror
            </div>
            <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="save" class="w-4 h-4 mr-2"></i> Update</button>
        </form>
    </div>
@endsection
