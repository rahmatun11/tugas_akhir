<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class TingkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tingkat = Tingkat::orderBy('id_tingkat', 'asc')->get();

        return view('tingkat.index', ['tingkat' => $tingkat]);
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
        return view('tingkat.create',[
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
            'tingkat' => 'required',
        ]);

        if($validasi) :
            $store = Tingkat::create([
                'tingkat' => $request->tingkat,  
            ]);
            if($store) :
                alert()->success('Berhasil','Data Tingkat Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tingkat.index');

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
    public function edit($id_tingkat)
    { 
        $tingkat = Tingkat::findOrFail($id_tingkat);
        return view('tingkat.edit',[
            'tingkat' => $tingkat,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_tingkat)
    {
        $validasi = $request->validate([
            'tingkat' => 'required',
        ]);

        if($validasi) :
            $update = Tingkat::findOrFail($id_tingkat)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Kelas Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-tingkat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tingkat)
    {
        if(Tingkat::find($id_tingkat)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
