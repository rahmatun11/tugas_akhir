<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Models\Tanah_bangunan;
use App\Models\Kegiatan_pertahun;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class Tanah_bangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanah_bangunan = Tanah_bangunan::orderBy('id_tanah_bangunan', 'asc')->get();

        return view('tanahbangunan.index', ['tanah_bangunan' => $tanah_bangunan]);
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
        return view('tanahbangunan.create',[
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
        // dd($request->all());
        $validasi = $request->validate([
            'nisn' => 'required|integer',
            'tanggal_bayar' => 'required',
            'kelas' => 'required|integer',
            'tahun_ajaran' => 'required|integer',
            'jumlah_bayar' => 'required',
        ]);

        if($validasi) :
            $store = Tanah_bangunan::create([
                'nisn' => $validasi['nisn'],
                'tanggal_bayar' => $validasi['tanggal_bayar'],
                'id_kelas' => $request->kelas,
                'id_tahun_ajaran' => $request->tahun_ajaran,  
                'jumlah_bayar'=>$validasi['jumlah_bayar'],
            ]);
            if($store) :
                alert()->success('Berhasil','Data Pembayaran Tanah Bangunan Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;
        return redirect()->route('data-tabang.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::get();
        $kelas = Kelas::all(); 
        $tahun_ajaran = Tahun_ajaran::all();
        $tanah_bangunan = Tanah_bangunan::findOrFail($id);
        // dd($user);
        return view('tanahbangunan.print',compact('siswa','kelas','tahun_ajaran','tanah_bangunan'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_tanah_bangunan)
    {
        $siswa = Siswa::get();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $tanah_bangunan = Tanah_bangunan::findOrFail($id_tanah_bangunan);
        // dd($user);
        return view('tanahbangunan.edit',compact('siswa','kelas','tahun_ajaran','tanah_bangunan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_tanah_bangunan)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'nisn' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'kelas' => 'required|integer',
            'tahun_ajaran' => 'required|integer',
            'jumlah_bayar' => 'required|numeric',
        ]);

        if($validasi) :
            $update = Tanah_bangunan::findOrFail($id_tanah_bangunan)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Pembayaran Tanah Bangunan Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tabang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tanah_bangunan)
    {
        if(Tanah_bangunan::find($id_tanah_bangunan)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
