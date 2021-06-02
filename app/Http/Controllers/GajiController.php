<?php

namespace App\Http\Controllers;

use App\Http\Requests\GajiRequest;
use App\Models\Dosen;
use App\Models\GajiDosen;
use App\Models\LaporanGaji;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;

class GajiController extends Controller
{
    public function index()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $dosen = GajiDosen::where('jabatan', 'dosen')->first();
        $staff = GajiDosen::where('jabatan', 'staff')->first();
        $marketing = GajiDosen::where('jabatan', 'marketing')->first();
        return view('admin.keuangan.penggajian', compact('dosen', 'staff', 'marketing', 'bulan'));
    }

    public function store(GajiRequest $request)
    {
        $dosen = GajiDosen::where('jabatan', 'dosen')->first();
        $staff = GajiDosen::where('jabatan', 'staff')->first();
        $marketing = GajiDosen::where('jabatan', 'marketing')->first();
        if ($dosen) {
            $dosen->pokok = $request->pokokDosen;
            $dosen->tunjangan = $request->tunjanganDosen;
            $dosen->bonus = $request->bonusDosen;
            $dosen->save();
        } else {
            GajiDosen::create([
                'jabatan' => 'dosen',
                'pokok' => $request->pokokDosen,
                'tunjangan' => $request->tunjanganDosen,
                'bonus' => $request->bonusDosen,
            ]);
        }

        if ($staff) {
            $staff->pokok = $request->pokokStaff;
            $staff->tunjangan = $request->tunjanganStaff;
            $staff->bonus = $request->bonusStaff;
            $staff->save();
        } else {
            GajiDosen::create([
                'jabatan' => 'staff',
                'pokok' => $request->pokokStaff,
                'tunjangan' => $request->tunjanganStaff,
                'bonus' => $request->bonusStaff,
            ]);
        }

        if ($marketing) {
            $marketing->pokok = $request->pokokMarketing;
            $marketing->tunjangan = $request->tunjanganMarketing;
            $marketing->bonus = $request->bonusMarketing;
            $marketing->save();
        } else {
            GajiDosen::create([
                'jabatan' => 'marketing',
                'pokok' => $request->pokokMarketing,
                'tunjangan' => $request->tunjanganMarketing,
                'bonus' => $request->bonusMarketing,
            ]);
        }
        return redirect()->route('admin.penggajian')->with(['success' => 'Berhasil update Data']);
    }

    public function buatLaporan(Request $request)
    {
        $cek = LaporanGaji::where('tahun', date('Y'))->where('bulan', $request->bulan)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid() . ".pdf";
        $tahun = date('Y');
        $bulan = $request->bulan;

        LaporanGaji::create([
            'file' => $filename,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);

        //pdf
        $dataDosen = Dosen::all();
        $dosen = GajiDosen::where('jabatan', 'dosen')->first();
        $staff = GajiDosen::where('jabatan', 'staff')->first();
        $marketing = GajiDosen::where('jabatan', 'marketing')->first();
        $pdf = PDF::loadView('admin.keuangan.pdfLaporanKeuangan', compact('bulan', 'dataDosen', 'dosen', 'staff', 'marketing'));
        $pdf->setPaper('a4')->setOrientation('landscape')->save('storage/laporan-gaji/' . $filename);
        return response()->json('Sukses');
    }

    public function laporan()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $laporan = LaporanGaji::all();
        return view('admin.keuangan.laporanGaji', compact('bulan', 'laporan'));
    }

    public function deleteLaporan($id)
    {
        $laporan = LaporanGaji::find($id);
        Storage::disk('public')->delete('laporan-gaji/' . $laporan->file);
        $laporan->delete();
        return response()->json('Sukses');
    }
}
