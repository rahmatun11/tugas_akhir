@extends('layouts.admin')
@section('title', 'Data Pembayaran Kasur & Lemari')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Pembayaran Kasur & Lemari /</span> Edit Data Pembayaran Kasur & Lemari</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-kl.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-kl.update', $kasur_lemari->id_kasur_lemari) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">NAMA SISWA</label>
                                <select name="nisn" id="" class="form-control" class="custom-select" {{ count($siswa) == 0 ? 'disabled' : '' }}>
                                    @if(count($siswa)==0)
                                    <option value="">Pilihan tidak ada</option>
                                    @else
                                    <option value="">Silahkan pilih</option>
                                    @foreach($siswa as $sis)
                                    <option value="{{ $sis->nisn }}"{{ $kasur_lemari->nisn == $sis->nisn ? 'selected' : ''}}>
                                      {{$sis->nama }}
                                      </option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">TANGGAL BAYAR</label>
                                <input type="date" name="tanggal_bayar" class="form-control" value="{{ $kasur_lemari->tanggal_bayar }}" required>
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
                                    <option value="{{ $kls->id_kelas }}"{{ $kasur_lemari->id_kelas == $kls->id_kelas ? 'selected' : ''}}> 
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
                                    <option value="{{ $ta->id_tahun_ajaran }}"{{ $kasur_lemari->id_tahun_ajaran == $ta->id_tahun_ajaran ? 'selected' : ''}}>
                                    {{$ta->tahun_ajaran }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">TOTAL</label>
                                <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" value="{{ $kasur_lemari->jumlah_bayar }}">
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