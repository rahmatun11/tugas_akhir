<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekap Pembayaran Siswa</title>
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
            Laporan Rekap Pembayaran Siswa Pondok Pesantren Al-Urwatul Wutsqo
        </div>
        <div class="alamat">
            Jl. Sempurna No.32 RT/RW.04/02 Desa Sindang-Indramayu-Jawa Barat (45224) 
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NAMA SISWA</th>
                {{-- <th>TANGGAL</th> --}}
                <th>BUKU</th>
                {{-- <th>TANGGAL</th> --}}
                <th>DAT</th>
                {{-- <th>TANGGAL</th> --}}
                <th>KEGIATAN PERTAHUN</th>
                {{-- <th>TANGGAL</th> --}}
                <th>TANAH&BANGUNAN</th>
                {{-- <th>TANGGAL</th> --}}
                <th>KASUR&LEMARI</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            {{-- @foreach ($setor as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->siswa->nama}}</td>
                <td>{{ $data->Setor_tabungan->tanggal}}</td>
                <td>{{ $data->Setor_tabungan->setor }}</td>
                <td>{{ $data->Tarik_tabungan->tanggal }}</td>
                <td>{{ $data->Tarik_tabungan->tarik }}</td>
            </tr>
            @endforeach --}}
            @foreach ($rekapitulasi as $data)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $data->siswa->nama}}</td>
        <td>{{ 'Rp. ' . number_format($data->Buku['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
        <td>{{ 'Rp. ' . number_format($data->Dat['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
        <td>{{ 'Rp. ' . number_format($data->Kasur_lemari['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
        <td>{{ 'Rp. ' . number_format($data->Kegiatan_pertahun['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
        <td>{{ 'Rp. ' . number_format($data->Tanah_bangunan['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
        <td>{{ 'Rp. ' . number_format($data->jumlah_bayar??0, 0, ',', '.') }}</td>
    </tr>
@endforeach
{{-- <tr>
    <td colspan="2"><strong>Total Jumlah Bayar</strong></td>
    <td>{{ 'Rp ' . number_format($total_buku, 0, ',', '.') }}</td>
    <td>{{ 'Rp ' . number_format($total_dat, 0, ',', '.') }}</td>
    <td>{{ 'Rp ' . number_format($total_kegiatanpertahun, 0, ',', '.') }}</td>
    <td>{{ 'Rp ' . number_format($total_tanahbangunan, 0, ',', '.') }}</td>
    <td>{{ 'Rp ' . number_format($total_kasurlemari, 0, ',', '.') }}</td>
    <td>{{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}</td>
</tr> --}}

        </tbody>
    </table>

    {{-- <div style="margin-top: 20px; text-align: right;">
        <strong>Total : </strong> {{ $total_setor }}
    </div>
    <div style="margin-top: 20px; text-align: right;">
        <strong>Total Tarik: </strong> {{ $total_tarik }}
    </div> --}}
    <div style="margin-top: 20px; text-align: right;">
        <strong>Total : </strong> {{ 'Rp. ' . number_format($total_keseluruhan??0, 0, ',', '.') }}
    </div>
</body>
</html>
