<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Struk Pembayaran SPP</title>
  <style>
    /* Gaya tampilan struk */
    body {
      font-family: Arial, sans-serif;
      line-height: 1.5;
      margin: 0;
      padding: 20px;
    }
    
    h2 {
      text-align: center;
    }
    
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f2f2f2;
    }
    
    .total-row {
      font-weight: bold;
    }
    
    @media print {
      /* Gaya tampilan ketika dicetak */
      body {
        padding: 0;
      }
      
      .container {
        border: none;
      }
      
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    

    <h2>Struk Pembayaran Kasur & Lemari</h2>

    <table>
      <tr>
        <th colspan="2">Informasi Siswa</th>
      </tr>
      <tr>
        <td>Nama Siswa: </td>
        <td>{{$kasur_lemari->siswa->nama}}</td>
      </tr>
      <tr>
        <td>Kelas:</td>
        <td>{{$kasur_lemari->kelas->nama_kelas}}</td>
      </tr>
      <tr>
        <td>Tahun Ajaran:</td>
        <td>{{$kasur_lemari->tahun_ajaran->tahun_ajaran}}</td>
      </tr>
      <tr>
    </table>

    <table>
      <tr>
        <th>Deskripsi</th>
        <th>Jumlah</th>
      </tr>
      <tr>
        <td>Tanggal Pembayaran: </td>
        <td>{{$kasur_lemari->tanggal_bayar}}</td>
      </tr>
      <tr class="total-row">
        <td>total:</td>
        <td>{{ 'Rp. ' . number_format($kasur_lemari->jumlah_bayar, 0, ',', '.') }}</td>
      </tr>
    </table>


    <p>Terima kasih atas pembayaran Anda. Silakan simpan struk ini sebagai bukti pembayaran yang sah.</p>

    <div class="no-print">
      <button onclick="window.print()"><i class="fa fa-print"></i>Cetak</button>
    </div>
</div>
</body>




