
@extends('layouts.app')
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8 mb-2">
        <h2 class="text-lg font-medium mr-auto">
            Data Koversi Nilai Alternatif
        </h2>
    </div>
    <form action="/perhitungan/cari" method="post">
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
            <div class="font-medium text-lg">Pemberitahuan!!</div>
        </div>
        <div class="mt-3">Tahun keputusan di atas yang mempunyai status dikonversi atau selesai.Jika tahun keputusan tidak tersedia berarti nilai belum dikonversi,silahkan konversi nilai  <a href="pengolahan/nilai" class="text-theme-6 px-3">disini</a>terlebih dahulu.Setelah itu lakukan perangkingan untuk menyelesaikan proses pengambilan keputusan</div>
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
