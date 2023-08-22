<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class Tahun_ajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajaran = Tahun_ajaran::orderBy('tahun_ajaran', 'asc')->get();

        return view('tahun_ajaran.index', ['tahun_ajaran' => $tahun_ajaran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun_ajaran = Tahun_ajaran::all();
        return view('tahun_ajaran.create',[
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
        $validasi = $request->validate([
            'tahun_ajaran' => 'required',
        ]);

        if($validasi) :
            $store = Tahun_ajaran::create([
                'tahun_ajaran' => $request->tahun_ajaran,  
            ]);
            if($store) :
                alert()->success('Berhasil','Data Tahun Ajaran Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tahun.index');

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
    // TahunAjaranController.php
 // Pastikan namespace model sudah sesuai

// Fungsi edit untuk menampilkan form edit data tahun ajaran
public function edit($id_tahun_ajaran)
{
    $tahun_ajaran = Tahun_ajaran::findOrFail($id_tahun_ajaran);
    return view('tahun_ajaran.edit', compact('tahun_ajaran'));
}

// Fungsi update untuk menghandle aksi update dari form edit
public function update(Request $request, $id_tahun_ajaran)
    {
        $validasi = $request->validate([
            'tahun_ajaran' => 'required',
        ]);

        if($validasi) :
            $update = Tahun_ajaran::findOrFail($id_tahun_ajaran)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Tahun Ajaran Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tahun.index');
    }

     // public function edit($id_tahun_ajaran)
    // {
    //     $tahun_ajaran = Tahun_ajaran::findOrFail($id_tahun_ajaran);
    //     return view('tahun_ajaran.edit',[
    //         'tahun_ajaran' => $tahun_ajaran,
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id_tahun_ajaran)
    // {
    //     $validasi = $request->validate([
    //         'tahun_ajaran' => 'required|numeric',
    //     ]);
    //     if($validasi) :
    //         $update = Tahun_ajaran::findOrFail($id_tahun_ajaran)->update($validasi);
    //         if($update) :
    //             alert()->success('Berhasil','Data Tahun Ajaran Berhasil di Ubah');
    //         else :
    //             alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
    //         endif;
    //     endif;

    //     return redirect()->route('data-tahun.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tahun_ajaran)
    {
        if(Tahun_ajaran::findOrFail($id_tahun_ajaran)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
