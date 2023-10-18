            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-10"
                        src="{{ asset('assets/dist/images/logo-kominfo.png') }}">
                    <span class="hidden xl:block text-white text-lg ml-3"> Kominfo <span class="font-medium">- HSS</span>
                    </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="/dashboard"
                            class="side-menu {{ request()->is('dashboard') ? 'side-menu--active' : '' }} ">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                    @php
                        if (request()->is('tahun*') || request()->is('kriteria*') || request()->is('konversi/bobot') || request()->is('alternatif*')) {
                            $active = 'side-menu__sub-open';
                            $active2 = 'side-menu--active';
                        } else {
                            $active = '';
                            $active2 = '';
                        }
                    @endphp
                    <li>
                        <a href="javascript:;" class="side-menu {{ $active2 }}">
                            <div class="side-menu__icon"> <i data-feather="database"></i> </div>
                            <div class="side-menu__title"> Master Data <i data-feather="chevron-down"
                                    class="side-menu__sub-icon"></i> </div>
                        </a>

                        {{-- } --}}
                        <ul class="{{ $active }}">
                            <li>
                                <a href="/tahun"
                                    class="side-menu {{ request()->is('tahun*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title">Data Tahun Keputusan </div>
                                </a>
                            </li>
                            @php
                                if (request()->is('kriteria') || request()->is('kriteria/create')) {
                                    $k = 'side-menu--active';
                                } else {
                                    $k = '';
                                }
                            @endphp
                            <li>
                                <a href="/kriteria" class="side-menu {{ $k }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Data Kriteria </div>
                                </a>
                            </li>
                            @php
                                if (request()->is('kriteria/bobot') || request()->is('kriteria/bobot/cari')) {
                                    $a = 'side-menu--active';
                                } else {
                                    $a = '';
                                }
                            @endphp
                            <li>
                                <a href="/kriteria/bobot" class="side-menu {{ $a }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title">Data Konversi Bobot </div>
                                </a>
                            </li>
                            <li>
                                <a href="/alternatif"
                                    class="side-menu {{ request()->is('alternatif*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Data Alternatif </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @php
                        if (request()->is('penilaian*') || request()->is('pengolahan/nilai*')) {
                            $active3 = 'side-menu__sub-open';
                            $active4 = 'side-menu--active';
                        } else {
                            $active3 = '';
                            $active4 = '';
                        }
                    @endphp
                    <li class="side-nav__devider my-6"></li>
                    <li>
                        <a href="javascript:;" class="side-menu {{ $active4 }}">
                            <div class="side-menu__icon"> <i data-feather="edit"></i> </div>
                            <div class="side-menu__title"> Penilaian <i data-feather="chevron-down"
                                    class="side-menu__sub-icon"></i> </div>
                        </a>
                        <ul class="{{ $active3 }}">
                            <li>
                                <a href="/penilaian"
                                    class="side-menu  {{ request()->is('penilaian*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Penilai Alternatif </div>
                                </a>
                            </li>
                            <li>
                                <a href="/pengolahan/nilai"
                                    class="side-menu  {{ request()->is('pengolahan/nilai*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title">Konversi Nilai</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @php
                        if (request()->is('perhitungan*') || request()->is('perangkingan*')) {
                            $active5 = 'side-menu__sub-open';
                            $active6 = 'side-menu--active';
                        } else {
                            $active5 = '';
                            $active6 = '';
                        }
                        
                    @endphp
                    <li>
                        <a href="javascript:;" class="side-menu {{ $active6 }}">
                            <div class="side-menu__icon"> <i data-feather="trello"></i> </div>
                            <div class="side-menu__title"> Hasil <i data-feather="chevron-down"
                                    class="side-menu__sub-icon"></i> </div>
                        </a>
                        <ul class="{{ $active5 }}">
                            <li>
                                <a href="/perhitungan"
                                    class="side-menu {{ request()->is('perhitungan*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title">Nilai Akhir</div>
                                </a>
                            </li>
                            <li>
                                <a href="/perangkingan"
                                    class="side-menu {{ request()->is('perangkingan*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Perangkingan </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="side-nav__devider my-6"></li>
                    @php
                        if (request()->is('laporan/kriteria*') || request()->is('laporan/alternatif*') ||  request()->is('laporan/penilaian*') || request()->is('laporan/skor*')||  request()->is('laporan/rekomendasi*') ||  request()->is('laporan/riwayat*')) {
                            $active7 = 'side-menu__sub-open';
                            $active8 = 'side-menu--active';
                        } else {
                            $active7 = '';
                            $active8 = '';
                        }
                        
                    @endphp
                    <li>
                        <a href="javascript:;" class="side-menu {{ $active8 }}">
                            <div class="side-menu__icon"> <i data-feather="sidebar"></i> </div>
                            <div class="side-menu__title"> Laporan <i data-feather="chevron-down"
                                    class="side-menu__sub-icon"></i> </div>
                        </a>
                        <ul class="{{ $active7 }}">
                            <li>
                                <a href="/laporan/kriteria" class="side-menu {{ request()->is('laporan/kriteria*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Laporan Kriteria </div>
                                </a>
                            </li>
                            <li>
                                <a href="/laporan/alternatif" class="side-menu  {{ request()->is('laporan/alternatif*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Laporan Alternatif </div>
                                </a>
                            </li>
                            <li>
                                <a href="/laporan/penilaian" class="side-menu  {{ request()->is('laporan/penilaian*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Laporan Penilaian </div>
                                </a>
                            </li>
                            <li>
                                <a href="/laporan/skor" class="side-menu  {{ request()->is('laporan/skor*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Laporan Skor </div>
                                </a>
                            </li>
                            <li>
                                <a href="/laporan/rekomendasi" class="side-menu  {{ request()->is('laporan/rekomendasi*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title"> Laporan Rekomendasi</div>
                                </a>
                            </li>
                            <li>
                                <a href="/laporan/riwayat" class="side-menu  {{ request()->is('laporan/riwayat*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                    <div class="side-menu__title">Laporan Riwayat Keputusan </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- END: Side Menu -->
