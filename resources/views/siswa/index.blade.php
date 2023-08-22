@extends('layouts.admin')
@section('title', 'Data Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Siswa</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-siswa.create')}}" class="btn btn-primary">Tambah Data Siswa</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="siswaTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>TAHUN AJARAN</th>
                        <th>NOMER TELEPON</th>
                        <th>ALAMAT</th>
                        <th>KATEGORI</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($siswa as $i => $sis)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$sis->nisn}}</td>
                          <td>{{$sis->nis}}</td>
                          <td>{{$sis->nama}}</td>
                          <td>{{$sis->tahun_ajaran->tahun_ajaran}}</td>
                          <td>{{$sis->no_telp}}</td>
                          <td>{{$sis->alamat}}</td>
                          <td>{{$sis->spp->kategori}}</td>
                          <td>
                            <a href="{{ route('data-siswa.edit', $sis->nisn) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('data-siswa/' . $sis->nisn) }}" class="d-inline" method="POST" id="delete">
                              @csrf
                              @method('DELETE')
                              <button type="button" type="submit" class="btn btn-danger" onclick="deleteData({{ $sis->nisn }})">Hapus</button>
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
  function deleteData(nisn) {
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
      $('#delete').submit();
      console.log(result);
      console.log(nisn);
    }
  });
}
</script>

@endpush