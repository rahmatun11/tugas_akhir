@extends('layouts.admin')
@section('title', 'Data Laporan Tabungan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Laporan tabungan</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                {{-- <div class="card-header">
                  <a href="{{route('data-tabungan.create')}}" class="btn btn-primary">Tambah Data Laporan Tabungan</a>
                  <hr>
                </div> --}}
                <div class="table-responsive text-nowrap">
                  <table class="table" id="laporan_tabunganTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>TANGGAL PELAPORAN</th>
                        <th>BULAN PELAPORAN</th>
                        <th>TAHUN AJARAN</th>
                        <th>KETERANGAN</th>
                        <th>DOKUMEN</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($laporan_tabungan as $i => $lt)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$lt->tanggal_laporan}}</td>
                          <td>{{$lt->bulan_laporan}}</td>
                          <td>{{$lt->tahun_ajaran->tahun_ajaran}}</td>
                          <td>{{$lt->keterangan}}</td>
                          <td>
                          <a href="{{ Storage::url($lt->dokumen) }}" download="Laporan Tabungan {{ $lt->id_laporan_tabungan }}" class="btn btn-primary">Download</a>
                         </td>
                          <td>
                            <a href="{{ route('data-tabungan.edit', $lt->id_laporan_tabungan) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('data-tabungan', $lt->id_laporan_tabungan) }}" class="d-inline" method="POST" id="delete">
                              @csrf
                              @method('delete')
                              <button type="button" class="btn btn-danger" onclick="deleteData({{$lt->id_laporan_tabungan}})">Hapus</button>
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
    $('#laporan_tabunganTable').DataTable();
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