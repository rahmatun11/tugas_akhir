@php
    use Carbon\Carbon;
@endphp
@extends('layouts.admin')
@section('title', 'Data Rekap Tabungan Siswa')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-13">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"></h4>
                        <div class="card m-b-30">
                            <div class="card-body mb-3">
                                <h4 class="mt-0 header-title mb-3">Unduh laporan tabungan pertanggal</h4>
                                <form action="{{ route('cetak-pertanggal-rekap') }}" method="POST">
                                    @csrf
                                    <div class="form-group row mb-4">
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
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-13">
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

                            <div class="table-responsive">
                                <table id="datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nominal</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rekap as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if (!empty($item->Setor_tabungan))
                                                        Rp. {{ number_format($item->Setor_tabungan->setor) }}
                                                    @elseif(!empty($item->Tarik_tabungan))
                                                        Rp. {{ number_format($item->Tarik_tabungan->tarik) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($item->Setor_tabungan))
                                                        Setor
                                                    @elseif(!empty($item->Tarik_tabungan))
                                                        Tarik
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
