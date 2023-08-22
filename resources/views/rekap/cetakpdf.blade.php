<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Setor Tabungan</title>
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
            Laporan Tabungan Pondok Pesantren Al-Urwatul Wutsqo
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
                <th>TANGGAL</th>
                <th>SETOR</th>
                <th>TANGGAL</th>
                <th>TARIK</th>
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
            @foreach ($rekap as $data)
    <tr>
        <td>{{ $no++ }}</td>
        <td> 
            @isset($data->setor_tabungan)
            {{ $data->setor_tabungan->siswa->nama ?? 'Data kosong' }}
            @endisset
            @isset($data->Tarik_tabungan)
            {{ $data->Tarik_tabungan->siswa->nama ?? 'Data Kosong' }}
            @endisset</td>
        <td>{{ optional($data->setor_tabungan)->tanggal }}</td>
        <td>{{ optional($data->setor_tabungan)->setor }}</td>
        <td>{{ optional($data->tarik_tabungan)->tanggal }}</td>
        <td>{{ optional($data->tarik_tabungan)->tarik }}</td>
    </tr>
@endforeach

        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: right;">
        <strong>Total Setor: </strong> {{ $total_setor }}
    </div>
    <div style="margin-top: 20px; text-align: right;">
        <strong>Total Tarik: </strong> {{ $total_tarik }}
    </div>
    <div style="margin-top: 20px; text-align: right;">
        <strong>Total : </strong> {{ $total_keseluruhan }} 
    </div>
</body>
</html>
