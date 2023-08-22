<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tingkat;
use App\Models\Pembayaran;
use App\Models\Siswa_tahun;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Models\Tanah_bangunan;
use App\Models\Kegiatan_pertahun;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class Siswa_tahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa_tahun = Siswa_tahun::orderBy('id_siswa_tahun', 'asc')->get();

        return view('siswatahun.index', ['siswa_tahun' => $siswa_tahun]);
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
        $tahun_ajaran = Tahun_ajaran::all();
        return view('siswatahun.create',[
            'siswa' => $siswa,
            'tingkat' => $tingkat,
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
            'tingkat' => 'required|integer',
            'kelas' => 'required|integer',
            'tahun_ajaran' => 'required|integer',
        ]);

        if($validasi) :
            $store = Siswa_tahun::create([
                'nisn' => $validasi['nisn'],
                'id_tingkat' => $validasi['tingkat'],
                'id_kelas' => $request->kelas,
                'id_tahun_ajaran' => $request->tahun_ajaran,  
            ]);
            if($store) :
                alert()->success('Berhasil','Data Tahun Siswa Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;
        return redirect()->route('data-sista.index');

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
    public function edit($id_siswa_tahun)
    {
        $siswa = Siswa::get();
        $tingkat = Tingkat::all();
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $siswa_tahun = Siswa_tahun::findOrFail($id_siswa_tahun);
        // dd($user);
        return view('siswatahun.edit',compact('siswa','tingkat','kelas','tahun_ajaran','siswa_tahun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_siswa_tahun)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'nisn' => 'required|integer',
            'tingkat' => 'required|integer',
            'kelas' => 'required|integer',
            'tahun_ajaran' => 'required|integer',
        ]);

        if($validasi) :
            $update = Siswa_tahun::findOrFail($id_siswa_tahun)->update($validasi);
            if($update) :
                alert()->success('Berhasil','Data Tahun Siswa Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-sista.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_siswa_tahun)
    {
        if(Siswa_tahun::find($id_siswa_tahun)->delete()):
            Alert::success('Berhasil', 'Data Berhasil di Hapus');
        else:
            Alert::error('Terjadi Kesalahan', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
