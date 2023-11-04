<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        body {
            width: 100%;
            margin: 20px auto;
            font-size: 15px;
        }

        table {
            border-collapse: collapse;
        }

        .table-body td {
            font-size: 16px;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-right: 20px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pemerintah {
            font-size: 24px;
            font-weight: bold;
        }

        .dinas {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .laporan {
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .address {
            font-size: 14px;
            border-bottom: 2px solid black;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('assets/dist/images/logo-kominfo.png') }}" alt="logo-kominfo" width="100px">
        </div>
        <div class="company-info">
            <div class="pemerintah">PEMERINTAH DAERAH HULU SUNGAI SELATAN</div>
            <div class="dinas">DINAS KOMUNIKASI DAN INFORMATIKA</div>
            <div class="laporan">LAPORAN HASIL AKHIR & REKOMENDASI {{ Str::upper($tahun->kode) }}-{{ $tahun->tahun }}
            </div>
            <div class="address">JL.Aluh Idut, Kandangan Utara, Kec. Kandangan, Kabupaten Hulu Sungai Selatan,
                Kalimantan Selatan 71217</div>
        </div>
    </div>
    <table width="100%" class="table-body">
        <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                @foreach ($kriterias as $kriteria)
                    <th>{{ $kriteria->nama_kriteria }}</th>
                @endforeach
                <th>Total Nilai</th>
                <th>Rank</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Sort $hasil array based on $totalNilai in descending order
                $sortedHasil = $hasil->sortByDesc(function ($item) {
                    $nilai = PenelaianHelp::getRangking($item->alternatif_id);
                    $totalNilai = 0;
                    foreach ($nilai as $a) {
                        $totalNilai += $a->hasil_akhir;
                    }
                    return $totalNilai;
                });
                $rank = 1;
            @endphp
            @foreach ($sortedHasil as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    @if ($item->karyawan->status_alternatif == 'manusia')
                        <td>
                            {{ $item->karyawan->nama }}
                        </td>
                    @else
                        <td>
                            {{ $item->karyawan->judul }}
                        </td>
                    @endif
                    @php
                        $nilai = PenelaianHelp::getRangking($item->alternatif_id);
                        $totalNilai = 0;
                    @endphp
                    @foreach ($nilai as $a)
                        <td>
                            {{ round($a->hasil_akhir, 3) }}
                        </td>
                        @php
                            $totalNilai += $a->hasil_akhir;
                        @endphp
                    @endforeach
                    <td>
                        {{ round($totalNilai, 3) }}
                    </td>
                    <td>
                        {{ $rank }}
                    </td>
                </tr>
                @php
                    $rank++;
                @endphp
            @endforeach
        </tbody>
    </table>
</body>

</html>
