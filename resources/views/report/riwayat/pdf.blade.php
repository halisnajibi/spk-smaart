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
            border: 1px solid rgba(247, 245, 247, 0.667)
        }

        .table-body td {
            font-size: 16px;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            text-align: center;
            word-wrap: break-word;
            white-space: normal;
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
            <div class="laporan">LAPORAN HASIL RIWAYAT PERANGKINGAN</div>
            <div class="address">JL.Aluh Idut, Kandangan Utara, Kec. Kandangan, Kabupaten Hulu Sungai Selatan,
                Kalimantan Selatan 71217</div>
        </div>
    </div>
    <table width="100%" class="table-body">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Tahun Keputusan</th>
                <th>Tahun Keputusan</th>
                <th>Keterangan</th>
                <th>Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayats as $riwayat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                     <td>{{ $riwayat->tahun->kode }}</td>
                    <td>{{ $riwayat->tahun->tahun }}</td>
                    <td>{{ $riwayat->tahun->keterangan }}</td>
                    @if ($riwayat->alternatif->status_alternatif == 'manusia')
                        <td>{{ $riwayat->alternatif->nama }}</td>
                    @else
                        <td>{{ $riwayat->alternatif->judul }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta ex sint, rerum autem dolorem nulla totam cum quam placeat unde porro illum, quidem reiciendis in! Alias mollitia dolor a amet!