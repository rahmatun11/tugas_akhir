@extends('layouts.admin')
@section('title', 'Data Kategori Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Kategori Siswa</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-kategori.create')}}" class="btn btn-primary">Tambah Data Kategori Siswa</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="sppTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>KATEGORI</th>
                        <th>NOMINAL</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($spp as $i => $kategori)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$kategori->kategori}}</td>
                          <td>{{$kategori->nominal}}</td>
                          <td>
                            <a href="{{ route('data-kategori.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('data-kategori', $kategori->id) }}" class="d-inline" method="POST" id="delete">
                              @csrf
                              @method('delete')
                              <button type="button" class="btn btn-danger" onclick="deleteData({{$kategori->id}})">Hapus</button>
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
    $('#sppTable').DataTable();
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
        var url = "{{ url('data-kategori') }}" + "/" + id;
        $('#delete').attr('action', url);
        $('#delete').submit();
      }
    })
  }
</script>
@endpush