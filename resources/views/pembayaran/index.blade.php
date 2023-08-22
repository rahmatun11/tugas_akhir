@extends('layouts.admin')
@section('title', 'Data Pembayaran')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Pembayaran Spp</h4>
          
              <div class="col-lg-13">
                <div class="card m-b-30">
                    <div class="card-body mb-3">
                        <h4 class="mt-0 header-title mb-3">Unduh laporan pembayaran Spp pertanggal</h4>
        
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
                            <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(0, 118, 172)" href=""
                                onclick="this.href='/cetak-data-pertanggalspp/'+ document.getElementById('tglawal').value +
                                '/' + document.getElementById('tglakhir').value"
                                role="button"><i class="mdi mdi-download"></i>
                                Unduh Periode</a> &nbsp;
                            {{-- <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(172, 0, 129)"
                                href="{{ route('cetakpdf') }}" role="button"><i
                                    class="mdi mdi-download"></i>
                                Unduh Semua</a> --}}
                        </div>
                    </div>
                </div>
            </div>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-pembayaran.create')}}" class="btn btn-primary">Tambah Data Pembayaran Spp</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="pembayaranTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>TANGGAL BAYAR</th>
                        <th>BULAN BAYAR</th>
                        <th>KELAS</th>
                        <th>TAHUN AJARAN</th>
                        <th>KATEGORI</th>
                        <th>JUMLAH BAYAR</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pembayaran as $pmb)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$pmb->siswa->nama}}</td>
                          <td>{{$pmb->tanggal_bayar}}</td>
                          <td>{{$pmb->bulan_bayar}}</td>
                          <td>{{$pmb->kelas->nama_kelas}}</td>
                          <td>{{$pmb->tahun_ajaran->tahun_ajaran}}</td>
                          <td>{{$pmb->spp->kategori}}</td>
                          <td>{{ 'Rp. ' . number_format($pmb->jumlah_bayar, 0, ',', '.') }}</td>
                          <td>{{$pmb->status}}</td>
                            <td>
                              {{-- <a href="{{ url('bayar/'.$pmb->id_pembayaran)}}" class="btn btn-warning">Bayar</a> --}}
                              <a href="{{ url('data-pembayaran/'.$pmb->id_pembayaran)}}" class="btn btn-warning">Cetak</a>
                            <a href="{{ route('data-pembayaran.edit', $pmb->id_pembayaran) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('data-pembayaran/' . $pmb->id_pembayaran) }}" class="d-inline form-delete" method="POST" id="delete">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger" onclick="deleteData({{ $pmb->id_pembayaran }})">Hapus</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    <tbody>
                  </table>
                  <hr class="my-5" />
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->                  
                    </div>
                  </div>
                </div>
              <div class="row">
              </div>
            </div>
@endsection

@push('addon-script')


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function deleteData(id_pembayaran) {
  Swal.fire({
    title: 'PERINGATAN!',
    text: 'Apakah Anda Yakin Ingin Menghapus Data Ini ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yakin?',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.value) {
      // Menggunakan class .form-delete dan mencari formulir dengan ID unik sesuai data yang ingin dihapus
      $('#form-delete-' + id_pembayaran).submit();
      console.log(result);
      console.log(id_pembayaran);
    }
  });
}
</script>
{{-- @push('javascript') --}}
            {{-- Delete --}}
            {{-- <script>
                $(document).ready(function() {
                    $('body').on('click', '.delete-button', function() {
                        var id = $(this).data("id");
                        Swal.fire({
                            title: 'Apakah anda yakin ingin menghapus transaksi produk ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Hapus',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ route('data-pembayaran.destroy', ':id') }}"
                                        .replace(
                                            ':id', id),
                                    data: {
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    error: function(data) {
                                        console.log('Error:', data);
                                    }
                                });
                                setTimeout(function() {
                                        location.reload();
                                    },
                                    1000
                                ); // memberikan jeda selama 1000 milidetik atau 1 detik sebelum reload
                                let timerInterval;
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your data has been deleted.',
                                    icon: 'success',
                                    timer: 1500,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        timerInterval = setInterval(() => {}, 100);
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                        location.reload();
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        console.log('I was closed by the timer');
                                    }
                                });
                            }
                        });
                    });
                });
            </script> --}}
        {{-- @endpush --}}
@endpush