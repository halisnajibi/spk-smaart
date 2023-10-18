@extends('layouts.app')
@section('content')
<a href="/alternatif" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
    <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Konversi Bobot
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
        @if ($alternatifs[0]->status_alternatif == 'manusia')         
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Nik</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Nama</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Jenis Kelamin</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatifs as $alternatif)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $alternatif->nik }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-b">{{ $alternatif->nama}}</td>
                        <td class="text-center border-b">{{ $alternatif->jk}}</td>
                        <td class="border-b w-5">
                            <div class="flex sm:justify-center items-center">
                                <a href="/alternatif/{{ $alternatif->id }}/edit" class="flex items-center mr-3" href="">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a href="javascript:;" onclick="konfirmasiHapus('<?= $alternatif['id'] ?>')"
                                    class="flex items-center sm:justify-center text-theme-6"> <i data-feather="trash-2"
                                        class="w-4 h-4 mr-2"></i>Hapus</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach()
            </tbody>
        </table>
        @else
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">No</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Judul</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">Keterangan</th>

                    <th class="border-b-2 text-center whitespace-no-wrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatifs as $alternatif)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $loop->iteration }}</div>
                        </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center">
                                <div class="intro-x w-10 h-10 image-fit">
                                    {{ $alternatif->judul }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-b">{{ $alternatif->keterangan}}</td>
                        <td class="border-b w-5">
                            <div class="flex sm:justify-center items-center">
                                <a href="/alternatif/{{ $alternatif->id }}/edit" class="flex items-center mr-3" href="">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a href="javascript:;" onclick="konfirmasiHapus('<?= $alternatif['id'] ?>')"
                                    class="flex items-center sm:justify-center text-theme-6"> <i data-feather="trash-2"
                                        class="w-4 h-4 mr-2"></i>Hapus</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach()
            </tbody>
        </table>
        @endif
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
                        <button type="submit" class="button w-24 border bg-theme-6 text-white mt-3 mr-1" id="tombol-hapus">Hapus </button>
                    </form>
            </div>
        </div>
    </div>
    @endsection

