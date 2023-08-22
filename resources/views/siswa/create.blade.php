@extends('layouts.admin')
@section('title', 'Data Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Siswa /</span> Tambah Data Siswa</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-siswa.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-siswa.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                <br>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="">NISN</label>
                                <input type="text" name="nisn" class="form-control" value="{{ old('nisn') }}">
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">NIS</label>
                                <input type="text" name="nis" class="form-control" value="{{ old('nis') }}">
                                <br>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">NAMA</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                                <br>                           
                            </div> --}}
                            {{-- <div class="form-group">
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
                            </div> --}}
                            <div class="form-group">
                                <label for="">TAHUN AJARAN</label>
                                <select name="tahun_ajaran" id="" class="form-control" class="custom-select" {{ count($tahun_ajaran) == 0 ? 'disabled' : '' }}>
                                    @if(count($tahun_ajaran)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($tahun_ajaran as $ta)
                                    <option value="{{ $ta->id_tahun_ajaran }}">{{ $ta->tahun_ajaran }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">ALAMAT</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">NOMER TELEPON</label>
                                <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
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
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
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