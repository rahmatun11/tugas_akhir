@extends('layouts.admin')
@section('title', 'Data Penarikan Tabungan Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Penarikan Tabungan Siswa /</span> Edit Data Penarikan Tabungan Siswa</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-tarik.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-tarik.update', $tarik_tabungan->id_tarik_tabungan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label for="">NAMA SISWA</label>
                                <select name="nisn" id="" class="form-control" class="custom-select" {{ count($siswa) == 0 ? 'disabled' : '' }}>
                                    @if(count($siswa)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($siswa as $sis)
                                    <option value="{{ $sis->nisn }}"{{ $tarik_tabungan->nisn == $sis->nisn ? 'selected' : ''}}>
                                      {{$sis->nama }}
                                      </option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div> --}}

                              <div class="form-group">
                                  <label for="nisn">NAMA SISWA</label>
                                  <select name="nisn" id="nisn" class="form-control custom-select">
                                      <option value="{{ $tarik_tabungan->siswa->nisn }}" selected>{{ $tarik_tabungan->siswa->nama }}</option>
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
                                    <option value="{{ $ti->id_tingkat }}"{{ $tarik_tabungan->id_tingkat == $ti->id_tingkat ? 'selected' : ''}}> 
                                      {{$ti->tingkat }}</option>
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
                                    <option value="{{ $kls->id_kelas }}"{{ $tarik_tabungan->id_kelas == $kls->id_kelas ? 'selected' : ''}}> 
                                      {{$kls->nama_kelas }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">TANGGAL</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $tarik_tabungan->tanggal }}" required>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="saldo-tabungan">SALDO TABUNGAN</label>
                                <input type="text" id="saldo-tabungan" name="saldo-tabungan" class="form-control" readonly>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">TARIK</label>
                                <input type="text" name="tarik" class="form-control" value="{{ $tarik_tabungan->tarik }}" required>
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
      var url = "{{ route('data-tarik.getSaldoTabunganEdit', ':nisn') }}";
      url = url.replace(':nisn', nisn);

      // Menggunakan AJAX untuk mengirim permintaan ke endpoint yang sesuai
      fetch(url)
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

  // Panggil fungsi getSaldoTabungan saat halaman dimuat
  getSaldoTabungan();
</script>

@endpush