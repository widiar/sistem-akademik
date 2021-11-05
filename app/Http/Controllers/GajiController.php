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

    public function indexStaff()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $data = Pegawai::where('is_staff', 1)->get();
        return view('admin.keuangan.indexStaff', compact('bulan', 'data'));
    }

    public function listStaff(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $pegawai = Pegawai::with(['slipStaff' => function ($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }])->where('is_staff', 1)->get();
        $no = 0;
        $data = [];
        foreach ($pegawai as $dt) {
            $data[] = [
                'id' => $dt->id,
                'no' => ++$no,
                'nip' => $dt->nip,
                'nama' => $dt->nama,
                'aksi' => $dt->slipStaff->count()
            ];
        }
        return response()->json($data);
    }

    public function pdfStaff($bulan, Pegawai $pegawai)
    {
        if ($pegawai->is_staff != 1) abort(404);
        // $pegawai = $pegawai->load(['slipStaff' => function ($q) use ($bulan) {
        //     $q->where('bulan', $bulan)->where('tahun', date('Y'));
        // }]);
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $gaji = SlipGajiStaff::where([
            ['pegawai_id', $pegawai->id],
            ['bulan', $bulan],
            ['tahun', $tahun]
        ])->first();
        // dd($pegawai, $gaji);
        $pdf = PDF::loadView('admin.keuangan.pdf.staff', compact('pegawai', 'gaji'));
        $pdf->setOption('header-html', view('header'));
        return $pdf->stream();
    }

    public function gajiStaff($bulan, Pegawai $staff)
    {
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        if ($staff->is_staff != 1) abort(404);
        $absen =  $staff->absenStaff()->whereMonth('tanggal', $bulan)->where('hadir', 1)->get();
        $cek = $staff->slipStaff()->where('bulan', $bulan)->where('tahun', $tahun)->first();
        $insentif = $staff->insentif()->where('bulan', $bulan)->where('tahun', $tahun)->first();
        if ($cek) {
            $gaji = $cek;
            $insentif = $cek->insentif_marketing;
        } else {
            $gaji = $staff->detailStaff;
            if ($insentif) $insentif = $insentif->jumlah;
            else $insentif = 0;
        }
        return view('admin.keuangan.detailStaff', compact('gaji', 'absen', 'insentif'));
    }

    public function gajiStaffStore($bulan, Pegawai $staff, Request $request)
    {
        // dd($request->all());
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $slip = SlipGajiStaff::firstOrCreate([
            'pegawai_id' => $staff->id,
            'bulan' =>  $bulan,
            'tahun' => $tahun
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
        $slip->izinTotal = $request->izinTotal;
        $slip->telat = $request->telat;
        $slip->telatTotal = $request->telatTotal;
        $slip->alpha = $request->alpha;
        $slip->alphaTotal = $request->alphaTotal;
        $slip->sanksi = $request->sanksi;
        $slip->kasbon = $request->kasbon;
        $slip->makanNonDinas = $request->makanNonDinas;
        $slip->potonganLain = $request->potonganLain;
        $slip->gaji_kotor = $request->gajiKotor;
        $slip->total_potongan = $request->potongan;
        $slip->gaji_bersih = $request->gajiBersih;
        $slip->insentif_marketing = ($request->insentifMarketing == NULL) ? 0 : $request->insentifMarketing;
        $slip->save();
        return redirect()->route('admin.penggajian.staff')->with(['success' => 'Berhasil menyimpan slip']);
    }


    public function indexDosen()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $data = Pegawai::where('is_dosen', 1)->get();
        return view('admin.keuangan.indexDosen', compact('bulan', 'data'));
    }

    public function listDosen(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $pegawai = Pegawai::with(['slipDosen' => function ($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }])->where('is_dosen', 1)->get();
        $no = 0;
        $data = [];
        foreach ($pegawai as $dt) {
            $data[] = [
                'id' => $dt->id,
                'no' => ++$no,
                'nip' => $dt->nip,
                'nama' => $dt->nama,
                'aksi' => $dt->slipDosen->count()
            ];
        }
        return response()->json($data);
    }

    public function pdfDosen($bulan, Pegawai $pegawai)
    {
        if ($pegawai->is_dosen != 1) abort(403);
        // $pegawai = $pegawai->load(['slipStaff' => function ($q) use ($bulan) {
        //     $q->where('bulan', $bulan)->where('tahun', date('Y'));
        // }]);
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $gaji = SlipGajiDosen::where([
            ['pegawai_id', $pegawai->id],
            ['bulan', $bulan],
            ['tahun', $tahun]
        ])->first();
        // dd($pegawai, $gaji);
        $pdf = PDF::loadView('admin.keuangan.pdf.dosen', compact('pegawai', 'gaji'));
        $pdf->setOption('header-html', view('header'));
        return $pdf->stream();
    }

    public function gajiDosen($bulan, Pegawai $dosen)
    {
        if ($dosen->is_dosen != 1) abort(404);

        $bulanTahun = $bulan;
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];

        $pegawai = $dosen->load(['dosen' => function ($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }]);

        $cek = $dosen->slipDosen()->where('bulan', $bulan)->where('tahun', $tahun)->first();
        if ($cek) {
            $gaji = $cek;
        } else {
            $gaji = $dosen->detailDosen;
        }
        $absen =  $dosen->absenDosen()->whereMonth('tanggal', $bulan)->where('hadir', 1)->get();
        return view('admin.keuangan.detailDosen', compact(
            'absen',
            'gaji',
            'pegawai',
            'bulanTahun'
        ));
    }

    public function gajiDosenStore($bulan, Pegawai $dosen, Request $request)
    {
        // dd($request->all());
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $slip = SlipGajiDosen::firstOrCreate([
            'pegawai_id' => $dosen->id,
            'bulan' =>  $bulan,
            'tahun' => $tahun
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
        // $slip->skripsi1Total =  $request->skripsi1Total;
        // $slip->skripsi1 =  $request->skripsi1;
        $slip->skripsi2Pembimbing1Total =  $request->skripsi2Pembimbing1Total;
        $slip->skripsi2Pembimbing1 =  $request->skripsi2Pembimbing1;
        $slip->skripsi2Pembimbing2Total =  $request->skripsi2Pembimbing2Total;
        $slip->skripsi2Pembimbing2 =  $request->skripsi2Pembimbing2;
        // $slip->ta1Total =  $request->ta1Total;
        // $slip->ta1 =  $request->ta1;
        $slip->ta2Pembimbing1Total =  $request->ta2Pembimbing1Total;
        $slip->ta2Pembimbing1 =  $request->ta2Pembimbing1;
        $slip->ta2Pembimbing2Total =  $request->ta2Pembimbing2Total;
        $slip->ta2Pembimbing2 =  $request->ta2Pembimbing2;
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

    public function laporan()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $laporan = LaporanGaji::all();
        return view('admin.keuangan.laporanGaji', compact('bulan', 'laporan'));
    }

    public function buatLaporan(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $cek = LaporanGaji::where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid() . ".pdf";

        LaporanGaji::create([
            'dosen' => "dosen" . $filename,
            'staff' => "staff" . $filename,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);

        //pdf
        $gajiStaff = SlipGajiStaff::with('pegawai')->where('bulan', $bulan)->where('tahun', $tahun)->get();
        $pdfStaff = PDF::loadView('admin.keuangan.pdf.laporanStaff', compact('gajiStaff'));
        $pdfStaff->setOption('header-html', view('header'))->save('storage/laporan-gaji/staff/staff' . $filename);

        $gajiDosen = SlipGajiDosen::with('pegawai')->where('bulan', $bulan)->where('tahun', $tahun)->get();
        $pdfDosen = PDF::loadView('admin.keuangan.pdf.laporanDosen', compact('gajiDosen'));
        $pdfDosen->setOption('header-html', view('header'))->save('storage/laporan-gaji/dosen/dosen' . $filename);

        return response()->json('Sukses');
    }
    public function deleteLaporan($id)
    {
        $laporan = LaporanGaji::find($id);
        Storage::disk('public')->delete('laporan-gaji/dosen/' . $laporan->dosen);
        Storage::disk('public')->delete('laporan-gaji/staff/' . $laporan->staff);
        $laporan->delete();
        return response()->json('Sukses');
    }
}
