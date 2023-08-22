<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Models\Kegiatan_pertahun;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class Kegiatan_pertahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan_pertahun = Kegiatan_pertahun::orderBy('id_kegiatan_tahunan', 'asc')->get();

        return view('kegiatantahunan.index', ['kegiatan_pertahun' => $kegiatan_pertahun]);
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
        return view('kegiatantahunan.create',[
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
            $store = Kegiatan_pertahun::create([
                'nisn' => $validasi['nisn'],
                'tanggal_bayar' => $validasi['tanggal_bayar'],
                'id_kelas' => $request->kelas,
                'id_tahun_ajaran' => $request->tahun_ajaran,  
                'jumlah_bayar'=>$validasi['jumlah_bayar'],
            ]);
            if($store) :
                alert()->success('Berhasil','Data Pembayaran Kegiatan Tahunan Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;
        return redirect()->route('data-tahunan.index');

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
        $kegiatan_pertahun = Kegiatan_pertahun::findOrFail($id);
        // dd($user);
        return view('kegiatantahunan.print',compact('siswa','kelas','tahun_ajaran','kegiatan_pertahun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kegiatan_tahunan)
    {
        $siswa = Siswa::get();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $kegiatan_pertahun = Kegiatan_pertahun::findOrFail($id_kegiatan_tahunan);
        // dd($user);
        return view('kegiatantahunan.edit',compact('siswa','kelas','tahun_ajaran','kegiatan_pertahun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kegiatan_tahunan)
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
            $update = Kegiatan_pertahun::findOrFail($id_kegiatan_tahunan)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Pembayaran Kegiatan Tahunan Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tahunan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kegiatan_tahunan)
    {
        if(Kegiatan_pertahun::find($id_kegiatan_tahunan)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
