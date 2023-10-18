@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8 mb-2">
        <h2 class="text-lg font-medium mr-auto">
            Hasil Akhir Perhitungan & Perangkingan
        </h2>
    </div>
    <form action="/perangkingan/cari" method="post">
        @csrf
        <label for="">Tahun Keputusan</label>
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
            <div class="font-medium text-lg">Selamat..</div>
        </div>
        <div class="mt-3">Proses SMART sudah selesai,silahkan cari hasil perangkingan berdasarkan tahun keputusan nya</div>
    </div>

@endsection
