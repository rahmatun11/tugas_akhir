@extends('layouts.admin')
@section('title', 'Data Setor Tabungan Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Setor Tabungan Siswa/</span> Tambah Data Setor Tabungan Siswa</h4>
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-setor.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-setor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                            <div class="form-group">
                                <label for="">NAMA SISWA</label>
                                <select name="nisn" id="nisn" class="form-control" class="custom-select" {{ count($siswa) == 0 ? 'disabled' : '' }}>
                                    @if(count($siswa)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($siswa as $sis)    
                                    <option value="{{ $sis->nisn }}">{{ $sis->nama }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">TINGKAT</label>
                                <select name="tingkat" id="" class="form-control" class="custom-select" {{ count($tingkat) == 0 ? 'disabled' : '' }}>
                                    @if(count($tingkat)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($tingkat as $ti)
                                    <option value="{{ $ti->id_tingkat }}">{{ $ti->tingkat }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">KELAS</label>
                                <select name="kelas" id="" class="form-control" class="custom-select" {{ count($kelas) == 0 ? 'disabled' : '' }}>
                                    @if(count($kelas)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">TANGGAL</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                                <br>
                            </div>
                          <div class="form-group">
                                <label for="saldo-tabungan">SALDO TABUNGAN</label>
                                <input type="text" id="saldo-tabungan" name="saldo-tabungan" class="form-control" readonly>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">JUMLAH SETOR</label>
                                <input type="text" name="setor" class="form-control" value="{{ old('setor') }}">
                                <br>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                  </div>
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

  <script>
        // Fungsi untuk mendapatkan saldo tabungan berdasarkan NISN
        function getSaldoTabungan() {
            var nisn = document.getElementById('nisn').value;
            
            // Menggunakan AJAX untuk mengirim permintaan ke endpoint atau URL yang sesuai
            // Ganti `{{ route('get-saldo-tabungan') }}` dengan endpoint atau URL yang sesuai
            fetch("{{ route('get-saldo-tabungan') }}?nisn=" + nisn)
                .then(response => response.json())
                .then(data => {
                    // Memperbarui nilai field saldo tabungan
                    document.getElementById('saldo-tabungan').value = data.saldo;
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
        }

        // Mendengarkan perubahan pada pilihan NISN
        document.getElementById('nisn').addEventListener('change', getSaldoTabungan);
    </script>

@endpush