<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\Kelas;
use App\Models\Rekap;
use App\Models\Siswa;
use App\Models\Tingkat;
use Barryvdh\DomPDF\PDF;
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


class Setor_tabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_setor=Setor_tabungan::sum('setor');
        $setor_tabungan = Setor_tabungan::orderBy('id_setor_tabungan', 'asc')->get();

        return view('setor.index', ['setor_tabungan' => $setor_tabungan, 'total_setor' => $total_setor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $setor_tabungan = Siswa_tahun::get();
        
        return view('setor.create',[
            
            'tahun' => $setor_tabungan
        ]);
    }
    // $siswa = Siswa::all();
    // $tingkat = Tingkat::all();
    // $kelas = Kelas::all();
    // $setor_tabungan = Setor_tabungan::get();
    // 'siswa' => $siswa,
    // 'tingkat' => $tingkat,
    // 'kelas' => $kelas,
    // 'setor_tabungan' => $setor_tabungan,

    // public function getTotalSetoran($nisn)
    // {
    //     $totalSetoran = Setor_tabungan::where('nisn', $nisn)->sum('setor');

    //     return response()->json(['total_setoran' => $totalSetoran]);
    // }

    public function getSaldoTabungan(Request $request)
    {
        $nisn = $request->nisn;
        
        // Query untuk mendapatkan saldo tabungan berdasarkan NISN
        $saldo = Setor_tabungan::where('nisn', $nisn)->sum('setor') - Tarik_tabungan::where('nisn', $nisn)->sum('tarik');

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
            // 'tingkat' => 'required|integer',
            // 'kelas' => 'required|integer',
            'tanggal' => 'required',
            // 'saldo' => 'required',
            'setor' => 'required|numeric|max:10000000',    
        ], [
            'nisn.required' => 'Field NISN harus diisi.',
            'nisn.integer' => 'Field NISN harus berupa angka.',
            // 'tingkat.required' => 'Field Tingkat harus diisi.',
            // 'tingkat.integer' => 'Field Tingkat harus berupa angka.',
            // 'kelas.required' => 'Field Kelas harus diisi.',
            // 'kelas.integer' => 'Field Kelas harus berupa angka.',
            'tanggal.required' => 'Field Tanggal harus diisi.',
            'setor.required' => 'Field Setor harus diisi.',
            'setor.numeric' => 'Field Setor harus berupa angka.',
            'setor.max' => 'Nilai Setor tidak boleh melebihi 10,000,000.',
        ]);

        if($validasi) :
            $store = Setor_tabungan::create([
                'nisn' => $validasi['nisn'],
                'id_tingkat' => $request->tingkat,
                'id_kelas' => $request->kelas,
                'tanggal' => $validasi['tanggal'],
                // 'saldo' => $validasi['saldo'],
                'setor' => $validasi['setor'],
            ]);
            Rekap::create([
                'nisn'=> $validasi['nisn'],
                'id_kelas'=>$request->kelas,
                'id_setor_tabungan' => $store->id_setor_tabungan,
            ]);
            if($store) :
                alert()->success('Berhasil','Data Setor Tabungan Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;
        return redirect()->route('data-setor.index');

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
    public function edit($id_setor_tabungan)
    {
        $siswa = Siswa::all();
        $tingkat = Tingkat::all();
        $kelas = Kelas::all();
        $setor_tabungan = Setor_tabungan::findOrFail($id_setor_tabungan);

        return view('setor.edit', compact('siswa', 'tingkat', 'kelas', 'setor_tabungan'));
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
    public function update(Request $request, $id_setor_tabungan)
    {
        $validasi = $request->validate([
            'nisn' => 'required|integer',
            'tingkat' => 'required|integer',
            'kelas' => 'required|integer',
            'tanggal' => 'required',
            'saldo' => 'required',
            'setor' => 'required',
        ]);

        if($validasi) :
            $update = Setor_tabungan::findOrFail($id_setor_tabungan)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Setor Tabungan Siswa Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-setor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_setor_tabungan)
    {
        if(Setor_tabungan::find($id_setor_tabungan)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back ();
    }

    public function cetak_pertanggal($tglwal, $tglakhir)
    {
        // Total pemasukan sebelum tanggal awal
        $total_setorSebelum = Setor_tabungan::where('tanggal', '<', $tglwal)
            ->sum('setor');

        // Total pemasukan dalam rentang tanggal yang diberikan
        $total_setor = Setor_tabungan::whereBetween('tanggal', [$tglwal, $tglakhir])
            ->sum('setor');

        $setor = Setor_tabungan::whereBetween('tanggal', [$tglwal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('setor.cetakpdf', compact('setor','total_setor', 'tglwal', 'tglakhir'))->render();

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_setor_tabungan_pertanggal' . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function post_nisn(Request $request)
    {
        $tahun_siswa = Siswa_tahun::where("nisn", $request->selected)
            ->first();

        return response()->json(["tingkat" => $tahun_siswa->tingkat, "kelas" => $tahun_siswa->kelas]);
    }
    // public function cetak_pdf()
    // {
    //     $total_setor = Setor_tabungan::sum('total_setor');
    //     $setor_tabungan = Setor_tabungan::all();

    //     $pdf = PDF::loadview('setor.cetakpdf', [
    //         'setor_tabungan' => $setor_tabungan,
    //         'total_setor' => $total_setor,
    //     ]);
    //     return $pdf->download('laporan-pemasukan.pdf');
    // }
}
