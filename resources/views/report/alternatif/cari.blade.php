@extends('layouts.app')
@section('content')
<a href="/laporan/alternatif" class="button w-32 mr-2 my-2 flex items-center justify-center bg-theme-9 text-white">
    <i data-feather="corner-up-left" class="w-4 h-4 mr-2"></i> Kembali </a>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Data Alternatif {{ $alternatifs[0]->tahun->kode }}-{{ $alternatifs[0]->tahun->tahun }}
        </h2>
        <a href="/laporan/alternatif/cetak/{{ $alternatifs[0]->tahun->id }}" target="_blank" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Cetak Data </a>
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


