@extends('layouts.admin')
@section('title', 'Data Rekap Pembayaran Siswa')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            
              <div class="container-xxl flex-grow-1 container-p-y">
<h4 class="mt-0 header-title">Data Rekap Pembayaran Siswa</h4>
</div>
</div>
</div>
<div class="col-lg-13">
<div class="card m-b-30">
<div class="card-body">
<h4 class="mt-0 header-title">Unduh rekap laporan Pembayaran Siswa pertanggal</h4>

<div class="card m-b-30">
    <div class="card-body mb-3">
        <h4 class="mt-0 header-title mb-3">Unduh laporan Pembayaran Siswa pertanggal</h4>

        <!-- Form for date input -->
        <form action="{{ route('cetak-pertanggal-rekapitulasi') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="tglawal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="tglawal" id="tglawal">
                </div>
            </div>
            <div class="form-group row">
                <label for="tglakhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="tglakhir" id="tglakhir">
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-between" mb-2>
                <button type="submit" class="btn btn-info btn-sm mb-2" style="background-color: rgb(0, 118, 172)">
                    <i class="mdi mdi-download"></i> Unduh Periode
                </button>
            </div>
        </form>
    </div>
</div>

</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="card m-b-30">
<div class="card-body">
    <div class="table-responsive">
<table id="datatable" class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>DAT</th>
            <th>Kasur&Lemari</th>
            <th>Kegiatan Pertahun</th>
            <th>Tanah&Bangunan</th>
            <th>Jumlah Bayar</th>
            {{-- <th>Action</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($rekapitulasiData as $rekap)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $rekap->siswa->nama}}</td>
                <td>{{ 'Rp. ' . number_format($rekap->Buku['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
                <td>{{ 'Rp. ' . number_format($rekap->Dat['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
                <td>{{ 'Rp. ' . number_format($rekap->Kasur_lemari['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
                <td>{{ 'Rp. ' . number_format($rekap->Kegiatan_pertahun['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
                <td>{{ 'Rp. ' . number_format($rekap->Tanah_bangunan['jumlah_bayar'] ??0, 0, ',', '.') }}</td></td>
                <td>{{ 'Rp. ' . number_format($rekap->jumlah_bayar??0, 0, ',', '.') }}</td>
                {{-- <td>
                    <a href="{{ route('rekapitulasi.show', ['name'=>$rekap->nama]) }}" class="btn btn-warning">Lihat</a>
                </td> --}}
            </tr>
            
        @endforeach
    </tbody>
</table>


    @endsection

    @push('addon-script')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#setor_tabunganTable').DataTable();
            });

            function deleteData() {
                Swal.fire({
                    title: 'PERINGATAN!',
                    text: 'Apakah Anda Yakin Ingin Menghapus Data Ini ?',
                    icon: 'warning',
                    showCancelButton: 'true',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin?',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        $('#delete').submit();
                    }
                })
            }
        </script>
    @endpush
