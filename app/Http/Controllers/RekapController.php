<?php

namespace App\Http\Controllers;

use App\Exports\AbsenDosenExport;
use App\Exports\AbsenStaffExport;
use App\Exports\DosenExport;
use App\Models\AbsenDosen;
use App\Models\AbsenStaff;
use App\Models\Dosen;
use App\Models\Pegawai;
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
        // $tmp = explode("-", '11-2021');
        // $bulan = $tmp[0];
        // $tahun = $tmp[1];
        // // dd(tahunAjaran($bulan));
        // $dosen =  Pegawai::with(['dosen' => function ($q) use ($bulan, $tahun) {
        //     $q->where('bulan', $bulan)->where('tahun', $tahun);
        // }, 'koordinator' => function ($q) use ($bulan) {
        //     $q->where('semester', tahunAjaran($bulan));
        // }])->where('is_dosen', true)->get();
        // // dd($dosen);
        // $pdf = PDF::loadView('admin.akademik.pdf.rekapDosen', compact('dosen', 'bulan', 'tahun'));
        // return $pdf->setOption('header-html', view('header'))->stream();

        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $rekapan = RekapDosen::all();
        return view('admin.akademik.rekapDosen', compact('bulan', 'rekapan'));
    }

    public function dosenRekap(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $cek = RekapDosen::where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid();
        $excel = $filename . ".xlsx";
        $fpdf = $filename . ".pdf";

        RekapDosen::create([
            'excel' => '-',
            'pdf' => $fpdf,
            'tahun' => $tahun,
            'bulan' => $bulan
        ]);

        //add excel
        // Excel::store(new DosenExport, 'rekap-dosen/excel/' . $excel, 'public');

        //pdf
        $dosen =  Pegawai::with(['dosen' => function ($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }, 'koordinator' => function ($q) use ($bulan) {
            $q->where('semester', tahunAjaran($bulan));
        }])->where('is_dosen', true)->get();
        $pdf = PDF::loadView('admin.akademik.pdf.rekapDosen', compact('dosen', 'bulan', 'tahun'));
        $pdf->setOption('header-html', view('header'))->save('storage/rekap-dosen/pdf/' . $fpdf);

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
        // $month = 10;
        // $tahun = date('Y');
        // $pegawai =  Pegawai::with(['absenDosen'])->where('is_dosen', 1)->get();
        // // $absen = $pegawai[0]->absenDosen()->where('hadir', 1)->distinct('kategori')->get();
        // // $absen = $absen->load('matkul');
        // // dd(totalPertemuan(1, 1, 'International Tutor', $month, $tahun), $absen);
        // $pdf = PDF::loadView('admin.akademik.pdf.rekapAbsen', compact(
        //     'pegawai',
        //     'month',
        //     'tahun'
        // ));
        // return $pdf->setOption('header-html', view('header'))->stream();
        // return Excel::download(new AbsenDosenExport($m), 'cek.xlsx');

        return view('admin.keuangan.rekapAbsenDosen', compact('bulan', 'rekapan'));
    }

    public function postAbsenDosen(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $cek = RekapAbsen::where('tahun', $tahun)->where('bulan', $bulan)->where('is_staff', false)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid();
        $excel = $filename . ".xlsx";
        $fpdf = $filename . ".pdf";

        $month = $bulan;
        $year = $tahun;

        RekapAbsen::create([
            'excel' => '-',
            'pdf' => $fpdf,
            'tahun' => $year,
            'bulan' => $month,
            'is_staff' => false
        ]);

        //add excel
        // Excel::store(new AbsenDosenExport($month, $year), 'rekap-absen-dosen/excel/' . $excel, 'public');

        $pegawai =  Pegawai::with(['absenDosen'])->where('is_dosen', 1)->get();
        $pdf = PDF::loadView('admin.akademik.pdf.rekapAbsen', compact(
            'pegawai',
            'month',
            'tahun'
        ));
        $pdf->setPaper('a4')->setOption('header-html', view('header'))->save('storage/rekap-absen-dosen/pdf/' . $fpdf);

        return response()->json('Sukses');
    }

    public function deleteAbsenDosen($id)
    {
        $rekap = RekapAbsen::find($id);
        Storage::disk('public')->delete('rekap-absen-dosen/pdf/' . $rekap->pdf);
        $rekap->delete();
        return response()->json('Sukses');
    }

    public function absenStaff()
    {
        $month = date('n');
        $year = date('Y');
        $bulan = array_slice(getBulan(), 0, $month);

        if (Auth::user()->role_id != 4 && Auth::user()->role_id != 2) return redirect()->route('admin.dashboard');
        $rekapan = RekapAbsen::where('is_staff', true)->get();
        return view('admin.hrd.rekapAbsen', compact('bulan', 'rekapan'));
    }

    public function postAbsenStaff(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $cek = RekapAbsen::where('tahun', $tahun)->where('bulan', $bulan)->where('is_staff', true)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid();
        $excel = $filename . ".xlsx";
        $fpdf = $filename . ".pdf";

        $month = $bulan;
        $year = $tahun;

        RekapAbsen::create([
            'excel' => $excel,
            'pdf' => $fpdf,
            'tahun' => $year,
            'bulan' => $month,
            'is_staff' => true
        ]);

        //add excel
        Excel::store(new AbsenStaffExport($month, $year), 'rekap-absen-staff/excel/' . $excel, 'public');

        //pdf
        $absen = Pegawai::with(['absenStaff' => function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
        }])->where('is_staff', 1)->get();
        $dt = [];
        foreach ($absen as $as) {
            $hadir = 0;
            $izin = -2;
            $telat = 0;
            $alpha = 0;
            foreach ($as->absenStaff as $absenStaff) {
                if ($absenStaff->hadir == 1) $hadir += 1;
                if ($absenStaff->izin == 1) $izin += 1;
                if ($absenStaff->keterangan == 'telat' || $absenStaff->keterangan == 'nofinger' || $absenStaff == 'sethari') $telat += 1;
                if ($absenStaff->keterangan == 'alpha') $alpha += 1;
            }
            $dt[] = [
                'nip' => $as->nip,
                'nama' => $as->nama,
                'hadir' => $hadir,
                'izin' => ($izin > 0) ? $izin : 0,
                'telat' => $telat,
                'alpha' => $alpha,
            ];
        }
        $data = json_decode(json_encode($dt));
        $pdf = PDF::loadView('admin.hrd.pdfRekapAbsen', compact('data', 'month', 'tahun'));
        $pdf->setPaper('a4')->setOption('header-html', view('header'))->save('storage/rekap-absen-staff/pdf/' . $fpdf);

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
