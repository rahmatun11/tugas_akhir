@extends('layouts.admin')
@section('title', 'Data Siswa')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    
                      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Pembayaran Spp /</span> Edit Data Pembayaran Spp</h4>
          
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="card-header">
                  <a href="{{route('data-pembayaran.index')}}" class="btn btn-primary">Kembali</a>
                  <hr>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="card-body p-0">
                    <form action="{{ route('data-pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
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
                                    <option value="{{ $sis->nisn }}"{{ $pembayaran->nisn == $sis->nisn ? 'selected' : ''}}>
                                      {{$sis->nama }}
                                      </option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">TANGGAL BAYAR</label>
                                <input type="date" name="tanggal_bayar" class="form-control" value="{{ $pembayaran->tanggal_bayar }}" required>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">BULAN BAYAR</label>
                                <input type="text" name="bulan_bayar" class="form-control" value="{{ $pembayaran->bulan_bayar }}" required>
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
                                    <option value="{{ $kls->id_kelas }}"{{ $pembayaran->id_kelas == $kls->id_kelas ? 'selected' : ''}}> 
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
                                    <option value="{{ $ta->id_tahun_ajaran }}"{{ $pembayaran->id_tahun_ajaran == $ta->id_tahun_ajaran ? 'selected' : ''}}>
                                    {{$ta->tahun_ajaran }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
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
                                    <option value="{{ $kategori->id }}"{{ $pembayaran->id_spp == $kategori->id ? 'selected' : ''}}>
                                      {{$kategori->kategori }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>
                              <div class="form-group">
                                <label for="">TOTAL</label>
                                <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" value="{{ $spp->first()->nominal }}">
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
                    // Mendapatkan elemen select dan input
                    var productSelect = document.getElementById('id_spp');
                    var totalPriceInput = document.getElementById('jumlah_bayar');

                    // Menambahkan event listener ketika halaman pertama kali dimuat
                    window.addEventListener('DOMContentLoaded', function() {
                        // Cek jika tidak ada produk yang dipilih
                        if (productSelect.value === '') {
                            totalPriceInput.value = '0';
                        }
                    });

                    // Menambahkan event listener ketika pilihan produk berubah
                    productSelect.addEventListener('change', function() {
                        // Mendapatkan harga produk terpilih
                        var selectedProductId = this.value;
                        var selectedProduct = {!! $spp->toJson() !!}.find(function(spps) {
                            return spps.id == selectedProductId;
                        });

                        // Mengupdate nilai total harga pada input total_price_wifi
                        if (selectedProduct) {
                            totalPriceInput.value = selectedProduct.nominal;
                        } else {
                            totalPriceInput.value = '0';
                        }
                    });
                </script>

@endpush