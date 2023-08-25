@php
    use App\Models\Setor_tabungan;
    use App\Models\Tarik_tabungan;
@endphp

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

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <div class="logo">
            <img src="{{ asset('assets/img/Logo-Wutsqo.png') }}" alt="Logo Pondok Pesantren Al-Urwatul Wutsqo">
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
                <th>Nama</th>
                <th>Kelas</th>
                <th>Nomor Hp</th>
                <th>Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['rekap'] as $item)

                @php
                    $setor = Setor_tabungan::where('id_kelas', $data["selectedKelasId"])
                        ->where('nisn', $item->nisn)
                        ->sum('setor');
                    
                    $tarik = Tarik_tabungan::where('id_kelas', $data["selectedKelasId"])
                        ->where('nisn', $item->nisn)
                        ->sum('tarik');
                    
                    $hasil = abs($setor - $tarik);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>
                        {{ $item->siswa->nama }}
                    </td>
                    <td>
                        {{ $item->kelas->nama_kelas }}
                    </td>
                    <td>
                        {{ $item->siswa->no_telp }}
                    </td>
                    <td>
                        {{ 'Rp. ' . number_format($hasil, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    Total Tarik: {{ 'Rp ' . number_format($data['total_tarik'], 0, ',', '.') }}
    <br>
    Total Setor: {{ 'Rp ' . number_format($data['total_setor'], 0, ',', '.') }}
    <br>
    Saldo Akhir: {{ 'Rp' . number_format($data['total_keseluruhan'], 0, ',', '.') }}
</body>

</html>
