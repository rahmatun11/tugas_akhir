@extends('layouts.admin')
@section('title', 'Data Siswa Tahun')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Siswa /</span> Edit Data Tahun Siswa</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-sista.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-sista.update', $siswa_tahun->id_siswa_tahun) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="">NAMA SISWA</label>
                          <select name="nisn" id="" class="form-control" class="custom-select" {{ count($siswa) == 0 ? 'disabled' : '' }}>
                              @if(count($siswa)==0)
                              <option value="">Pilihan tidak ada</option>
                              @else
                              <option value="">Silahkan pilih</option>
                              @foreach($siswa as $sis)
                              <option value="{{ $sis->nisn }}"{{ $siswa_tahun->nisn == $sis->nisn ? 'selected' : ''}}>
                                {{$sis->nama }}
                                </option>
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
                            @foreach($tingkat as $tk)
                            <option value="{{ $tk->id_tingkat }}"{{ $siswa_tahun->id_tingkat == $tk->id_tingkat ? 'selected' : ''}}> 
                              {{$tk->tingkat }}</option>
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
                                <option value="{{ $kls->id_kelas }}"{{ $siswa_tahun->id_kelas == $kls->id_kelas ? 'selected' : ''}}> 
                                  {{$kls->nama_kelas }}</option>
                                @endforeach
                                @endif
                            </select>
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="">TAHUN AJARAN</label>
                            <select name="tahun_ajaran" id="" class="form-control" class="custom-select" {{ count($tahun_ajaran) == 0 ? 'disabled' : '' }}>
                                @if(count($tahun_ajaran)==0)
                                <option value="">Pilihan tidak ada</option>
                                @else
                                <option value="">Silahkan pilih</option>
                                @foreach($tahun_ajaran as $ta)
                                <option value="{{ $ta->id_tahun_ajaran }}"{{ $siswa_tahun->id_tahun_ajaran == $ta->id_tahun_ajaran ? 'selected' : ''}}>
                                {{$ta->tahun_ajaran }}
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