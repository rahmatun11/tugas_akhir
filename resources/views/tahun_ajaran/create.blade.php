@extends('layouts.admin')
@section('title', 'Data Tahun Ajaran')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Tahun Ajaran /</span> Tambah Data Tahun Ajaran</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-tahun.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-tahun.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">TAHUN AJARAN</label>
                                <input type="text" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran') }}">
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