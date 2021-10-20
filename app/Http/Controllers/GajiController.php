<?php

namespace App\Http\Controllers;

use App\Http\Requests\GajiDosenRequest;
use App\Http\Requests\GajiRequest;
use App\Models\Dosen;
use App\Models\GajiDosen;
use App\Models\LaporanGaji;
use App\Models\MasterGajiDosen;
use App\Models\MasterGajiStaff;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;

class GajiController extends Controller
{
    public function staff()
    {
        $gaji = MasterGajiStaff::where('status', 2)->first();
        return view('admin.keuangan.staff', compact('gaji'));
    }

    public function storeStaff(GajiRequest $request)
    {
        // dd($request->all());
        $staff = MasterGajiStaff::firstOrCreate([
            'status' => 2
        ]);
        $staff->gaji = $request->gaji;
        $staff->lembur = $request->lembur;
        $staff->makan = $request->makan;
        $staff->jabatan = $request->jabatan;
        $staff->keahlian = $request->keahlian;
        $staff->pulsa = $request->pulsa;
        $staff->tol = $request->tol;
        $staff->kurang_gaji = $request->kurangGaji;
        $staff->reward = $request->reward;
        $staff->thr = $request->thr;
        $staff->bpjs_kesehatan = $request->bpjsKesehatan;
        $staff->bpjs_kerja = $request->bpjsKerja;
        $staff->izin = $request->izin;
        $staff->telat = $request->telat;
        $staff->gaji = $request->gaji;
        $staff->alpha = $request->alpha;
        $staff->sanksi = $request->sanksi;
        $staff->kasbon = $request->kasbon;
        $staff->makanNonDinas = $request->makanNonDinas;
        $staff->potonganLain = $request->potonganLain;
        $staff->save();
        return redirect()->route('admin.gaji.staff')->with(['success' => 'Berhasil Update Data']);
    }

    public function indexStaff()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $data = Dosen::all();
        return view('admin.keuangan.indexStaff', compact('bulan', 'data'));
    }

    public function gajiStaff($bulan, $id)
    {
        $dosen = Dosen::find($id);
        $absen =  $dosen->staff()->whereMonth('tanggal', $bulan)->where('hadir', 1)->get();
        $gaji = MasterGajiStaff::where('status', 2)->first();
        return view('admin.keuangan.detailStaff', compact('gaji', 'absen'));
    }

    public function gajiStaffStore($bulan, $id, Request $request)
    {
        dd($request->all());
    }

    public function dosen()
    {
        $gaji = MasterGajiDosen::where('status', 1)->first();
        return view('admin.keuangan.dosen', compact('gaji'));
    }

    public function storeDosen(GajiDosenRequest $request)
    {
        // dd($request->all());
        $data = MasterGajiDosen::firstOrCreate([
            'status' => 1
        ]);
        $data->mengajar = $request->mengajar;
        $data->wali = $request->wali;
        $data->transport = $request->transport;
        $data->regular = $request->regular;
        $data->karyawan = $request->karyawan;
        $data->eksekutif = $request->eksekutif;
        $data->interTeori = $request->interTeori;
        $data->interPraktek = $request->interPraktek;
        $data->kerjaPraktek = $request->kerjaPraktek;
        $data->skripsi1 = $request->skripsi1;
        $data->skripsi2 = $request->skripsi2;
        $data->ta1 = $request->ta1;
        $data->ta2 = $request->ta2;
        $data->seminarSkripsi = $request->seminarSkripsi;
        $data->seminarTerbuka = $request->seminarTerbuka;
        $data->proposal = $request->proposal;
        $data->ngujiTA = $request->ngujiTA;
        $data->koreksiRegular = $request->koreksiRegular;
        $data->koreksiKaryawan = $request->koreksiKaryawan;
        $data->koreksiInter = $request->koreksiInter;
        $data->soalRegular = $request->soalRegular;
        $data->soalKaryawan = $request->soalKaryawan;
        $data->soalInter = $request->soalInter;
        $data->dosenWali = $request->dosenWali;
        $data->pengawas = $request->pengawas;
        $data->lemburPengawas = $request->lemburPengawas;
        $data->koor = $request->koor;
        $data->save();
        return redirect()->route('admin.gaji.dosen')->with(['success' => 'Berhasil Update Data']);
    }

    public function indexDosen()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $data = Dosen::where('staf_akademik', 1)->get();
        return view('admin.keuangan.indexDosen', compact('bulan', 'data'));
    }

    public function gajiDosen($bulan, $id)
    {
        $dosen = Dosen::find($id);
        $kategori = [];
        foreach ($dosen->kategori as $kat) {
            array_push($kategori, $kat->id);
        }
        // dd($kategori);
        $absen =  $dosen->absen()->whereMonth('tanggal', $bulan)->where('hadir', 1)->get();
        $gaji = MasterGajiDosen::where('status', 1)->first();
        return view('admin.keuangan.detailDosen', compact('gaji', 'absen'));
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
