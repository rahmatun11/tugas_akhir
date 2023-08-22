@extends('layouts.admin')
@section('title', 'Data Tahun Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Tahun Siswa</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-sista.create')}}" class="btn btn-primary">Tambah Data Tahun Siswa</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="siswa_tahunTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NISN</th>
                        <th>TINGKAT</th>
                        <th>KELAS</th>
                        <th>TAHUN AJARAN</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($siswa_tahun as $i => $st)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$st->siswa->nama}}</td>
                          <td>{{$st->tingkat->tingkat}}</td>
                          <td>{{$st->kelas->nama_kelas}}</td>
                          <td>{{$st->tahun_ajaran->tahun_ajaran}}</td>

                          <td>
                            <a href="{{ route('data-sista.edit', $st->id_siswa_tahun) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('data-sista', $st->id_siswa_tahun) }}" class="d-inline" method="POST" id="delete">
                              @csrf
                              @method('delete')
                              <button type="button" class="btn btn-danger" onclick="deleteData({{$st->id_siswa_tahun}})">Hapus</button>
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
    $('#siswa_tahunTable').DataTable();
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