<?php

namespace App\Http\Controllers;

use App\Http\Requests\GajiDosenRequest;
use App\Http\Requests\GajiRequest;
use App\Models\Dosen;
use App\Models\GajiDosen;
use App\Models\LaporanGaji;
use App\Models\MasterGajiDosen;
use App\Models\MasterGajiStaff;
use App\Models\Pegawai;
use App\Models\SlipGajiDosen;
use App\Models\SlipGajiStaff;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;

class GajiController extends Controller
{
    /*
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
    */

    public function indexStaff()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $data = Pegawai::where('is_staff', 1)->get();
        return view('admin.keuangan.indexStaff', compact('bulan', 'data'));
    }

    public function gajiStaff($bulan, Pegawai $staff)
    {
        if ($staff->is_staff != 1) abort(404);
        $absen =  $staff->absenStaff()->whereMonth('tanggal', $bulan)->where('hadir', 1)->get();
        $gaji = $staff->detailStaff;
        return view('admin.keuangan.detailStaff', compact('gaji', 'absen'));
    }

    public function gajiStaffStore($bulan, Pegawai $staff, Request $request)
    {
        // dd($request->all());
        $slip = SlipGajiStaff::firstOrCreate([
            'pegawai_id' => $staff->id,
            'bulan' =>  $bulan,
            'tahun' => date('Y')
        ]);
        $slip->gaji_pokok = $request->gaji;
        $slip->lembur = $request->lembur;
        $slip->absen = $request->absen;
        $slip->makan = $request->makan;
        $slip->jabatan = $request->jabatan;
        $slip->keahlian = $request->keahlian;
        $slip->pulsa = $request->pulsa;
        $slip->tol = $request->tol;
        $slip->kurang_gaji = $request->kurangGaji;
        $slip->reward = $request->reward;
        $slip->thr = $request->thr;
        $slip->bpjs_kesehatan = $request->bpjsKesehatan;
        $slip->bpjs_kerja = $request->bpjsKerja;
        $slip->izin = $request->izin;
        $slip->telat = $request->telat;
        $slip->alpha = $request->alpha;
        $slip->sanksi = $request->sanksi;
        $slip->kasbon = $request->kasbon;
        $slip->makanNonDinas = $request->makanNonDinas;
        $slip->potonganLain = $request->potonganLain;
        $slip->gaji_kotor = $request->gajiKotor;
        $slip->total_potongan = $request->potongan;
        $slip->gaji_bersih = $request->gajiBersih;
        $slip->save();
        return redirect()->route('admin.penggajian.staff')->with(['success' => 'Berhasil menyimpan slip']);
    }

    /*
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
    */

    public function indexDosen()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $data = Pegawai::where('is_dosen', 1)->get();
        return view('admin.keuangan.indexDosen', compact('bulan', 'data'));
    }

    public function gajiDosen($bulan, Pegawai $dosen)
    {
        if ($dosen->is_dosen != 1) abort(404);
        // $kategori = [];
        // foreach ($dosen->dosen as $kat) {
        //     array_push($kategori, $kat->id);
        // }
        // dd($kategori);
        $cek = $dosen->slipDosen()->where('bulan', $bulan)->where('tahun', date('Y'))->first();
        if ($cek) {
            $gaji = $cek;
            $ta = $skripsi = $penguji = $koor = $wali = $kp = null;
        } else {
            $ta = $dosen->dosen()->where('kategori_id', 1)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $skripsi = $dosen->dosen()->where('kategori_id', 2)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $penguji = $dosen->dosen()->where('kategori_id', 3)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $koor = $dosen->dosen()->where('kategori_id', 4)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $wali = $dosen->dosen()->where('kategori_id', 5)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $kp = $dosen->dosen()->where('kategori_id', 6)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $gaji = $dosen->detailDosen;
        }
        $absen =  $dosen->absenDosen()->whereMonth('tanggal', $bulan)->where('hadir', 1)->get();
        if ($bulan > 6) $ganjil = TRUE;
        else $ganjil = FALSE;
        return view('admin.keuangan.detailDosen', compact(
            'absen',
            'gaji',
            'ta',
            'skripsi',
            'penguji',
            'koor',
            'wali',
            'kp',
            'ganjil'
        ));
    }

    public function gajiDosenStore($bulan, Pegawai $dosen, Request $request)
    {
        // dd($request->all());
        $slip = SlipGajiDosen::firstOrCreate([
            'pegawai_id' => $dosen->id,
            'bulan' =>  $bulan,
            'tahun' => date('Y')
        ]);
        $slip->mengajar =  $request->mengajar;
        $slip->transport =  $request->transport;
        $slip->waliTotal =  $request->waliTotal;
        $slip->wali =  $request->wali;
        $slip->absen =  $request->absen;
        $slip->regular =  $request->regular;
        $slip->karyawan =  $request->karyawan;
        $slip->karyawanTotal =  $request->karyawanTotal;
        $slip->eksekutif =  $request->eksekutif;
        $slip->eksekutifTotal =  $request->eksekutifTotal;
        $slip->interTeoriTotal =  $request->interTeoriTotal;
        $slip->interTeori =  $request->interTeori;
        $slip->interPraktekTotal =  $request->interPraktekTotal;
        $slip->interPraktek =  $request->interPraktek;
        $slip->kerjaPraktekTotal =  $request->kerjaPraktekTotal;
        $slip->kerjaPraktek =  $request->kerjaPraktek;
        $slip->skripsi1Total =  $request->skripsi1Total;
        $slip->skripsi1 =  $request->skripsi1;
        $slip->skripsi2Total =  $request->skripsi2Total;
        $slip->skripsi2 =  $request->skripsi2;
        $slip->ta1Total =  $request->ta1Total;
        $slip->ta1 =  $request->ta1;
        $slip->ta2Total =  $request->ta2Total;
        $slip->ta2 =  $request->ta2;
        $slip->seminarSkripsiTotal =  $request->seminarSkripsiTotal;
        $slip->seminarSkripsi =  $request->seminarSkripsi;
        $slip->seminarTerbukaTotal =  $request->seminarTerbukaTotal;
        $slip->seminarTerbuka =  $request->seminarTerbuka;
        $slip->proposalTotal =  $request->proposalTotal;
        $slip->proposal =  $request->proposal;
        $slip->ngujiTATotal =  $request->ngujiTATotal;
        $slip->ngujiTA =  $request->ngujiTA;
        $slip->koreksiRegularTotal =  $request->koreksiRegularTotal;
        $slip->koreksiRegular =  $request->koreksiRegular;
        $slip->koreksiKaryawanTotal =  $request->koreksiKaryawanTotal;
        $slip->koreksiKaryawan =  $request->koreksiKaryawan;
        $slip->koreksiInterTotal =  $request->koreksiInterTotal;
        $slip->koreksiInter =  $request->koreksiInter;
        $slip->soalRegularTotal =  $request->soalRegularTotal;
        $slip->soalRegular =  $request->soalRegular;
        $slip->soalKaryawanTotal =  $request->soalKaryawanTotal;
        $slip->soalKaryawan =  $request->soalKaryawan;
        $slip->soalInterTotal =  $request->soalInterTotal;
        $slip->soalInter =  $request->soalInter;
        $slip->pengawasTotal =  $request->pengawasTotal;
        $slip->pengawas =  $request->pengawas;
        $slip->lemburPengawasTotal =  $request->lemburPengawasTotal;
        $slip->lemburPengawas =  $request->lemburPengawas;
        $slip->koorTotal =  $request->koorTotal;
        $slip->koor =  $request->koor;
        $slip->gajiTotal =  $request->gajiTotal;
        $slip->save();
        return redirect()->route('admin.penggajian.dosen')->with(['success' => 'Berhasil menyimpan slip']);
    }

    /*
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
    */
}
