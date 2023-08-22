<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Models\Tanah_bangunan;
use App\Models\Laporan_tabungan;
use App\Models\Kegiatan_pertahun;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class Laporan_tabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan_tabungan = Laporan_tabungan::orderBy('id_laporan_tabungan', 'asc')->get();

        return view('laporantabungan.index', ['laporan_tabungan' => $laporan_tabungan]);
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
        return view('laporantabungan.create',[
            'siswa' => $siswa,
            'kelas' => $kelas,
            'tahun_ajaran' => $tahun_ajaran,
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
    $validatedData = $request->validate([
        'tanggal_laporan' => 'required',
        'bulan_laporan' => 'required',
        'tahun_ajaran' => 'required|integer',
        'keterangan' => 'required',
        'dokumen' => 'required|mimes:pdf,doc,docx,xlsx|max:2048',
    ]);

    if ($request->hasFile('dokumen')) {
        $file = $request->file('dokumen');
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::random(40) . '.' . $extension;
        $filePath = $file->storeAs('public/dokumen', $fileName);

        $store = Laporan_tabungan::create([
            'tanggal_laporan' => $validatedData['tanggal_laporan'],
            'bulan_laporan' => $validatedData['bulan_laporan'],
            'id_tahun_ajaran' => $request->tahun_ajaran,
            'keterangan' => $validatedData['keterangan'],
            'dokumen' => 'dokumen/' . $fileName,
        ]);

        if ($store) {
            alert()->success('Berhasil', 'Data Laporan Tabungan Berhasil di Tambahkan');
        } else {
            alert()->error('Error', 'Silahkan Periksa Data Kelengkapan Anda');
        }
    }

    return redirect()->route('home');
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
    public function edit($id_laporan_tabungan)
    {
        $siswa = Siswa::get();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $laporan_tabungan = Laporan_tabungan::findOrFail($id_laporan_tabungan);
        // dd($user);
        return view('laporantabungan.edit',compact('siswa','kelas','tahun_ajaran','laporan_tabungan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_laporan_tabungan)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'tanggal_laporan' => 'required|date',
            'bulan_laporan' => 'required',
            'tahun_ajaran' => 'required|integer',
            'keterangan' => 'required',
            'dokumen' => 'required',
        ]);

        if($validasi) :
            $update = Laporan_tabungan::findOrFail($id_laporan_tabungan)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Pelaporan Tabungan Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tabungan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_laporan_tabungan)
    {
        if(Laporan_tabungan::find($id_laporan_tabungan)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
