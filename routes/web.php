<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controllers\Admin\SppController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\TingkatController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\Siswa_tahunController;
use App\Http\Controllers\Admin\Tahun_ajaranController;
use App\Http\Controllers\Admin\Setor_tabunganController;
use App\Http\Controllers\Admin\Tanah_bangunanController;
use App\Http\Controllers\Admin\Tarik_tabunganController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\Admin\Laporan_tabunganController;
use App\Http\Controllers\Admin\Kegiatan_pertahunController;
use App\Http\Controllers\Admin\DatController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\Kasur_lemariController;
use App\Http\Controllers\Admin\RekapitulasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/rekapnilai', function () {
    return view('rekap/cetakpdf');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::resource('login', LoginController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/data-siswa', SiswaController::class);

Route::resource('/data-kelas', KelasController::class);

Route::resource('/data-kategori', SppController::class);

Route::resource('/data-tahun', Tahun_ajaranController::class);

Route::resource('data-pembayaran', PembayaranController::class);
Route::get('cetakpdf', [PembayaranController::class, 'cetak_pdf'])->name('cetakpdf');
Route::get('/cetak-data-pertanggalspp/{tglawal}/{tglakhir}', [PembayaranController::class, 'cetak_pertanggal'])->name('cetak-data-pertanggalspp');

Route::resource('/data-tahunan', Kegiatan_pertahunController::class);

Route::resource('/data-tabang', Tanah_bangunanController::class);

Route::resource('/data-tabungan', Laporan_tabunganController::class);

Route::resource('/data-dat', DatController::class);

Route::resource('/data-buku', BukuController::class);

Route::resource('/data-kl', Kasur_lemariController::class);

// Route::get('/data-pembayaran/print', 'PembayaranController@print')->name('data-pembayaran.print');

Route::resource('/data-tingkat', TingkatController::class);

Route::resource('/data-jurusan', JurusanController::class);

Route::resource('/data-sista', Siswa_tahunController::class);
//tabungan setor
Route::get("/data-setor/post-nisn", [Setor_tabunganController::class, "post_nisn"]);
Route::resource('/data-setor', Setor_tabunganController::class);

Route::get('cetakpdf', [Setor_tabunganController::class, 'cetak_pdf'])->name('cetakpdf');
Route::get('/cetak-data-pertanggal/{tglawal}/{tglakhir}', [Setor_tabunganController::class, 'cetak_pertanggal'])->name('cetak-data-pertanggal');
Route::get('/get-saldo-tabungan/{nisn}', [Setor_tabunganController::class, 'getSaldoTabunganEdit'])->name('data-setor.getSaldoTabunganEdit');
// Route::get('/get-total-setoran-edit/{nisn}', [Setor_tabunganController::class, 'getSaldoTabunganEdit'])->name('data-setor.totalSetoranEdit');
// Route::get('/get-total-setoran/{nisn}', [Setor_tabunganController::class, 'getTotalSetoran'])->name('data-setor.totalSetoran');
//tabungan tarik
Route::get('cetakpdftarik', [Tarik_tabunganController::class, 'cetak_pdf'])->name('cetakpdftarik');
Route::resource('/data-tarik', Tarik_tabunganController::class);
Route::get('/get-total-tarikan/{nisn}', [Tarik_tabunganController::class, 'getTotalTarikan'])->name('data-setor.totalTarikan');
Route::get('/get-saldo-tabungan-tarik/{nisn}', [Tarik_tabunganController::class, 'getSaldoTabunganEdit'])->name('data-tarik.getSaldoTabunganEdit');
Route::get('/cetak-data-pertanggaltarik/{tglawal}/{tglakhir}', [Tarik_tabunganController::class, 'cetak_pertanggal'])->name('cetak-data-pertanggaltarik');
// Route untuk mengambil saldo tabungan berdasarkan NISN
Route::get('/get-saldo-tabungan', [Tarik_tabunganController::class, 'getSaldoTabungan'])->name('get-saldo-tabungan');
//route spp siswa
Route::get('indexbayar', [PembayaranController::class, 'indexbayar'])->name('indexbayar');
Route::get('createbayar', [PembayaranController::class, 'createbayar'])->name('createbayar');

//route midtrans
Route::get('transaction/{id}/bayar', [PembayaranController::class, 'bayar'])->name('bayar');
Route::get('midtrans/callback', [PembayaranController::class, 'callback'])->name('midtrans.callback');

//route rekap tabungan
Route::post('/data-rekap/filter', [RekapController::class, 'filter'])->name('data-rekap.filter');
Route::resource('/data-rekap', RekapController::class);
Route::get('/rekap/show', [RekapController::class,'show'])->name('rekap.show');
Route::get('cetakpdfrekap', [RekapController::class, 'cetak_pdf'])->name('cetakpdf');
Route::post('/rekap_kelas', [RekapController::class, 'filter_kelas']);
Route::get('/rekap/generate-pdf', [RekapController::class,'generatePDF'])->name('rekap.generatePDF');

// Route::post('cetakpdfkelas', [RekapController::class, 'downloadPdfPerKelas'])->name('cetakpdfkelas');
// Route::get('cetakpdfkelas', [RekapController::class, 'downloadPdfPerKelas'])->name('cetakpdfkelas');
// Route::get('/get-saldo-tabunganhasil', [RekapController::class, 'getSaldoTabunganhasil'])->name('get-saldo-tabunganhasil');
// Route::get('/get-saldo-tabungan-rekap/{nisn}', [RekapController::class, 'getSaldoTabunganEdit'])->name('data-rekap.getSaldoTabunganEdit');
Route::get('/cetak-data-pertanggalrekap/{tglawal}/{tglakhir}', [RekapController::class, 'cetak_pertanggalrekap'])->name('cetak-data-pertanggalrekap');
// Route::post('/cetak-period-rekap', [RekapController::class,'cetakPeriodRekap'])->name('cetak-period-rekap');

Route::post('/cetak-pertanggal-rekap', [RekapController::class, 'cetak_pertanggalrekap'])->name('cetak-pertanggal-rekap');

//rekap dtaa pembayaran all
Route::resource('/rekapitulasi', RekapitulasiController::class);
Route::get('/rekapitulasi/show', 'RekapitulasiController@show')->name('rekapitulasi.show');
Route::get('cetakpdfrekapitulasi', [RekapitulasiController::class, 'cetak_pdf'])->name('cetakpdf');
Route::post('/cetak-data-pertanggalrekapitulasi', [RekapitulasiController::class, 'cetak_pertanggalrekap'])->name('cetak-pertanggal-rekapitulasi');


