@extends('layouts.admin')
@section('title', 'Data Rekap Tabungan Siswa')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            
              <div class="container-xxl flex-grow-1 container-p-y">
<h4 class="mt-0 header-title">Data Rekap Tabungan Siswa</h4>
<div class="">
    <div class="alert alert-success text-light "
        style="background: linear-gradient(to top, #47acff,#1870d4);" role="alert">

        <i class=" mdi mdi-information-outline"></i><span style="color:white;font-weight:bold;">
            Rekap Tabungan Siswa
        </span>
        <h6 class="mt-3">
            Setor : {{ 'Rp ' . number_format($total_setor, 0, ',', '.') }}
        </h6>
        <h6>
            tarik : {{ 'Rp ' . number_format($total_tarik, 0, ',', '.') }}
        </h6>
        <hr>
        <h2>
            {{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}
        </h2>
    </div>
</div>
</div>
</div>
</div>
<div class="col-lg-13">
<div class="card m-b-30">
<div class="card-body">
<h4 class="mt-0 header-title">Unduh rekap laporan tabungan pertanggal</h4>

{{-- <div class="col-lg-13">
    <div class="card m-b-30">
        <div class="card-body mb-3">
            <h4 class="mt-0 header-title mb-3">Unduh laporan tabungan pertanggal</h4>

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
                <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(0, 118, 172)"
                    href="/cetak-data-pertanggalrekap/{{ $tglawal }}/{{ $tglakhir }}"
                    role="button">
                    <i class="mdi mdi-download"></i> Unduh Periode
                </a>
                {{-- <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(172, 0, 129)"
                    href="{{ route('cetakpdfrekap') }}" role="button"><i
                        class="mdi mdi-download"></i>
                    Unduh Semua</a> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}} 

        <div class="card m-b-30">
            <div class="card-body mb-3">
                <h4 class="mt-0 header-title mb-3">Unduh laporan tabungan pertanggal</h4>

                <!-- Form for date input -->
                <form action="{{ route('cetak-pertanggal-rekap') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="tglawal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="tglawal" id="tglawal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglakhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="tglakhir" id="tglakhir">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between" mb-2>
                        <button type="submit" class="btn btn-info btn-sm mb-2" style="background-color: rgb(0, 118, 172)">
                            <i class="mdi mdi-download"></i> Unduh Periode
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="card m-b-30">
            <div class="card-body mb-3">
                <h4 class="mt-0 header-title mb-3">Unduh laporan tabungan pertanggal</h4>

                <!-- Form for date input -->
                <form action="{{ route('cetakpdfkelas') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="kelas" class="col-sm-2 col-form-label">kelas</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="" name="tglawal" id="tglawal">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between" mb-2>
                        <button type="submit" class="btn btn-info btn-sm mb-2" style="background-color: rgb(0, 118, 172)">
                            <i class="mdi mdi-download"></i> Unduh Periode
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}
<div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Unduh laporan tabungan perkelas</h4>
                <h4 class="mt-0 header-title mb-3">Filter Kelas:</h4>
                {{-- <form action="{{ url('/data-rekap/filter') }}" method="get">
                    @csrf
                    <select name="kelas" id="kelas" class="form-control">
                        <option value="">Pilih Kelas</option>
                        @foreach ($Kelas as $kelas)
                            <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <div class="d-flex mt-2 justify-content-between">
                        <button class="btn btn-sm btn-info ml-auto">
                            Cari...&nbsp;
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form> --}}

                {{-- ini code sudah benar --}}
                {{-- <form action="{{ url('data-rekap') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="kelas">Pilih Kelas:</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option value="">Pilih Kelas</option>
                            @foreach ($Kelas as $kelas)
                                <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex mt-2 justify-content-between">
                        <button type="submit" class="btn btn-sm btn-info ml-auto">
                            Cari...&nbsp;
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form> --}}
                
                <form action="{{ url('data-rekap') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="kelas">Pilih Kelas:</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option value="">Pilih Kelas</option>
                            @foreach ($Kelas as $kelas)
                                <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex mt-2 justify-content-between">
                        <button type="submit" class="btn btn-sm btn-info ml-auto">
                            Cari...&nbsp;
                            <i class="fa fa-search"></i>
                        </button>
                        
                        @if ($rekap->isNotEmpty())
                            <a href="{{ route('rekap.generatePDF', ['kelas' => $selectedKelasId]) }}" class="btn btn-sm btn-success">
                                Unduh PDF&nbsp;
                                <i class="fa fa-file-pdf"></i>
                            </a>
                        @endif
                    </div>
                </form>
                

            </div>
        </div>
    </div>


</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="card m-b-30">
<div class="card-body">
    <form method="GET" action="/filter">
        <div class="form-group row">
            <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Awal</label>
            <div class="col-md-3">
                <input class="form-control" type="date" name="tglawal" id="tglawal">
            </div>
            <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
            <div class="col-md-3 mb-2">
                <input class="form-control" type="date" name="tglakhir" id="tglakhir">
            </div>
            <div class="col-md-2 pt-1">
                <button type="submit" class="btn badge-primary">Filter</button>
            </div>
        </div>
    </form>
    @foreach ($rekap as $item)
{{-- <tr>
    <!-- ... Data lainnya ... -->
    <td>
        <a href="{{ route('rekap.pdf', $item->kelas) }}" class="btn btn-primary">Unduh PDF</a>
    </td>
</tr> --}}
@endforeach

    <div class="table-responsive">
        <table id="datatable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Saldo Akhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
           
            <tbody>
                @forelse ($rekap as $item)
                <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $item->Setor_tabungan ?? 'Data kosong' }}
                        </td>
                        <td>
                            {{ $item->kelas->nama_kelas ?? 'Data kosong' }}
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control saldo-tabungan" value="{{ 'Rp ' . number_format($total,0, ',', '.') }}" readonly>
                                <br>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('rekap.show', ['nisn'=>$item->siswa->nisn]) }}" class="btn btn-warning">Lihat</a>
                            </td>                   

                    </tr>
                @empty
                    <td colspan="5" class="text-center fw-bolder">Data Kosong</td>
                @endforelse
            </tbody>
        </table>
    @endsection

    @push('addon-script')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#setor_tabunganTable').DataTable();
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
                }).then((result) => {
                    if (result.value) {
                        $('#delete').submit();
                    }
                })
            }
        </script>
    @endpush
