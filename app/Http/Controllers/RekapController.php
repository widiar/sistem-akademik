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
use Illuminate\Support\Facades\File;
use ImageKit\ImageKit;

class RekapController extends Controller
{
    protected function imageKit()
    {
        return new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_SECRET_KEY'),
            env('IMAGE_KIT_ENDPOINT')
        );
    }
    public function dosen()
    {
        // $tmp = explode("-", '09-2021');
        // $bulan = $tmp[0];
        // $tahun = $tmp[1];
        // $dosen =  Pegawai::with(['dosen' => function ($q) use ($bulan, $tahun) {
        //     $q->where('bulan', $bulan)->where('tahun', $tahun);
        // }])->where('is_dosen', true)->get();
        // $pdf = PDF::loadView('admin.akademik.pdfRekapDosen', compact('dosen', 'bulan', 'tahun'));
        // return $pdf->setPaper('a4')->setOrientation('landscape')->setOption('header-html', view('header'))->stream();

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

        //add excel
        // Excel::store(new DosenExport, 'rekap-dosen/excel/' . $excel, 'public');

        //pdf
        $dosen =  Pegawai::with(['dosen' => function ($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }])->where('is_dosen', true)->get();
        $pdf = PDF::loadView('admin.akademik.pdfRekapDosen', compact('dosen', 'bulan', 'tahun'));
        if (env('APP_ENV') == 'heroku') {
            $imageKit = $this->imageKit();
            $path = base_path('public/uploads/files/');
            $pdf->setPaper('a4')->setOrientation('landscape')->setOption('header-html', view('header'))->save($path . $fpdf);
            $uploadFile = $imageKit->upload([
                'file' => fopen($path . $fpdf, "r"),
                'fileName' => $fpdf,
                'folder' => "sistem-akademik//rekap-dosen//pdf//"
            ]);
            //store db
            RekapDosen::create([
                'excel' => '-',
                'pdf' => json_encode([
                    "field" => $uploadFile->success->fileId,
                    "url" => $uploadFile->success->url,
                ]),
                'tahun' => $tahun,
                'bulan' => $bulan
            ]);
            File::delete($path . $fpdf);
        } else {
            $pdf->setPaper('a4')->setOrientation('landscape')->setOption('header-html', view('header'))->save('storage/rekap-dosen/pdf/' . $fpdf);
            //store db
            RekapDosen::create([
                'excel' => '-',
                'pdf' => $fpdf,
                'tahun' => $tahun,
                'bulan' => $bulan
            ]);
        }


        return response()->json('Sukses');
    }

    public function deleteRekapDosen($id)
    {
        $rekap = RekapDosen::find($id);
        if (env('APP_ENV') == 'heroku') {
            $imageKit = $this->imageKit();
            $imageKit->deleteFile(json_decode($rekap->pdf)->field);
        } else {
            Storage::disk('public')->delete('rekap-dosen/pdf/' . $rekap->pdf);
            Storage::disk('public')->delete('rekap-dosen/excel/' . $rekap->excel);
        }
        $rekap->delete();
        return response()->json('Sukses');
    }

    public function absenDosen()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $rekapan = RekapAbsen::where('is_staff', false)->get();
        // $month = $m;
        // $regular = Pegawai::with(['absenDosen' => function ($q) use ($m) {
        //     $q->whereMonth('tanggal', $m)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'Regular');
        // }])->where('is_dosen', 1)->get();
        // $karyawan = Pegawai::with(['absenDosen' => function ($q) use ($m) {
        //     $q->whereMonth('tanggal', $m)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'Karyawan');
        // }])->where('is_dosen', 1)->get();
        // $eksekutif = Pegawai::with(['absenDosen' => function ($q) use ($m) {
        //     $q->whereMonth('tanggal', $m)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'Eksekutif / Semester Pendek');
        // }])->where('is_dosen', 1)->get();
        // $inter = Pegawai::with(['absenDosen' => function ($q) use ($m) {
        //     $q->whereMonth('tanggal', $m)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'International Teori');
        // }])->where('is_dosen', 1)->get();
        // $pdf = PDF::loadView('admin.keuangan.pdfRekapAbsenDosen', compact(
        //     'regular',
        //     'month',
        //     'karyawan',
        //     'eksekutif',
        //     'inter'
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

        //pdf
        $regular = Pegawai::with(['absenDosen' => function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->where('hadir', 1)->where('kategori', 'Regular');
        }])->where('is_dosen', 1)->get();
        $karyawan = Pegawai::with(['absenDosen' => function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->where('hadir', 1)->where('kategori', 'Karyawan');
        }])->where('is_dosen', 1)->get();
        $eksekutif = Pegawai::with(['absenDosen' => function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->where('hadir', 1)->where('kategori', 'Eksekutif / Semester Pendek');
        }])->where('is_dosen', 1)->get();
        $inter = Pegawai::with(['absenDosen' => function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->where('hadir', 1)->where('kategori', 'International Teori');
        }])->where('is_dosen', 1)->get();
        $pdf = PDF::loadView('admin.keuangan.pdfRekapAbsenDosen', compact(
            'regular',
            'month',
            'karyawan',
            'eksekutif',
            'inter',
            'tahun'
        ));
        if (env('APP_ENV') == 'heroku') {
            $imageKit = $this->imageKit();
            $path = base_path('public/uploads/files/');
            $pdf->setPaper('a4')->setOption('header-html', view('header'))->save($path . $fpdf);
            $uploadFile = $imageKit->upload([
                'file' => fopen($path . $fpdf, "r"),
                'fileName' => $fpdf,
                'folder' => "sistem-akademik//rekap-absen-dosen//pdf//"
            ]);
            RekapAbsen::create([
                'excel' => '-',
                'pdf' => json_encode([
                    "field" => $uploadFile->success->fileId,
                    "url" => $uploadFile->success->url,
                ]),
                'tahun' => $year,
                'bulan' => $month,
                'is_staff' => false
            ]);
            File::delete($path . $fpdf);
        } else {
            //add excel
            Excel::store(new AbsenDosenExport($month, $year), 'rekap-absen-dosen/excel/' . $excel, 'public');
            $pdf->setPaper('a4')->setOption('header-html', view('header'))->save('storage/rekap-absen-dosen/pdf/' . $fpdf);
            RekapAbsen::create([
                'excel' => $excel,
                'pdf' => $fpdf,
                'tahun' => $year,
                'bulan' => $month,
                'is_staff' => false
            ]);
        }


        return response()->json('Sukses');
    }

    public function deleteAbsenDosen($id)
    {
        $rekap = RekapAbsen::find($id);
        if (env('APP_ENV') == 'heroku') {
            $imageKit = $this->imageKit();
            $imageKit->deleteFile(json_decode($rekap->pdf)->field);
        } else {
            Storage::disk('public')->delete('rekap-absen-dosen/pdf/' . $rekap->pdf);
            Storage::disk('public')->delete('rekap-absen-dosen/excel/' . $rekap->excel);
        }
        $rekap->delete();
        return response()->json('Sukses');
    }

    public function absenStaff()
    {
        $m = date('n');
        $y = date('Y');
        $bulan = array_slice(getBulan(), 0, $m);
        // $absen = Pegawai::with(['absenStaff' => function ($q) use ($m, $y) {
        //     $q->whereMonth('tanggal', $m)->whereYear('tanggal', $y)->where('hadir', 1);
        // }])
        //     ->where('is_staff', 1)->get();
        // return view('admin.hrd.pdfRekapAbsen', compact('absen', 'm'));

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
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->where('hadir', 1);
        }])->where('is_staff', 1)->get();
        $pdf = PDF::loadView('admin.hrd.pdfRekapAbsen', compact('absen', 'month', 'tahun'));
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
