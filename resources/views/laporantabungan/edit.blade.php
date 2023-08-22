@extends('layouts.admin')
@section('title', 'Data Pelaporan Tabungan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Pelaporan Tabungan /</span> Edit Data Pelaporan Tabungan</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-tabungan.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-tabungan.update', $laporan_tabungan->id_laporan_tabungan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">TANGGAL PELAPORAN</label>
                                <input type="date" name="tanggal_laporan" class="form-control" value="{{ $laporan_tabungan->tanggal_laporan }}" required>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">BULAN PELAPORAN</label>
                                <input type="text" name="bulan_laporan" class="form-control" value="{{ $laporan_tabungan->bulan_laporan }}" required>
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
                                    <option value="{{ $ta->id_tahun_ajaran }}"{{ $laporan_tabungan->id_tahun_ajaran == $ta->id_tahun_ajaran ? 'selected' : ''}}>
                                    {{$ta->tahun_ajaran }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">KETERANGAN</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $laporan_tabungan->keterangan }}">
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">DOKUMEN</label>
                                <input type="file" name="dokumen" id="dokumen" class="form-control" value="{{ $laporan_tabungan->dokumen }}">
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