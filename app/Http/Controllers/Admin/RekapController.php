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
use illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class RekapController extends Controller
{
    // public function index()
    // {
    //     $class = Kelas::all();
    //     $rekapData = Rekap::select('nisn','id_kelas')->orderBy('created_at', 'desc')->distinct()->get();
    //     $total = 0;
    //     foreach($rekapData as $d) {
    //         $tarik = Tarik_tabungan::where('nisn',$d['nisn'])->sum('tarik');
    //         $setor = Setor_tabungan::where('nisn',$d['nisn'])->sum('setor');
    //         $total = $setor - $tarik;
    //     }
    //     $totalTarik = Tarik_tabungan::sum('tarik');
    //     $totalSetor = Setor_tabungan::sum('setor');
    //     $totalKeseluruhan = $totalSetor - $totalTarik;
    //     $data = [
    //         'rekap' => $rekapData,
    //         'total_keseluruhan' => $totalKeseluruhan,
    //         'total_setor' => $totalSetor,
    //         'total_tarik' => $totalTarik,
    //         'total'=>$total,
    //         'Kelas' => $class
    //     ]; 

    //     return view('rekap.index', $data);
    // }

    public function index(Request $request)
    {
        $class = Kelas::all();
        $selectedKelasId = $request->input('kelas'); // Ambil nilai kelas yang dipilih dari input form
    
        $rekapData = Rekap::select('nisn','id_kelas')
            ->when($selectedKelasId, function ($query) use ($selectedKelasId) {
                return $query->where('id_kelas', $selectedKelasId);
            })
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->get();
    
        $total = 0;
        foreach($rekapData as $d) {
            $tarik = Tarik_tabungan::where('nisn', $d['nisn'])->sum('tarik');
            $setor = Setor_tabungan::where('nisn', $d['nisn'])->sum('setor');
            $total = $setor - $tarik;
        }
    
        $totalTarik = Tarik_tabungan::sum('tarik');
        $totalSetor = Setor_tabungan::sum('setor');
        $totalKeseluruhan = $totalSetor - $totalTarik;
    
        $data = [
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

        $rekapQuery = Rekap::query()
            ->with(['siswa','kelas','Tarik_tabungan','Setor_tabungan'])
            ->when($selectedKelasId, function ($query) use ($selectedKelasId) {
                return $query->where('id_kelas', $selectedKelasId);
            })
            ->orderBy('created_at', 'desc');

        $rekapData = $rekapQuery->get();

        $total = 0;
        foreach($rekapData as $d) {
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
    


    public function show() {
        $nisn = request('nisn');
        $rekapData = Rekap::where('nisn',$nisn)->orderBy('created_at', 'desc')->get();
        

       $data = ['rekap'=>$rekapData];
        
        return view('rekap.show', $data);
    }
    // public function getSaldoTabunganhasil(Request $request)
    // {
    //     $nisn = $request->nisn;
        
    //     // Query untuk mendapatkan saldo tabungan berdasarkan NISN
    //     $saldo = Setor_tabungan::where('nisn', $nisn)->sum('setor') - Tarik_tabungan::where('nisn', $nisn)->sum('tarik');

    //     return response()->json(['rekap.index' => $saldo]);
    // }
//     public function cetak_pertanggalrekap($tglwal, $tglakhir)
// {
//     // Total pemasukan sebelum tanggal awal
//     $total_setorSebelum = Setor_tabungan::where('created_at', '<', $tglwal)
//         ->sum('setor');

//     // Total pemasukan dalam rentang tanggal yang diberikan
//     $total_setor = Setor_tabungan::whereBetween('tanggal', [$tglwal, $tglakhir])
//         ->sum('setor');

//     $setor = Setor_tabungan::whereBetween('created_at', [$tglwal, $tglakhir])->get();

//     $total_tarikSebelum = Tarik_tabungan::where('created_at', '<', $tglwal)
//         ->sum('tarik');

//     // Total pemasukan dalam rentang tanggal yang diberikan
//     $total_tarik = Tarik_tabungan::whereBetween('tanggal', [$tglwal, $tglakhir])
//         ->sum('tarik');

//     $tarik = Tarik_tabungan::whereBetween('created_at', [$tglwal, $tglakhir])->get();


//     $rekap = Rekap::whereBetween('tanggal', [$tglwal, $tglakhir])->get();

//     //  $total_keseluruhan = $total_setor + $total_tarik; 
    
//     // Buat objek Dompdf
//     $dompdf = new Dompdf();

//     // Load view PDF dan berikan data yang diperlukan
//    // Load view PDF and provide the necessary data
//     $html = view('rekap.cetakpdf', compact('setor', 'tarik', 'total_setor', 'total_tarik', 'tglwal', 'tglakhir', 'rekap'));


//     // Konversi view HTML menjadi PDF
//     $dompdf->loadHtml($html);
//     $dompdf->setPaper('A4', 'portrait');
//     $dompdf->render();

//     // Generate nama file PDF
//     $filename = 'laporan_tabungan_pertanggal' . '.pdf';

//     // Mengirimkan hasil PDF sebagai respons file download
//     return $dompdf->stream($filename);
// }
// public function cetakPeriodRekap(Request $request)
// {
//     // Get the input from the form
//     $tglwal = $request->input('tglawal');
//     $tglakhir = $request->input('tglakhir');

//     // Call the existing cetak_pertanggalrekap method to generate the PDF
//     return $this->cetak_pertanggalrekap($tglwal, $tglakhir);
// }


   


public function filter(Request $request)
    {
        $selectedKelas = $request->input('kelas');
        
        // Lakukan logika filter data berdasarkan kelas yang dipilih
        // Misalnya:
        $rekapData = Rekap::where('id_kelas', $selectedKelas)->get();
        $dompdf = new Dompdf();
        // Generate PDF menggunakan Dompdf
        $html = view('rekap.cetakpdf', compact('rekap'));

    // Konversi view HTML menjadi PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
        
    $filename = 'laporan_tabungan_perkelas' . '.pdf';

    // Mengirimkan hasil PDF sebagai respons file download
    return $dompdf->stream($filename);
    }

public function cetak_pertanggalrekap(Request $request)
{
    // Get the input from the form
    $tglawal = $request->input('tglawal');
    $tglakhir = $request->input('tglakhir');

    // Total pemasukan sebelum tanggal awal
    $total_setorSebelum = Setor_tabungan::where('created_at', '<', $tglawal)
        ->sum('setor');

    // Total pemasukan dalam rentang tanggal yang diberikan
    $total_setor = Setor_tabungan::whereBetween('created_at', [$tglawal, $tglakhir])
        ->sum('setor');

    $setor = Setor_tabungan::whereBetween('created_at', [$tglawal, $tglakhir])->get();

    $total_tarikSebelum = Tarik_tabungan::where('created_at', '<', $tglawal)
        ->sum('tarik');

    // Total pemasukan dalam rentang tanggal yang diberikan
    $total_tarik = Tarik_tabungan::whereBetween('created_at', [$tglawal, $tglakhir])
        ->sum('tarik');

    $tarik = Tarik_tabungan::whereBetween('created_at', [$tglawal, $tglakhir])->get();

    $total_keseluruhan = $total_setor - $total_tarik;

    // Retrieve data without 'tanggal' column filtering
    $rekap = Rekap::with(['setor_tabungan', 'tarik_tabungan'])
        ->whereBetween('created_at', [$tglawal, $tglakhir])
        ->get();

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Load view PDF dan berikan data yang diperlukan
    $html = view('rekap.cetakpdf', compact('setor', 'tarik', 'total_setor', 'total_tarik','total_keseluruhan', 'tglawal', 'tglakhir', 'rekap'));

    // Konversi view HTML menjadi PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Generate nama file PDF
    $filename = 'laporan_tabungan_pertanggal' . '.pdf';

    // Mengirimkan hasil PDF sebagai respons file download
    return $dompdf->stream($filename);
}
// public function downloadPdfPerKelas(Request $request)
//     {
//         $kelas = $request->input('kelas'); // Mengambil kelas dari input form

//         $rekapData = Rekap::where('kelas', $kelas)->orderBy('created_at', 'desc')->get();

//         $data = [
//             'rekap' => $rekapData,
//             'kelas' => $kelas,
//         ];

//         $dompdf = new Dompdf();

//         // Load view PDF dan berikan data yang diperlukan
//         $html = view('rekap.pdf', $data); // Menggunakan variabel $data

//         // Konversi view HTML menjadi PDF
//         $dompdf->loadHtml($html);
//         $dompdf->setPaper('A4', 'portrait');
//         $dompdf->render();
//         $filename = "rekap_tabungan_{$kelas}.pdf";

//         return $dompdf->stream($filename);
//     }

}
