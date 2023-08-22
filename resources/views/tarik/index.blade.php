@extends('layouts.admin')
@section('title', 'Data Penarikan Tabungan Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin Sekolah/</span> Data Penarikan Tabungan Siswa</h4>
              <div class="card">
              <div class="card-header">
                <h3>Total Penarikan Tabungan</h3>
                <h3>{{ 'Rp'.number_format($total_tarik,0,',','.') }}</h3>
              </div>
              <div class="col-lg-13">
                <div class="card m-b-30">
                    <div class="card-body mb-3">
                        <h4 class="mt-0 header-title mb-3">Unduh laporan pengeluaran tabungan pertanggal</h4>
        
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
                                onclick="this.href='/cetak-data-pertanggaltarik/'+ document.getElementById('tglawal').value +
                                '/' + document.getElementById('tglakhir').value"
                                role="button"><i class="mdi mdi-download"></i>
                                Unduh Periode</a> &nbsp;
                            {{-- <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(172, 0, 129)"
                                href="{{ route('cetakpdftarik') }}" role="button"><i
                                    class="mdi mdi-download"></i>
                                Unduh Semua</a> --}}
                        </div>
                    </div>
                </div>
            </div>
              </div>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-tarik.create')}}" class="btn btn-primary">Tambah Data Penarikan Tabungan</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="tarik_tabunganTable" >
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NISN</th>
                        <th>TINGKAT</th>
                        <th>KELAS</th>
                        <th>TANGGAL</th>
                        <th>TARIK</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($tarik_tabungan as $i => $tr)
                        <tr>
                          <td>{{$i += 1}}</td>
                          <td>{{$tr->siswa->nama}}</td>
                          <td>{{$tr->tingkat->tingkat}}</td>
                          <td>{{$tr->kelas->nama_kelas}}</td>
                          <td>{{$tr->tanggal}}</td>
                          <td>{{$tr->tarik}}</td>
                          <td>
                            <a href="{{ route('data-tarik.edit', $tr->id_tarik_tabungan) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('data-tarik', $tr->id_tarik_tabungan) }}" class="d-inline" method="POST" id="delete">
                              @csrf
                              @method('delete')
                              <button type="button" class="btn btn-danger" onclick="deleteData({{$tr->id_tarik_tabungan}})">Hapus</button>
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
    $('#tarik_tabunganTable').DataTable();
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