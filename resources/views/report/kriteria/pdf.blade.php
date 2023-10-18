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
            <div class="laporan">LAPORAN DATA KRITERIA & BOBOT TAHUN {{ Str::upper($tahun->kode)  }}-{{ $tahun->tahun }}</div>
            <div class="address">JL.Aluh Idut, Kandangan Utara, Kec. Kandangan, Kabupaten Hulu Sungai Selatan,
                Kalimantan Selatan 71217</div>
        </div>
    </div>
    <table width="100%" class="table-body">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Bobot Awal</th>
                <th>Konversi</th>
                <th>Bobot Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriterias as $kriteria)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kriteria->kode_kriteria }}</td>
                    <td>{{ $kriteria->nama_kriteria }}</td>
                    <td>{{ $kriteria->bobot }}</td>
                    <td> {{ $kriteria->bobot }}/{{ $totalBobot }}%</td>
                    <td> {{ round($kriteria->bobot / $totalBobot, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Bobot</td>
                <td>{{ $totalBobot }}%</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
