@extends('layouts.app')
@section('content')
    @if (session()->has('login'))
        <div class="modal" id="success-modal-preview">
            <div class="modal__content">
                <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Selamat Datang!</div>
                    <div class="text-gray-600 mt-2">{{ session('login') }} {{ Auth::user()->name }}</div>
                </div>
                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal"
                        class="button w-24 bg-theme-1 text-white">Ok</button> </div>
            </div>
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mb-20">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="users" class="report-box__icon text-theme-10"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $alternatif }}</div>
                                <div class="text-base text-gray-600 mt-1">Semua Alternatif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="award" class="report-box__icon text-theme-11"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $kriteria }}</div>
                                <div class="text-base text-gray-600 mt-1">Semua Kriteria</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $tahun }}</div>
                                <div class="text-base text-gray-600 mt-1">Tahun Keputusan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="file-text" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $riwayat }}</div>
                                <div class="text-base text-gray-600 mt-1">Riwayat Perangkingan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Grafik Alternatif
                    </h2>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="report-chart" id="chart-alternatif"> </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Grafik Kriteria
                    </h2>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="report-chart" id="chart-kriteria"> </div>
                </div>
            </div>
            <!-- END: Sales Report -->
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/dist/lib/dist/apexcharts.css') }}">
@endpush
@push('myscript')
    <script src="{{ asset('assets/dist/lib/dist/apexcharts.js') }}"></script>
    <script>
        //chart jumlah alternatif
        var data = @json($chartAlternatif);
        var categories = data.map(row => row.tahun.kode + '-' + row.tahun.tahun);
        var seriesData = data.map(row => row.jumlah_alternatif);
        var options = {
            chart: {
                type: 'bar'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    }
                },
            },
            xaxis: {
                categories: categories
            },
            title: {
                text: 'Jumlah Alternatif',
            },
            series: [{
                name: 'Jumlah Alternatif',
                data: seriesData
            }]
        }
        var chart = new ApexCharts(document.querySelector("#chart-alternatif"), options);
        chart.render();

        //chart jumlah kriteria
        var dataKriteria = @json($chartKriteria);
        var kriteria = dataKriteria.map(row => row.jumlah_kriteria);
        var labels = data.map(row => row.tahun.kode + '-' + row.tahun.tahun);
        var options = {
            chart: {
                type: 'bar'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    }
                },
            },
            xaxis: {
                categories: labels
            },
            title: {
                text: 'Jumlah Kriteria',
            },
            series: [{
                name: 'Jumlah Kriteria',
                data: kriteria
            }]
        }
        var chart = new ApexCharts(document.querySelector("#chart-kriteria"), options);
        chart.render();
    </script>
    <script>
        // Memunculkan modal saat halaman dimuat
        window.addEventListener('DOMContentLoaded', (event) => {
            if($('#success-modal-preview').length){

                $('#success-modal-preview').modal('show'); // Menggunakan jQuery untuk memicu modal
            }
        });
      </script>
      
@endpush
