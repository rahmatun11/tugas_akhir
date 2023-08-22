<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spp;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::orderBy('nama', 'asc')->get();

        return view('siswa.index', ['siswa' => $siswa]);
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
        return view('siswa.create',[
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'level' => 'nullable',
            
            'id_siswa' => 'nullable',
            'nisn' => 'required|numeric',   
            'nis' => 'required|numeric',
            'nama' => 'nullable',
            'tahun_ajaran' => 'required|integer',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'spp' => 'required|integer',
        ]);

        if($validasi) :

            $users = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'siswa',
            ]);

            $store = Siswa::create([
                'id_siswa' => $users->id,
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $users->name,
                'id_tahun_ajaran' => $request->tahun_ajaran,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_spp' => $request->spp,   
            ]);
            if($store) :
                alert()->success('Berhasil','Data Siswa Berhasil di Tambahkan');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-siswa.index');

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
    public function edit($nisn)
    {
        $siswa = Siswa::find($nisn);
        $kelas = Kelas::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $spp = Spp::all();
        return view('siswa.edit',[
            'siswa' => $siswa,
            'kelas' => $kelas,
            'tahun_ajaran' => $tahun_ajaran,
            'spp' => $spp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nisn)
    {
        $validasi = $request->validate([
            'nisn' => 'required|numeric',
            'nis' => 'required|numeric',
            'nama' => 'required',
            'tahun_ajaran' => 'required|integer',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'spp' => 'required|integer',
        ]);

        if($validasi) :
            $update = Siswa::findOrFail($nisn)->update([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_tahun_ajaran' => $request->tahun_ajaran,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_spp' => $request->spp,   
            ]);
            if($update) :
                alert()->success('Berhasil','Data Siswa Berhasil di Ubah');
            else :
                alert()->error('Error','Silahkan Periksa Data Kelengkapan Anda');
            endif;
        endif;

        return redirect()->route('data-siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
{
    $user = Siswa::where('nisn', $nisn)->first();

    $user->delete();

   return back();
}

}
