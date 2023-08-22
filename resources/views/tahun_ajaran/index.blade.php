@extends('layouts.admin')
@section('title', 'Data Tahun Ajaran')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Tahun Ajaran</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-tahun.create')}}" class="btn btn-primary">Tambah Data Tahun Ajaran</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="tahun_ajaranTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>TAHUN AJARAN</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($tahun_ajaran as $i => $ta)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$ta->tahun_ajaran}}</td>
                          <td>
                            <a href="{{ route('data-tahun.edit', $ta->id_tahun_ajaran) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('data-tahun', $ta->id_tahun_ajaran) }}" class="d-inline" method="POST" id="delete">
                              @csrf
                              @method('delete')
                              <button type="button" class="btn btn-danger" onclick="deleteData({{$ta->id_tahun_ajaran}})">Hapus</button>
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
    $('#tahun_ajaranTable').DataTable();
  });
  
  function deleteData(id) {
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
        var url = "{{ url('data-tahun') }}" + "/" + id;
        $('#delete').attr('action', url);
        $('#delete').submit();
      }
    })
  }
</script>
@endpush