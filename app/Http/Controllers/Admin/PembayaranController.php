<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use Midtrans\Snap;
use App\Models\Spp;
use App\Models\User;
use Midtrans\Config;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pembayaran = Pembayaran::orderBy('id_pembayaran', 'asc')->get();

        return view('pembayaran.index', ['pembayaran' => $pembayaran]);
    }
    public function indexbayar()
    {
        if (Auth::user()->level == "siswa") {
            $pembayaran = Pembayaran::where('nisn', Auth::user()->siswa->nisn)->orderBy('id_pembayaran', 'asc')->get();
        } else {
            $pembayaran = Pembayaran::orderBy('id_pembayaran', 'asc')->get();
        }
        return view('pembayaransiswa.index', ['pembayaran' => $pembayaran]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $spp = Spp::get();
        return view('pembayaran.create', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'spp' => $spp,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nisn' => 'required|integer',
            'tanggal_bayar' => 'required',
            'bulan_bayar' => 'required',
            'kelas' => 'required|integer',
            'tahun_ajaran' => 'required|integer',
            'spp' => 'required|integer',
            'jumlah_bayar' => 'required',
            'status' => 'required|in:paid,unpaid',
        ]);

        if ($validasi) :
            $store = Pembayaran::create([
                'nisn' => $validasi['nisn'],
                'tanggal_bayar' => $validasi['tanggal_bayar'],
                'bulan_bayar' => $validasi['bulan_bayar'],
                'id_kelas' => $request->kelas,
                'id_tahun_ajaran' => $request->tahun_ajaran,
                'id_spp' => $request->spp,
                'jumlah_bayar' => $validasi['jumlah_bayar'],
                'status' => $validasi['status'],
            ]);
            if ($store) :
                alert()->success('Berhasil', 'Data Pembayaran Spp Berhasil di Tambahkan');
            else :
                alert()->error('Error', 'Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;
        if (auth()->user()->level === 'siswa') {
            return redirect()->route('indexbayar');
        } else {
            return redirect()->route('data-pembayaran.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $siswa = Siswa::get();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $spp = Spp::get();
        $pembayaran = Pembayaran::findOrFail($id);
        // dd($user);
        return view('pembayaran.print', compact('siswa', 'kelas', 'tahun_ajaran', 'spp', 'pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pembayaran)
    {
        $siswa = Siswa::get();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $spp = Spp::get();
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        return view('pembayaran.edit', compact('siswa', 'kelas', 'tahun_ajaran', 'spp', 'pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pembayaran)
    {
        $validasi = $request->validate([
            'nisn' => 'required|integer',
            'tanggal_bayar' => 'required',
            'bulan_bayar' => 'required',
            'kelas' => 'required|integer',
            'tahun_ajaran' => 'required|integer',
            'spp' => 'required|integer',
            'jumlah_bayar' => 'required',
            'status' => 'required|in:paid,unpaid',
        ]);

        if ($validasi) :
            $update = Pembayaran::findOrFail($id_pembayaran)->update($validasi);
            if ($update) :
                alert()->success('Berhasil', 'Data Pembayaran Spp Berhasil di Ubah');
            else :
                alert()->error('Error', 'Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-pembayaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pembayaran)
    {

        $pembayaran = Pembayaran::where("id_pembayaran", $id_pembayaran)->first();
        $pembayaran->delete();

        return back();
    }

    public function print($id_pembayaran)
    {
        $user = User::all();
        $siswa = Siswa::get();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $spp = Spp::get();
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        // dd($user);
        return view('pembayaran.print', compact('user', 'siswa', 'kelas', 'tahun_ajaran', 'spp', 'pembayaran'));
    }
    public function bayar($id)
    {
        $transaction = Pembayaran::with(['spp', 'siswa'])->findOrFail($id);

        // Set konfigurasi midtrans
        Config::$serverKey = 'SB-Mid-server-BPV7S742Y6fw6zpZm9_vS_UR';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat array untuk data pembayaran
        $transaction_details = [
            'order_id' => $transaction->id_pembayaran . '_' . time(), // Tambahkan timestamp ke order ID
            // 'order_id' => '100',
            'gross_amount' => $transaction->jumlah_bayar,
        ];

        $items = [
            [
                'id' => $transaction->id_pembayaran,
                'price' => $transaction->jumlah_bayar,
                'quantity' => 1,
                'name' => $transaction->spp->kategori
            ],
        ];


        // Buat array untuk data pembelian
        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'customer_details' => [
                'first_name' => $transaction->siswa->nama,
                'name' => $transaction->siswa->nama,
                // 'email' => $transaction->siswa->email,
                'phone' => $transaction->siswa->no_telp,
            ],
            // 'callbacks' => [
            //     'finish' => route('dashboard.payment.finish', $transaction->id),
            //     'back_button' => [
            //         'url' => route('dashboard.midtrans.cancel', $transaction->id),
            //     ],
            //     'unfinish' => route('dashboard.payment.unfinish', $transaction->id),
            // ],
        ];

        // Panggil API midtrans untuk membuat transaksi baru
        try {
            $snap_token = \Midtrans\Snap::createTransaction($transaction_data)->token;
            // Redirect ke halaman pembayaran
            return redirect()->away('https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snap_token)
                ->with(['transaction_id' => $transaction->id_pembayaran]);
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function callback(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_ENVIRONMENT') === 'production' ? true : false;
        Config::$isSanitized = true;
        Config::$is3ds = false;

        Config::$serverKey = 'SB-Mid-server-dYq4Bl8HbUh9RGgIg6ydw28g';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // $user = User::first();
        // $kondisi = DaftarMitra::where('user_id', $user->name);

        $order_id_parts = explode('_', $request->order_id);
        $order_id_time = $order_id_parts[0]; // anbil id transaksi saja, tanpa timestamp

        $transactionSiswa = Pembayaran::where('id_pembayaran', $order_id_time)->first();

        // if ($request->status_code == 200) {
            if ($request->transaction_status == 'settlement') {
                $transactionSiswa->status = 'Paid';
                $transactionSiswa->update(['status'=> $transactionSiswa->status]);
            } elseif ($request->transaction_status == 'cancel') {
                $transactionSiswa->status = 'Unpaid';
                \Midtrans\Transaction::cancel($request->order_id);
            } else {
                $transactionSiswa->status = 'Unpaid';
                \Midtrans\Transaction::cancel($request->order_id);
            }
        // } else {
        //     $transactionSiswa = 'Unpaid';
        //     \Midtrans\Transaction::cancel($request->order_id);
        // }

        return redirect()->route('indexbayar');
    }

    public function cetak_pertanggal($tglwal, $tglakhir)
    {
        // Total pemasukan sebelum tanggal awal
        $total_pembayaranSebelum = Pembayaran::where('tanggal_bayar', '<', $tglwal)
            ->sum('jumlah_bayar');

        // Total pemasukan dalam rentang tanggal yang diberikan
        $total_pembayaran = Pembayaran::whereBetween('tanggal_bayar', [$tglwal, $tglakhir])
            ->sum('jumlah_bayar');

        $pembayaran = Pembayaran::whereBetween('tanggal_bayar', [$tglwal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('pembayaran.cetakpdf', compact('pembayaran', 'total_pembayaran', 'tglwal', 'tglakhir'))->render();

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_pembayaran_Spp_pertanggal' . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }
}
