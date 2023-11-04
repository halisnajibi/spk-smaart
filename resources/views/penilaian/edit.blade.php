@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Form Edit Data Penilaian 
            {{ $penilaian[0]->alternatif->nama > 50 ? $penilaian[0]->alternatif->nama : $penilaian[0]->alternatif->judul }}

        </h2>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <form class="validate-form" novalidate="novalidate" method="POST"
            action="/penilaian/{{ $penilaian[0]->alternatif_id }}">
            @method('put')
            @csrf
            <input type="hidden" name="alternatif_id_lama" value="{{ $penilaian[0]->alternatif_id }}">
            @foreach ($penilaian as $nilai)
                @foreach ($kriterias as $item)
                    @if ($nilai->kriteria_id == $item->id)
                        <div class="mb-3">
                            <input type="hidden" name="kriteria_id[]" value="{{ $item->id }}">
                            <label for="">{{ $item->nama_kriteria }}</label>
                            <input type="text" name="nilai[]"
                                class="input w-full border mt-2 @error('nilai') error @enderror()"
                                placeholder="{{ $item->nama_kriteria }}" minlength="2" value="{{ $nilai->nilai }}">
                            @error('nilai')
                                <label id="name-error" class="error" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                    @endif
                @endforeach
            @endforeach


            <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="save" class="w-4 h-4 mr-2"></i> Update
            </button>
        </form>

    </div>
@endsection
