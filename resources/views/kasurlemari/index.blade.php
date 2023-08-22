@extends('layouts.admin')
@section('title', 'Data Pembayaran Kasur & Lemari')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Pembayaran Kasur & Lemari</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-kl.create')}}" class="btn btn-primary">Tambah Data Pembayaran Kasur & Lemari</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="kasurlemariTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NISN</th>
                        <th>TANGGAL BAYAR</th>
                        <th>KELAS</th>
                        <th>TAHUN AJARAN</th>
                        <th>JUMLAH BAYAR</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($kasur_lemari as $i => $kl)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$kl->siswa->nama}}</td>
                          <td>{{$kl->tanggal_bayar}}</td>
                          <td>{{$kl->kelas->nama_kelas}}</td>
                          <td>{{$kl->tahun_ajaran->tahun_ajaran}}</td>
                          <td>{{ 'Rp. ' . number_format($kl->jumlah_bayar, 0, ',', '.') }}</td>

                          <td>
                            <a href="{{ route('data-kl.edit', $kl->id_kasur_lemari) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ url('data-kl/'.$kl->id_kasur_lemari)}}" class="btn btn-warning">Cetak</a>
                            <form action="{{ url('data-kl', $kl->id_kasur_lemari) }}" class="d-inline" method="POST" id="delete">
                              @csrf
                              @method('delete')
                              <button type="button" class="btn btn-danger" onclick="deleteData({{$kl->id_kasur_lemari}})">Hapus</button>
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
  $(document).ready(function(){
    $('#kasurlemariTable').DataTable();
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