@extends('layouts.admin')
@section('title', 'Data Setor Tabungan Siswa')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Setor Tabungan Siswa/</span>
                            Tambah Data Setor Tabungan Siswa</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Basic Bootstrap Table -->
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('data-setor.index') }}" class="btn btn-primary">Kembali</a>
                                <hr>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <div class="card-body p-0">
                                    <form action="{{ route('data-setor.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <select name="nisn" id="nisn" class="form-control" class="custom-select"
                                                {{ count($tahun) == 0 ? 'disabled' : '' }}>
                                                @if (count($tahun) == 0)
                                                    <option value="">Pilihan tidak ada</option>
                                                @else
                                                    <option value="">Silahkan pilih</option>
                                                    @foreach ($tahun as $siswaInfo)
                                                        <option value="{{ $siswaInfo->siswa->nisn }}">
                                                            {{ $siswaInfo->siswa->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Tingkat</label>
                                            <input type="text" class="form-control" id="tingkat_view" readonly>
                                            <input type="hidden" name="tingkat" id="tingkat" data-idTingkat="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kelas</label>
                                            <input type="text" class="form-control" id="kelas_view" readonly>
                                            <input type="hidden" name="kelas" id="kelas" data-idKelas="">
                                        </div>

                                        <div class="form-group">
                                            <label for="">TANGGAL</label>
                                            <input type="date" name="tanggal" class="form-control"
                                                value="{{ old('tanggal') }}">
                                            <br>
                                        </div>
                                        <div class="form-group">
                                            <label for="saldo-tabungan">SALDO TABUNGAN</label>
                                            <input type="text" id="saldo-tabungan" name="saldo-tabungan"
                                                class="form-control" readonly>
                                            <br>
                                        </div>
                                        <div class="form-group">
                                            <label for="">JUMLAH SETOR</label>
                                            <input type="text" name="setor" class="form-control"
                                                value="{{ old('setor') }}">
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
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var nisnSelect = document.getElementById('nisn');
        var tingkatSelect = document.getElementById('tingkat');
        var kelasSelect = document.getElementById('kelas');

        var dataSiswa = {!! json_encode($tahun) !!};
        nisnSelect.addEventListener('change', function() {
            var selectedNisn = this.value;

            $.ajax({
                type: "GET",
                url: "{{ url('/data-setor/post-nisn') }}",
                data: {
                    selected: selectedNisn
                },
                success: function(response) {
                    $("#kelas_view").val(response.kelas.nama_kelas)
                    $("#kelas").val(response.kelas.id_kelas);
                    $("#tingkat_view").val(response.tingkat.tingkat)
                    $("#tingkat").val(response.tingkat.id_tingkat);
                }
            })
        });
    </script>



    <script>
        // Fungsi untuk mendapatkan saldo tabungan berdasarkan NISN
        function getSaldoTabungan() {
            var nisn = document.getElementById('nisn').value;

            // Menggunakan AJAX untuk mengirim permintaan ke endpoint atau URL yang sesuai
            // Ganti `{{ route('get-saldo-tabungan') }}` dengan endpoint atau URL yang sesuai
            fetch("{{ route('get-saldo-tabungan') }}?nisn=" + nisn)
                .then(response => response.json())
                .then(data => {
                    // Memperbarui nilai field saldo tabungan
                    document.getElementById('saldo-tabungan').value = data.saldo;
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
        }

        // Mendengarkan perubahan pada pilihan NISN
        document.getElementById('nisn').addEventListener('change', getSaldoTabungan);
    </script>
@endpush
