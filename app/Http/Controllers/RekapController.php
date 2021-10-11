<?php

namespace App\Http\Controllers;

use App\Exports\AbsenDosenExport;
use App\Exports\AbsenStaffExport;
use App\Exports\DosenExport;
use App\Models\AbsenDosen;
use App\Models\AbsenStaff;
use App\Models\Dosen;
use App\Models\RekapAbsen;
use App\Models\RekapDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    public function dosen()
    {
        // $dosen = Dosen::where('staf_akademik', true)->get();
        // $tahunAjaran = tahunAjaran();
        // return view('admin.akademik.pdfRekapDosen', compact('dosen', 'tahunAjaran'));

        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
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
        $dosen = Dosen::where('staf_akademik', true)->get();
        $tahunAjaran = tahunAjaran();
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

    public function absenDosen()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $rekapan = RekapAbsen::where('is_staff', false)->get();
        // $absen = AbsenDosen::whereMonth('tanggal', $m)->whereYear('tanggal', date('Y'))->orderBy('tanggal')->get();
        // return view('admin.keuangan.pdfRekapAbsenDosen', compact('absen'));

        return view('admin.keuangan.rekapAbsenDosen', compact('bulan', 'rekapan'));
    }

    public function postAbsenDosen(Request $request)
    {
        $cek = RekapAbsen::where('tahun', date('Y'))->where('bulan', $request->bulan)->where('is_staff', false)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid();
        $excel = $filename . ".xlsx";
        $fpdf = $filename . ".pdf";

        $month = $request->bulan;
        $year = date('Y');

        RekapAbsen::create([
            'excel' => $excel,
            'pdf' => $fpdf,
            'tahun' => $year,
            'bulan' => $month,
            'is_staff' => false
        ]);

        //add excel
        Excel::store(new AbsenDosenExport($month), 'rekap-absen-dosen/excel/' . $excel, 'public');

        //pdf
        $absen = AbsenDosen::whereMonth('tanggal', $month)->whereYear('tanggal', date('Y'))->orderBy('tanggal')->get();
        $pdf = PDF::loadView('admin.keuangan.pdfRekapAbsenDosen', compact('absen'));
        $pdf->setPaper('a4')->save('storage/rekap-absen-dosen/pdf/' . $fpdf);

        return response()->json('Sukses');
    }

    public function deleteAbsenDosen($id)
    {
        $rekap = RekapAbsen::find($id);
        Storage::disk('public')->delete('rekap-absen-dosen/pdf/' . $rekap->pdf);
        Storage::disk('public')->delete('rekap-absen-dosen/excel/' . $rekap->excel);
        $rekap->delete();
        return response()->json('Sukses');
    }

    public function absenStaff()
    {
        $m = date('n');
        $y = date('Y');
        $bulan = array_slice(getBulan(), 0, $m);
        // $absen = AbsenStaff::whereMonth('tanggal', $m)->whereYear('tanggal', $y)->get();
        // return view('admin.hrd.pdfRekapAbsen', compact('absen', 'm'));
        // dd($absen);

        if (Auth::user()->role_id != 4 && Auth::user()->role_id != 2) return redirect()->route('admin.dashboard');
        $rekapan = RekapAbsen::where('is_staff', true)->get();
        return view('admin.hrd.rekapAbsen', compact('bulan', 'rekapan'));
    }

    public function postAbsenStaff(Request $request)
    {
        $cek = RekapAbsen::where('tahun', date('Y'))->where('bulan', $request->bulan)->where('is_staff', true)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid();
        $excel = $filename . ".xlsx";
        $fpdf = $filename . ".pdf";

        $month = $request->bulan;
        $year = date('Y');

        RekapAbsen::create([
            'excel' => $excel,
            'pdf' => $fpdf,
            'tahun' => $year,
            'bulan' => $month,
            'is_staff' => true
        ]);

        //add excel
        Excel::store(new AbsenStaffExport($request->bulan), 'rekap-absen-staff/excel/' . $excel, 'public');

        //pdf
        $absen = AbsenStaff::whereMonth('tanggal', $request->bulan)->whereYear('tanggal', $year)->get();
        $pdf = PDF::loadView('admin.hrd.pdfRekapAbsen', compact('absen', 'month'));
        $pdf->setPaper('a4')->save('storage/rekap-absen-staff/pdf/' . $fpdf);

        return response()->json('Sukses');
    }

    public function deleteAbsenStaff($id)
    {
        $rekap = RekapAbsen::find($id);
        Storage::disk('public')->delete('rekap-absen-staff/pdf/' . $rekap->pdf);
        Storage::disk('public')->delete('rekap-absen-staff/excel/' . $rekap->excel);
        $rekap->delete();
        return response()->json('Sukses');
    }

    public function dev()
    {
        // return Excel::download(new AbsenDosenExport, 'tes.xlsx');
        // $absen = AbsenDosen::groupBy('dosen_id')->get();
        // $tahunAjaran = tahunAjaran();
        // return view('admin.keuangan.pdfRekapAbsenDosen', compact('absen', 'tahunAjaran'));
        // dd($absen->dosen->absen);
        // $c = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', '<=', 6)->sum('absen');
        // $c = ($c / -1) * 100;
        // dd($c);
    }
}
