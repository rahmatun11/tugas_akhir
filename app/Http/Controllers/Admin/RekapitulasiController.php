<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\Rekapitulasi;
use App\Models\Buku;
use App\Models\Dat;
use App\Models\Kasur_lemari;
use App\Models\Kegiatan_pertahun;
use App\Models\Tanah_bangunan;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RekapitulasiController extends Controller
{
    public function index()
    {
        // Ambil data dari masing-masing tabel
        $bukuData = Buku::all();
        $datData = Dat::all();
        $kasurLemariData = Kasur_lemari::all();
        $kegiatanPertahunData = Kegiatan_pertahun::all();
        $tanahBangunanData = Tanah_bangunan::all();

        // Buat array untuk menyimpan rekap data
        $rekapData = [];

        // Proses data dari tabel buku
        foreach ($bukuData as $bk) {
            $siswaData = $bk->siswa->nisn;
            $jumlahBayar = $bk->jumlah_bayar;

            if (array_key_exists($siswaData, $rekapData)) {
                $rekapData[$siswaData] += $jumlahBayar;
            } else {
                $rekapData[$siswaData] = $jumlahBayar;
            }
        }



        // Proses data dari tabel dat
        foreach ($datData as $dt) {
            $siswaData = $dt->siswa->nisn;
            $jumlahBayar = $dt->jumlah_bayar;

            if (array_key_exists($siswaData, $rekapData)) {
                $rekapData[$siswaData] += $jumlahBayar;
            } else {
                $rekapData[$siswaData] = $jumlahBayar;
            }
        }

        // Proses data dari tabel kasur lemari
        foreach ($kasurLemariData as $kl) {
            $siswaData = $kl->siswa->nisn;
            $jumlahBayar = $kl->jumlah_bayar;

            if (array_key_exists($siswaData, $rekapData)) {
                $rekapData[$siswaData] += $jumlahBayar;
            } else {
                $rekapData[$siswaData] = $jumlahBayar;
            }
        }

        // Proses data dari tabel kegiatan pertahun
        foreach ($kegiatanPertahunData as $kt) {
            $siswaData = $kt->siswa->nisn;
            $jumlahBayar = $kt->jumlah_bayar;

            if (array_key_exists($siswaData, $rekapData)) {
                $rekapData[$siswaData] += $jumlahBayar;
            } else {
                $rekapData[$siswaData] = $jumlahBayar;
            }
        }

        // Proses data dari tabel tanah bangunan
        foreach ($tanahBangunanData as $tb) {
            $siswaData = $tb->siswa->nisn;
            $jumlahBayar = $tb->jumlah_bayar;

            if (array_key_exists($siswaData, $rekapData)) {
                $rekapData[$siswaData] += $jumlahBayar;
            } else {
                $rekapData[$siswaData] = $jumlahBayar;
            }
        }

        // Simpan data rekapitulasi ke dalam database
        //error lopingnya disini
        foreach ($rekapData as $nisn => $jumlahBayar) {
            Rekapitulasi::updateOrCreate(
                ['nisn' => $nisn],
                [
                    'id_buku' => optional($bukuData->where('siswa.nisn', $nisn)->first())->id_buku,
                    'id_dat' => optional($datData->where('siswa.nisn', $nisn)->first())->id_dat,
                    'id_kasur_lemari' => optional($kasurLemariData->where('siswa.nisn', $nisn)->first())->id_kasur_lemari,
                    'id_kegiatan_pertahun' => optional($kegiatanPertahunData->where('siswa.nisn', $nisn)->first())->id_kegiatan_tahunan,
                    'id_tanah_bangunan' => optional($tanahBangunanData->where('siswa.nisn', $nisn)->first())->id_tanah_bangunan,
                    'jumlah_bayar' => $jumlahBayar,
                ]
            );
        }

        // Ambil data rekapitulasi dari tabel rekapitulasi
        $rekapitulasiData = Rekapitulasi::all();

        return view('rekapitulasi.index', compact('rekapitulasiData'));
    }
    public function show()
    {
        $s = Siswa::query()->where('nama','=',request('name'))->first();
        $total_buku = Buku::query()->where('nisn','=',$s['nisn'])->first();
        $total_dat = Dat::query()->where('nisn','=',$s['nisn'])->first();
        $total_kasurlemari = Kasur_lemari::query()->where('nisn','=',$s['nisn'])->first();
        $total_kegiatanpertahun = Kegiatan_pertahun::query()->where('nisn','=',$s['nisn'])->first();
        $total_tanahbangunan = Tanah_bangunan::query()->where('nisn','=',$s['nisn'])->first();

        $data = [
            "total_buku" => $total_buku,
            "total_dat" => $total_dat,
            "total_kasurlemari" => $total_kasurlemari,
            "total_kegiatanpertahun" => $total_kegiatanpertahun,
            "total_tanahbangunan" => $total_tanahbangunan,
        ];

        return view('rekapitulasi.show', $data);
    }
    public function cetak_pertanggalrekap(Request $request)
{
    // Get the input from the form
    $tglawal = $request->input('tglawal');
    $tglakhir = $request->input('tglakhir');
    // Total pemasukan sebelum tanggal awal
    
    // // Total pemasukan dalam rentang tanggal yang diberikan
    $total_kegiatanpertahun = Kegiatan_pertahun::whereBetween('created_at', [$tglawal, $tglakhir])
    ->sum('jumlah_bayar');
    
    $total_buku = Buku::whereBetween('created_at', [$tglawal, $tglakhir])->groupBy("nisn")
    ->sum('jumlah_bayar');

    $total_dat = Dat::whereBetween('created_at', [$tglawal, $tglakhir])
    ->sum('jumlah_bayar');
    
    $total_kasurlemari = Kasur_lemari::whereBetween('created_at', [$tglawal, $tglakhir])
    ->sum('jumlah_bayar');
    
    $total_tanahbangunan = Tanah_bangunan::whereBetween('created_at', [$tglawal, $tglakhir])
    ->sum('jumlah_bayar');

    $total_keseluruhan = $total_kegiatanpertahun + $total_buku + $total_dat + $total_kasurlemari + $total_tanahbangunan ;
    // Retrieve data without 'tanggal' column filtering
    $rekapitulasi = Rekapitulasi::with(['kegiatan_pertahun', 'buku', 'dat', 'kasur_lemari', 'tanah_bangunan'])
    ->whereBetween('created_at', [$tglawal, $tglakhir])
    ->get();
    // $data =[];
    // foreach($rekapitulasi as $rkp)
    // {
    //     $data [] = $rkp['nama'];
    // }
    // $siswa = Siswa::whereIn("nama",$data)->get();
    // $dnisn=[];
    // foreach($siswa as $s)
    // {
    //     $dnisn [] = $s['nisn'];
    // }

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Load view PDF dan berikan data yang diperlukan
    $html = view('rekapitulasi.cetakpdf', compact('total_kegiatanpertahun', 'total_buku','total_dat','total_kasurlemari','total_tanahbangunan','total_keseluruhan', 'tglawal', 'tglakhir', 'rekapitulasi'));

    // Konversi view HTML menjadi PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Generate nama file PDF
    $filename = 'laporan_tabungan_pertanggal' . '.pdf';

    // Mengirimkan hasil PDF sebagai respons file download
    return $dompdf->stream($filename);
}
}



