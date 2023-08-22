<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::orderBy('id_jurusan', 'asc')->get();

        return view('jurusan.index', ['jurusan' => $jurusan]);
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
        return view('jurusan.create',[
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
            'jurusan' => 'required',
        ]);

        if($validasi) :
            $store = Jurusan::create([
                'jurusan' => $request->jurusan,  
            ]);
            if($store) :
                alert()->success('Berhasil','Data Jurusan Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-jurusan.index');

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
    public function edit($id_jurusan)
    { 
        $jurusan = Jurusan::findOrFail($id_jurusan);
        return view('jurusan.edit',[
            'jurusan' => $jurusan,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jurusan)
    {
        $validasi = $request->validate([
            'jurusan' => 'required',
        ]);

        if($validasi) :
            $update = Jurusan::findOrFail($id_jurusan)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Jurusan Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-jurusan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jurusan)
    {
        if(Jurusan::find($id_jurusan)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
