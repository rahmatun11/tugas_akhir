<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dat;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Models\Tanah_bangunan;
use App\Models\Kegiatan_pertahun;
use App\Models\Buku;
use App\Models\Kasur_lemari;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class Kasur_lemariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kasur_lemari = Kasur_lemari::orderBy('id_kasur_lemari', 'asc')->get();

        return view('kasurlemari.index', ['kasur_lemari' => $kasur_lemari]);
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
        return view('kasurlemari.create',[
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
            $store = Kasur_lemari::create([
                'nisn' => $validasi['nisn'],
                'tanggal_bayar' => $validasi['tanggal_bayar'],
                'id_kelas' => $request->kelas,
                'id_tahun_ajaran' => $request->tahun_ajaran,  
                'jumlah_bayar'=>$validasi['jumlah_bayar'],
            ]);
            if($store) :
                alert()->success('Berhasil','Data Pembayaran Kasur & Lemari Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;
        return redirect()->route('data-kl.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_kasur_lemari)
    {
        $siswa = Siswa::get();
        $kelas = Kelas::all(); 
        $tahun_ajaran = Tahun_ajaran::all();
        $kasur_lemari = Kasur_lemari::findOrFail($id_kasur_lemari);
        // dd($user);
        return view('kasurlemari.print',compact('siswa','kelas','tahun_ajaran','kasur_lemari'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kasur_lemari)
    {
        $siswa = Siswa::get();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $kasur_lemari = Kasur_lemari::findOrFail($id_kasur_lemari);
        // dd($user);
        return view('kasurlemari.edit',compact('siswa','kelas','tahun_ajaran','kasur_lemari'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kasur_lemari)
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
            $update = Kasur_lemari::findOrFail($id_kasur_lemari)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Pembayaran Kasur & Lemari Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-kl.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kasur_lemari)
    {
        if(Kasur_lemari::find($id_kasur_lemari)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
