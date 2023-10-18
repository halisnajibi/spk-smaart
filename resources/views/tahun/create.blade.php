@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
          Form Tambah Data Tahun Keputusan
        </h2>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <form class="validate-form" action="/tahun" method="POST">
            @csrf
            {{-- <div class="mb-3">
                <label class="flex flex-col sm:flex-row"> Kode Tahun <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Wajib Diisi, Unik</span> </label> <input type="text" name="kode" class="input w-full border mt-2  @error('kode') error @enderror()" required> 
                @error('kode')
                <label id="name-error" class="error" for="name">{{ $message }}</label>
                @enderror
               </div> --}}
            <div class="mb-3">
                 <label class="flex flex-col sm:flex-row"> Tahun <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Wajib Diisi</span> </label> <input type="number" name="tahun" class="input w-full border mt-2  @error('tahun') error @enderror()" required> 
                 @error('tahun')
                 <label id="name-error" class="error" for="name">{{ $message }}</label>
                 @enderror
                </div>
                <div>
                    <label class="flex flex-col sm:flex-row"> Keterangan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Wajib Diisi</span> </label> <input type="text" name="keterangan" class="input w-full border mt-2  @error('keterangan') error @enderror()" required>
                    @error('keterangan')
                    <label id="name-error" class="error" for="name">{{ $message }}</label>
                    @enderror 
                   </div>
                <button type="submit" class="button text-white bg-theme-1 shadow-md mr-2 mt-3">Simpan</button>
        </form>
    </div>

@endsection