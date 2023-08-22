<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran Spp Murid</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kop-surat {
            padding: 20px;
            border-bottom: 2px solid #000;
        }
        
        .logo {
            display: inline-block;
            vertical-align: middle;
        }
        
        .logo img {
            height: 80px;
        }
        
        .judul-kop {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .alamat {
            margin-top: 10px;
            font-size: 14px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <div class="logo">
            <img src="{{asset('assets/img/Logo-Wutsqo.png')}}" alt="Logo Pondok Pesantren Al-Urwatul Wutsqo">
        </div>
        <div class="judul-kop">
            Laporan Pembayaran Spp Murid Sekolah Al-Urwatul Wutsqo
        </div>
        <div class="alamat">
            Jl. Sempurna No.32 RT/RW.04/02 Desa Sindang-Indramayu-Jawa Barat (45224) 
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama lengkap</th>
                <th>Tanggal</th>
                <th>bayar untuk bulan</th>
                <th>kelas</th>
                <th>tahun ajaran</th>
                <th>Kategori</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($pembayaran as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->siswa->nama}}</td>
                <td>{{ $data->tanggal_bayar }}</td>
                <td>{{ $data->bulan_bayar }}</td>
                <td>{{ $data->kelas->nama_kelas }}</td>
                <td>{{ $data->tahun_ajaran->tahun_ajaran }}</td>
                <td>{{ $data->spp->kategori }}</td>
                <td>{{ 'Rp. ' . number_format($data->spp->nominal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: right;">
        <strong>Total Pembayaran SPP: </strong> {{ 'Rp. ' . number_format($total_pembayaran, 0, ',', '.') }}
    </div>
</body>
</html>
