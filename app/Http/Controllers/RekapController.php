<?php

namespace App\Http\Controllers;

use App\Exports\DosenExport;
use App\Models\Dosen;
use App\Models\RekapDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class RekapController extends Controller
{
    public function dosen()
    {
        $m = date('n');
        $bulan = array_slice($this->getBulan(), 0, $m);
        $rekapan = RekapDosen::all();
        return view('admin.akademik.rekapDosen', compact('bulan', 'rekapan'));
    }

    public function dosenRekap(Request $request)
    {
        $cek = RekapDosen::where('tahun', date('Y'))->where('bulan', $request->bulan)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid();
        $excel = $filename . ".xlsx";
        $fpdf = $filename . ".pdf";

        $month = $request->bulan;
        $year = date('Y');

        RekapDosen::create([
            'excel' => $excel,
            'pdf' => $fpdf,
            'tahun' => $year,
            'bulan' => $month
        ]);

        //add excel
        Excel::store(new DosenExport, 'rekap-dosen/excel/' . $excel, 'public');

        //pdf
        $dosen = Dosen::all();
        $tahunAjaran = $this->tahunAjaran();
        $pdf = PDF::loadView('admin.akademik.pdfRekapDosen', compact('dosen', 'tahunAjaran'));
        $pdf->setPaper('a4')->setOrientation('landscape')->save('storage/rekap-dosen/pdf/' . $fpdf);

        return response()->json('Sukses');
    }

    public function deleteRekapDosen($id)
    {
        $rekap = RekapDosen::find($id);
        Storage::disk('public')->delete('rekap-dosen/pdf/' . $rekap->pdf);
        Storage::disk('public')->delete('rekap-dosen/excel/' . $rekap->excel);
        $rekap->delete();
        return response()->json('Sukses');
    }

    // public function cek()
    // {
    //     $dosen = Dosen::skip(0)->take(10)->get();
    //     $tahunAjaran = $this->tahunAjaran();
    //     $pdf = PDF::loadView('admin.akademik.pdfRekapDosen', compact('dosen', 'tahunAjaran'));
    //     $pdf->setPaper('a4')->setOrientation('landscape')->save('storage/rekap-dosen/pdf/tes.pdf');
    //     // return $pdf->stream('cekk.pdf');
    //     // Storage::disk('public')->put('rekap-dosen/pdf/tes.pdf', $pdf->output());
    //     // return $pdf->download('tes.pdf');
    //     return view('admin.akademik.pdfRekapDosen', compact('dosen', 'tahunAjaran'));
    // }

    public function tahunAjaran()
    {
        $month = date('n');
        $year = date('Y');
        if ($month <= 6) {
            $y = $year - 1;
            $tahunAjaran = $y . "/" . $year;
        } else {
            $y = $year + 1;
            $tahunAjaran = $year . "/" . $y;
        }
        return $tahunAjaran;
    }

    protected function getBulan()
    {
        return $bulan = [
            (object)["id" => 1, "name" => "Januari"],
            (object)["id" => 2, "name" => "Februari"],
            (object)["id" => 3, "name" => "Maret"],
            (object)["id" => 4, "name" => "April"],
            (object)["id" => 5, "name" => "Mei"],
            (object)["id" => 6, "name" => "Juni"],
            (object)["id" => 7, "name" => "Juli"],
            (object)["id" => 8, "name" => "Agustus"],
            (object)["id" => 9, "name" => "September"],
            (object)["id" => 10, "name" => "Oktober"],
            (object)["id" => 11, "name" => "November"],
            (object)["id" => 12, "name" => "Desember"],
        ];
    }
}
