<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Kelas;
use App\Models\Rekap;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Setor_tabungan;


use App\Models\Tarik_tabungan;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Siswa_tahun;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $class = Kelas::all();
        $selectedKelasId = $request->input('kelas');

        $rekapData = Rekap::select()
            ->when($selectedKelasId, function ($query) use ($selectedKelasId) {
                return $query->where('id_kelas', $selectedKelasId);
            })
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->get();

        $total = 0;
        foreach ($rekapData as $d) {
            $tarik = Tarik_tabungan::where('nisn', $d['nisn'])->sum('tarik');
            $setor = Setor_tabungan::where('nisn', $d['nisn'])->sum('setor');
            $total = $setor - $tarik;
        }

        $totalTarik = Tarik_tabungan::sum('tarik');
        $totalSetor = Setor_tabungan::sum('setor');
        $totalKeseluruhan = $totalSetor - $totalTarik;

        $data = [
            "siswa" => Siswa_tahun::get(),
            'rekap' => $rekapData,
            'total_keseluruhan' => $totalKeseluruhan,
            'total_setor' => $totalSetor,
            'total_tarik' => $totalTarik,
            'total' => $total,
            'Kelas' => $class,
            'selectedKelasId' => $selectedKelasId,
        ];

        return view('rekap.index', $data);
    }

    public function generatePDF(Request $request)
    {
        $selectedKelasId = $request->input('kelas');

        $rekapQuery = Rekap::query('nisn', 'id_kelas')
            ->with(['siswa', 'kelas', 'Tarik_tabungan', 'Setor_tabungan'])
            ->when($selectedKelasId, function ($query) use ($selectedKelasId) {
                return $query->where('id_kelas', $selectedKelasId);
            })
            ->orderBy('created_at', 'desc');

        $rekapData = $rekapQuery->get();

        $total = 0;
        foreach ($rekapData as $d) {
            $tarik = Tarik_tabungan::where('nisn', $d['nisn'])->sum('tarik');
            $setor = Setor_tabungan::where('nisn', $d['nisn'])->sum('setor');
            $total = $setor - $tarik;
        }

        $totalTarik = Tarik_tabungan::sum('tarik');
        $totalSetor = Setor_tabungan::sum('setor');
        $totalKeseluruhan = $totalSetor - $totalTarik;

        $data = [
            'total' => $total,
            'rekap' => $rekapData,
            'total_keseluruhan' => $totalKeseluruhan,
            'total_setor' => $totalSetor,
            'total_tarik' => $totalTarik,
            'kelas' => $selectedKelasId ? Kelas::find($selectedKelasId)->nama_kelas : 'Semua Kelas',
            'selectedKelasId' => $selectedKelasId,
        ];

        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);
        $html = view('rekap.pdf', $data)->render(); // Ganti dengan view yang sesuai
        $dompdf->loadHtml($html);

        $dompdf->render();

        $output = $dompdf->output();
        file_put_contents('rekap.pdf', $output);

        return response()->download('rekap.pdf');
    }



    public function show(Request $request, $id)
    {
        $rekap = Rekap::where("nisn", $id)->get();

        $totalSetor = $rekap->sum(function ($item) {
            if (!empty($totalSetor)) {
                return $item->Setor_tabungan->setor;
            } else {
            }
        });

        $totalTarik = $rekap->sum(function ($item) {
            if (!empty($rekap)) {
                return $item->Tarik_tabungan->tarik;
            } else {
            }
        });

        return view('rekap.show', compact('rekap', 'totalSetor', 'totalTarik'));
    }
    public function filter_kelas(Request $request)
    {
        $total_setor = Setor_tabungan::where("id_kelas", $request->kelas)
            ->sum("setor");

        $tarik = Tarik_tabungan::where("id_kelas", $request->kelas)
            ->sum("tarik");

        $data = [
            "rekap" => Siswa_tahun::whereHas("kelas", function ($query) use ($request) {
                $query->where("id_kelas", $request->kelas);
            })->get(),
            "total_tarik" => $tarik,
            "total_setor" => $total_setor,
            "total_keseluruhan" => $total_setor - $tarik,
            "Kelas" => Kelas::all(),
            "selectedKelasId" => $request->input('kelas')
        ];

        return back()->with(["data" => $data]);
    }

    public function download_perkelas(Request $request, $kelas)
    {
        $total_setor = Setor_tabungan::where("id_kelas", $kelas)
            ->sum("setor");

        $tarik = Tarik_tabungan::where("id_kelas", $kelas)
            ->sum("tarik");

        $data = [
            "rekap" => Siswa_tahun::whereHas("kelas", function ($query) use ($kelas) {
                $query->where("id_kelas", $kelas);
            })->get(),
            "total_tarik" => $tarik,
            "total_setor" => $total_setor,
            "total_keseluruhan" => $total_setor - $tarik,
            "Kelas" => Kelas::all(),
            "selectedKelasId" => $kelas
        ];

        // return view('rekap.cetakpdf', ["data" => $data]);

        $dompdf = new Dompdf();
        $html = view('rekap.cetakpdf', ["data" => $data]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'laporan_kelas' . '.pdf';

        return $dompdf->stream($filename);
    }


    public function rekap_pertanggal(Request $request)
    {
        $tanggal_awal = $request->input('tglawal');
        $tanggal_akhir = $request->input('tglakhir');
        dd($request->tglawal);
    }

    public function cetak_pertanggalrekap(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"    
        ];

        $this->validate($request, [
            "tglawal" => "required",
            "tglakhir" => "required"
        ], $messages);

        return DB::transaction(function() use ($request) {
            $tanggal_awal = $request->tglawal;
            $tanggal_akhir = $request->tglakhir;

            if ($tanggal_akhir < $tanggal_awal) {
                alert()->error('Error', 'Tanggal Akhir Harus Lebih Besar');
                return back()->withInput();
            }

            $rekap = Rekap::whereBetween("created_at", [$tanggal_awal, $tanggal_akhir])
                ->get();

            $uniqueSiswa = [];
            $filter = [];

            foreach ($rekap as $item) {
                if ($item->nisn && !in_array($item->nisn, $uniqueSiswa)) {
                    $uniqueSiswa[] = $item->nisn;
                    $filter[] = $item;
                }
            }

            $data = [
                "selectedKelasId" => null,
                "rekap_data" => $filter,
                "tanggal_awal" => $tanggal_awal,
                "tanggal_akhir" => $tanggal_akhir
            ];

            return back()->with(["data" => $data])->withInput();
        });
    }
}
