<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\Kelas;
use App\Models\Rekap;
use App\Models\Siswa;
use App\Models\Tingkat;
use App\Models\Pembayaran;
use App\Models\Siswa_tahun;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Models\Setor_tabungan;
use App\Models\Tanah_bangunan;
use App\Models\Tarik_tabungan;
use App\Models\Kegiatan_pertahun;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class Tarik_tabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_tarik=Tarik_tabungan::sum('tarik');
        $tarik_tabungan = Tarik_tabungan::orderBy('id_tarik_tabungan', 'asc')->get();

        return view('tarik.index', ['tarik_tabungan' => $tarik_tabungan, 'total_tarik' =>$total_tarik]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $siswa = Siswa::all();
        $tingkat = Tingkat::all();
        $kelas = Kelas::all();
        return view('tarik.create',[
            'siswa' => $siswa,
            'tingkat' => $tingkat,
            'kelas' => $kelas,
        ]);
    }
    // public function getTotalTarikan($nisn)
    // {
    //     $totalSetoran = Setor_tabungan::where('nisn', $nisn)->sum('setor');

    //     return response()->json(['total_setoran' => $totalSetoran]);
    // }

    // Fungsi untuk mengambil saldo tabungan berdasarkan NISN
    public function getSaldoTabungan(Request $request)
    {
        $nisn = $request->nisn;
        
        // Query untuk mendapatkan saldo tabungan berdasarkan NISN
        $saldo = Setor_tabungan::where('nisn', $nisn)->sum('setor') - Tarik_tabungan::where('nisn', $nisn)->sum('tarik');
        // if ($request->tarik > $saldo) {
        //     return redirect()->back()->withErrors(['tarik' => 'Jumlah penarikan melebihi saldo tabungan yang dimiliki.']);
        // }
        
        return response()->json(['saldo' => $saldo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validasi = $request->validate([
            'nisn' => 'required|integer',
            'tingkat' => 'required|integer',
            'kelas' => 'required|integer',
            'tanggal' => 'required',
            // 'saldo' => 'required',
            'tarik' => 'required|numeric|max:10000000',    
        ], [
            'nisn.required' => 'Field NISN harus diisi.',
            'nisn.integer' => 'Field NISN harus berupa angka.',
            'tingkat.required' => 'Field Tingkat harus diisi.',
            'tingkat.integer' => 'Field Tingkat harus berupa angka.',
            'kelas.required' => 'Field Kelas harus diisi.',
            'kelas.integer' => 'Field Kelas harus berupa angka.',
            'tanggal.required' => 'Field Tanggal harus diisi.',
            'tarik.required' => 'Field Setor harus diisi.',
            'tarik.numeric' => 'Field Setor harus berupa angka.',
            'tarik.max' => 'Nilai Setor tidak boleh melebihi 10,000,000.',
        ]);
        

        // Ambil saldo dari hasil JSON
        $saldoResponse = $this->getSaldoTabungan($request);
        $saldo = $saldoResponse->getData()->saldo; // Mengambil nilai 'saldo' dari respons JSON
    
        if ($validasi && $saldo >= $validasi['tarik']) {
            $store = Tarik_tabungan::create([
                'nisn' => $validasi['nisn'],
                'id_tingkat' => $validasi['tingkat'],
                'id_kelas' => $request->kelas,
                'tanggal' => $validasi['tanggal'],
                'tarik' => $validasi['tarik'],
            ]);
            Rekap::create([
                'nisn'=> $validasi['nisn'],
                'id_kelas'=>$request->kelas,
                'id_tarik_tabungan' => $store->id_tarik_tabungan,
            ]);
            if ($store) {
                alert()->success('Berhasil','Data Penarikan Tabungan Berhasil di Tambahkan');
            } else {
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            }
        } else {
            alert()->error('Error','Jumlah penarikan melebihi saldo tabungan yang dimiliki.');
        }
        
        return redirect()->route('data-tarik.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_tarik_tabungan)
    {
        $siswa = Siswa::get();
        $tingkat = Tingkat::all();
        $kelas = Kelas::all();
        $tarik_tabungan = Tarik_tabungan::findOrFail($id_tarik_tabungan);
        // dd($user);
        return view('tarik.edit',compact('siswa','tingkat','kelas','tarik_tabungan'));
    }
    public function getSaldoTabunganEdit(Request $request, $nisn)
    {
        $setor_tabungan = Setor_tabungan::where('nisn', $nisn)->sum('setor');
        $penarikan_tabungan = Tarik_tabungan::where('nisn', $nisn)->sum('tarik');

        $saldo_tabungan = $setor_tabungan - $penarikan_tabungan;

        return response()->json(['saldo' => $saldo_tabungan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_tarik_tabungan)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'nisn' => 'required|integer',
            'tingkat' => 'required|integer',
            'kelas' => 'required|integer',
            'tanggal' => 'required',
            'tarik' => 'required',
        ]);

        if($validasi) :
            $update = Tarik_tabungan::findOrFail($id_tarik_tabungan)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Penarikan Tabungan Siswa Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tarik.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tarik_tabungan)
    {
        if(Tarik_tabungan::find($id_tarik_tabungan)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back ();
    }
    public function cetak_pertanggal($tglwal, $tglakhir)
    {
        // Total pemasukan sebelum tanggal awal
        $total_tarikSebelum = Tarik_tabungan::where('tanggal', '<', $tglwal)
            ->sum('tarik');

        // Total pemasukan dalam rentang tanggal yang diberikan
        $total_tarik = Tarik_tabungan::whereBetween('tanggal', [$tglwal, $tglakhir])
            ->sum('tarik');

        $tarik = Tarik_tabungan::whereBetween('tanggal', [$tglwal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('tarik.cetakpdf', compact('tarik','total_tarik', 'tglwal', 'tglakhir'))->render();

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_tarik_tabungan_pertanggal' . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }
}
