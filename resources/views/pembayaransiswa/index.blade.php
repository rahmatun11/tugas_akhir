@extends('layouts.admin')
@section('title', 'Data Pembayaran')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Pembayaran Spp</h4>
          
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
                        <th>BAYAR UNTUK BULAN</th>
                        <th>KELAS</th>
                        <th>TAHUN AJARAN</th>
                        <th>KATEGORI</th>
                        <th>JUMLAH BAYAR</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pembayaran as $i => $pmb)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$pmb->siswa->nama}}</td>
                          <td>{{$pmb->tanggal_bayar}}</td>
                          <td>{{$pmb->bulan_bayar}}</td>
                          <td>{{$pmb->kelas->nama_kelas}}</td>
                          <td>{{$pmb->tahun_ajaran->tahun_ajaran}}</td>
                          <td>{{$pmb->spp->kategori}}</td>
                          <td>{{ 'Rp. ' . number_format($pmb->jumlah_bayar, 0, ',', '.') }}</td>
                          <td>{{$pmb->status}}</td>
                          <td>
                            <a href="{{ url('data-pembayaran/'. $pmb->id_pembayaran)}}" class="btn btn-warning">Lihat</a>
                            <a href="{{ route('bayar', $pmb->id_pembayaran) }}" class="btn btn-warning">Bayar</a>
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
  $(document).ready(function(){
    $('#pembayaranTable').DataTable();
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
    }).then((result)=>{
      if(result.value){
        $('#delete').submit();
      }
    })
  }
</script>
@endpush