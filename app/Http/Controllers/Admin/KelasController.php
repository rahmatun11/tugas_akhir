<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();

        return view('kelas.index', ['kelas' => $kelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $spp = Spp::all();
        return view('kelas.create',[
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
            'nama_kelas' => 'required',
        ]);

        if($validasi) :
            $store = Kelas::create([
                'nama_kelas' => $request->nama_kelas,  
            ]);
            if($store) :
                alert()->success('Berhasil','Data Kelas Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-kelas.index');

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
    public function edit($id_kelas)
    { 
        $kelas = Kelas::findOrFail($id_kelas);
        return view('kelas.edit',[
            'kelas' => $kelas,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kelas)
    {
        $validasi = $request->validate([
            'nama_kelas' => 'required',
        ]);

        if($validasi) :
            $update = Kelas::findOrFail($id_kelas)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Kelas Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelas)
    {
        if(Kelas::find($id_kelas)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
