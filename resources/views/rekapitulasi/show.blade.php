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
<h4 class="mt-0 header-title">Unduh rekap laporan tabungan pertanggal</h4>

{{-- <div class="col-lg-13">
    <div class="card m-b-30">
        <div class="card-body mb-3">
            <h4 class="mt-0 header-title mb-3">Unduh laporan tabungan pertanggal</h4>

            <div class="form-group row">
                <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Awal</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="tglawal" id="tglawal">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="tglakhir" id="tglakhir">
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-beetwen" mb-2>
                <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(0, 118, 172)"
                    href="/cetak-data-pertanggalrekap/{{ $tglawal }}/{{ $tglakhir }}"
                    role="button">
                    <i class="mdi mdi-download"></i> Unduh Periode
                </a>
                {{-- <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(172, 0, 129)"
                    href="{{ route('cetakpdfrekap') }}" role="button"><i
                        class="mdi mdi-download"></i>
                    Unduh Semua</a> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}} 

</div>
</div>
</div>
<div class="row">
<div class="col-13">
<div class="card m-b-30">
<div class="card-body">
    <div class="table-responsive">
<table id="datatable" class="table">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Buku</th>
            <th>Tanggal</th>
            <th>Kegiatan Pertahun</th>
            <th>Tanggal</th>
            <th>Kasur & Lemari</th>
            <th>Tanggal</th>
            <th>DAT</th>
            <th>Tanggal</th>
            <th>Tanah Bangunan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                @if ($total_buku)
                    {{ \Carbon\Carbon::parse($total_buku['tanggal_bayar'])->format('d-m-Y') }}
                @else
                    <p class="text-muted">-</p>
                @endif
            </td>
            <td>
                    {{ 'Rp ' . number_format($total_buku['jumlah_bayar'] ?? 0, 0, ',', '.') }}
            </td>
            <td>
                @if ($total_dat)
                    {{ \Carbon\Carbon::parse($total_dat['tanggal_bayar'])->format('d-m-Y') }}
                @else
                    <p class="text-muted">-</p>
                @endif
            </td>
            <td>
                    {{ 'Rp ' . number_format($total_dat['jumlah_bayar'] ?? 0, 0, ',', '.') }}
            </td>
            <td>
                @if ($total_kasurlemari)
                    {{ \Carbon\Carbon::parse($total_kasurlemari['tanggal_bayar'])->format('d-m-Y') }}
                @else
                    <p class="text-muted">-</p>
                @endif
            </td>
            <td>
                    {{ 'Rp ' . number_format($total_kasurlemari['jumlah_bayar'] ?? 0, 0, ',', '.') }}
            </td>
            <td>
                @if ($total_kegiatanpertahun)
                    {{ \Carbon\Carbon::parse($total_kegiatanpertahun['tanggal_bayar'])->format('d-m-Y') }}
                @else
                    <p class="text-muted">-</p>
                @endif
            </td>
            <td>
                {{ 'Rp ' . number_format($total_kegiatanpertahun['jumlah_bayar'] ?? 0, 0, ',', '.') }}
        </td>
        <td>
            @if ($total_tanahbangunan)
                {{ \Carbon\Carbon::parse($total_tanahbangunan['tanggal_bayar'])->format('d-m-Y') }}
            @else
                <p class="text-muted">-</p>
            @endif
        </td>
        <td>
            {{ 'Rp ' . number_format($total_tanahbangunan['jumlah_bayar'] ?? 0, 0, ',', '.') }}
    </td>
        </tr>
    </tbody>
</table>
@endsection
    @push('addon-script')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
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
