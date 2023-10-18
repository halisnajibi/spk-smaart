@extends('layouts.app')
@section('content')
    <a href="/kriteria" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
        <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Kriteria
        </h2>
      
    </div>
    <div class="rounded-md px-5 py-4 mb-2 border text-gray-700">
        <div class="flex items-center">
            <div class="font-medium text-md">Tahun Pengambilan Keputusan :{{ $tahun->kode }}/{{ $tahun->tahun }}</div>
            <div class="text-xs bg-gray-600 px-1 rounded-md text-white ml-auto">{{ $tahun->status }}</div>
        </div>
        <div class="mt-3">{{ $tahun->keterangan }}.</div>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
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


        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Kode Kriteria</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Nama Kriteria</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Bobot</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Label</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($kriterias as $kriteria)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $kriteria->kode_kriteria }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-b">{{ $kriteria->nama_kriteria }}</td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $kriteria->bobot }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $kriteria->label }}
                                </div>
                            </div>
                        </td>
                        <td class="border-b w-5">
                            <div class="flex sm:justify-center items-center">
                                <a href="/kriteria/{{ $kriteria->id }}/edit" class="flex items-center mr-3" href="">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a href="javascript:;" onclick="konfirmasiHapus('<?= $kriteria['id'] ?>')"
                                    class="flex items-center sm:justify-center text-theme-6"> <i data-feather="trash-2"
                                        class="w-4 h-4 mr-2"></i>Hapus</a>
                            </div>
                        </td>
                    </tr>
                    @php
                        
                        $total += intval($kriteria->bobot);
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <!-- Bagian footer tabel (tfoot) -->
                <tr>
                    <td colspan="3" class="text-right font-bold">Total Bobot:</td>
                    <td class="text-center font-bold">{{ $total }}%</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>
    {{-- modal  hapus --}}
    <div class="modal" id="delete-modal-preview">
        <div class="modal__content">
            <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Apakah anda yakin?</div>
                <div class="text-gray-600 mt-2">Data akan dihapus secara permanen.</div>
            </div>
            <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal"
                    class="button w-24 border bg-gray-300 mr-1">Cancel</button>
                <form method="POST" id="form-hapus">
                    @csrf
                    @method('delete')
                    <button type="submit" class="button w-24 border bg-theme-6 text-white mt-3 mr-1"
                        id="tombol-hapus">Hapus </button>
                </form>
            </div>
        </div>
    </div>
@endsection
