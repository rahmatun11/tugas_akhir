@extends('layouts.admin')
@section('title', 'Data Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Siswa /</span> Edit Data Siswa</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-siswa.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-siswa.update', $siswa->nisn) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">NISN</label>
                                <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" required>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">NIS</label>
                                <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" required>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">NAMA</label>
                                <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}" required>
                                <br>                           
                            </div>
                            <div class="form-group">
                                <label for="">PASSWORD</label>
                                <input type="password" name="password" class="form-control" value="{{ $siswa->nisn }}" required>
                                <br>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">KELAS</label>
                                <select name="kelas" id="" class="form-control" class="custom-select" {{ count($kelas) == 0 ? 'disabled' : '' }}>
                                    @if(count($kelas)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id_kelas }}"{{ $siswa->id_kelas == $kls->id_kelas ? 'selected' : ''}}> 
                                      {{$kls->nama_kelas }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div> --}}
                            <div class="form-group">
                                <label for="">TAHUN AJARAN</label>
                                <select name="tahun_ajaran" id="" class="form-control" class="custom-select" {{ count($tahun_ajaran) == 0 ? 'disabled' : '' }}>
                                    @if(count($tahun_ajaran)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($tahun_ajaran as $ta)
                                    <option value="{{ $ta->id_tahun_ajaran }}"{{ $siswa->id_tahun_ajaran == $ta->id_tahun_ajaran ? 'selected' : ''}}>
                                    {{$ta->tahun_ajaran }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">ALAMAT</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $siswa->alamat }}" required>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">NOMER TELEPON</label>
                                <input type="text" name="no_telp" class="form-control" value="{{ $siswa->no_telp }}" required>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">KATEGORI</label>
                                <select name="spp" id="" class="form-control" class="custom-select" {{ count($spp) == 0 ? 'disabled' : '' }}>
                                    @if(count($spp)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($spp as $kategori)
                                    <option value="{{ $kategori->id }}"{{ $siswa->id_spp == $kategori->id ? 'selected' : ''}}>
                                      {{$kategori->kategori }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
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

@endpush