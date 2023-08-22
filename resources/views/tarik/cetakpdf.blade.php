<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tarik Tabungan </title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
    <h2>Laporan Tarik Tabungan Pondok Pesantren Al-Urwatul Wutsqo</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Tingkat</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Tarik</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($tarik as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->siswa->nama}}</td>
                <td>{{ $data->tingkat->tingkat }}</td>
                <td>{{ $data->kelas->nama_kelas }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->tarik }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: right;">
        <strong>Total Tarik: </strong> {{ $total_tarik }}
    </div>
</body>
</html>
