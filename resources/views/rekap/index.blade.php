@php
    use App\Models\Setor_tabungan;
    use App\Models\Tarik_tabungan;
    use Carbon\Carbon;
@endphp

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
                                <h6 class="mt-3 text-light">
                                    @forelse (empty(session('data')) ? $siswa : session('data')['rekap'] as $item)
                                        {{-- @php
                                            $setorrr = Setor_tabungan::where('nisn', $item->nisn);
                                            $tarikkk = Tarik_tabungan::where('nisn', $item->nisn);
                                            
                                            if (!empty(session('data'))) {
                                                $setorrr->where('id_kelas', session('data')['selectedKelasId']);
                                                $tarikkk->where('id_kelas', session('data')['selectedKelasId']);
                                            }
                                            
                                            $setorrr = $setorrr->sum('setor');
                                            $tarikkk = $tarikkk->sum('tarik');
                                            
                                            $totalHasil = abs($setorrr - $tarikkk);
                                        @endphp

                                        
                                        <br>
                                        <hr> --}}
                                        {{-- Total : {{ 'Rp ' . number_format($totalHasil, 0, ',', '.') }} --}}

                                    @empty
                                        @if (empty(session('data')))
                                            gada
                                        @else
                                            gada
                                        @endif
                                    @endforelse
                                        
                                    @if (empty(session("data")["total_setor"]))
                                            Setor : {{ 'Rp. ' . number_format($total_setor, 0, ',', '.') }}
                                    @else
                                        @if (session("data")["total_setor"] == 0)
                                            0
                                        @else
                                        Setor : {{ 'Rp. ' . number_format(session("data")["total_setor"], 0, ',', '.') }}
                                        @endif
                                    @endif
                                    
                                    <br>

                                    @if (empty(session("data")["total_tarik"]))
                                            Tarik : {{ 'Rp. ' . number_format($total_tarik, 0, ',', '.') }}
                                    @else
                                        @if (session("data")["total_tarik"] == 0)
                                            0
                                        @else
                                        Tarik : {{ 'Rp. ' . number_format(session("data")["total_tarik"], 0, ',', '.') }}
                                        @endif
                                    @endif
                                    
                                    <hr>
                                    @if (empty(session("data")["total_keseluruhan"]))
                                            Total : {{ 'Rp. ' . number_format($total_keseluruhan, 0, ',', '.') }}
                                    @else
                                        @if (session("data")["total_keseluruhan"] == 0)
                                            0
                                        @else
                                        Total : {{ 'Rp. ' . number_format(session("data")["total_keseluruhan"], 0, ',', '.') }}
                                        @endif
                                    @endif
                                    
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-13">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Unduh rekap laporan tabungan pertanggal</h4>

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
                                        <button type="submit" class="btn btn-info btn-sm mb-2"
                                            style="background-color: rgb(0, 118, 172)">
                                            <i class="mdi mdi-download"></i> Unduh Periode
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-13">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-3">Unduh laporan tabungan perkelas</h4>
                                    <h4 class="mt-0 header-title mb-3">Filter Kelas:</h4>

                                    <form action="{{ url('rekap_kelas') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="kelas">Pilih Kelas:</label>
                                            <select name="kelas" id="kelas" class="form-control">
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($Kelas as $kelas)
                                                    @if (empty(session('data')['selectedKelasId']))
                                                        <option value="{{ $kelas->id_kelas }}">
                                                            {{ $kelas->nama_kelas }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $kelas->id_kelas }}"
                                                            {{ session('data')['selectedKelasId'] == $kelas->id_kelas ? 'selected' : '' }}>
                                                            {{ $kelas->nama_kelas }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex mt-2 justify-content-between">
                                            <button type="submit" class="btn btn-sm btn-info ml-auto">
                                                Cari...&nbsp;
                                                <i class="fa fa-search"></i>
                                            </button>
                                            @if ($rekap->isNotEmpty())
                                                @if (empty(session('data')['selectedKelasId']))
                                                <a href="{{ url('download_rekap_perkelas', ['Kelas' => $selectedKelasId]) }}"
                                                    class="btn btn-sm btn-success">
                                                    Unduh PDF&nbsp;
                                                    <i class="fa fa-file-pdf"></i>
                                                </a>
                                                @else
                                                <a href="{{ url('download_rekap_perkelas', ['Kelas' => session('data')['selectedKelasId']]) }}"
                                                    class="btn btn-sm btn-success">
                                                    Unduh PDF&nbsp;
                                                    <i class="fa fa-file-pdf"></i>
                                                </a>
                                                @endif
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
                    <div class="card m-b-30 mt-3">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/rekap_pertanggal') }}">
                                @csrf
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
                            <div class="table-responsive">
                                <table id="datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Saldo Akhir</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (empty(session('data')))
                                            @forelse ($siswa as $item)
                                                @php
                                                    $setor = Setor_tabungan::where('nisn', $item->nisn)->sum('setor');
                                                    
                                                    $tarik = Tarik_tabungan::where('nisn', $item->nisn)->sum('tarik');
                                                    
                                                    $totalHasil = abs($setor - $tarik);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>
                                                        {{ $item->siswa->nama }}
                                                    </td>
                                                    <td>
                                                        {{ $item->kelas->nama_kelas }}
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control saldo-tabungan"
                                                                value="{{ 'Rp ' . number_format($totalHasil, 0, ',', '.') }}"
                                                                readonly>
                                                            <br>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    {{ Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('rekap/show/' . $item->nisn) }}"
                                                            class="btn btn-warning">
                                                            Lihat
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td colspan="5" class="text-center fw-bolder">Data Kosong</td>
                                            @endforelse
                                        @else
                                            @forelse (session("data")["rekap"] as $item)
                                                @php
                                                    $setor = Setor_tabungan::where('id_kelas', session('data')['selectedKelasId'])
                                                        ->where('nisn', $item->nisn)
                                                        ->sum('setor');
                                                    
                                                    $tarik = Tarik_tabungan::where('id_kelas', session('data')['selectedKelasId'])
                                                        ->where('nisn', $item->nisn)
                                                        ->sum('tarik');
                                                    
                                                    $hasil = abs($setor - $tarik);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $item->siswa->nama }}
                                                    </td>
                                                    <td>
                                                        {{ $item->kelas->nama_kelas }}
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control saldo-tabungan"
                                                                value="{{ 'Rp ' . number_format($hasil, 0, ',', '.') }}"
                                                                readonly>
                                                                <br>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        {{ Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}
                                                        </td>
                                                        <td>
                                                        <a href="{{ url('rekap/show/' . $item->nisn) }}"
                                                            class="btn btn-warning">
                                                            Lihat
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        <strong>
                                                            Data Kosong
                                                        </strong>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
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
