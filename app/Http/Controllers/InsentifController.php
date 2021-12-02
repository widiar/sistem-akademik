<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterInsentifRequest;
use App\Models\InsentifMarketing;
use App\Models\MasterInsentifMarketing;
use App\Models\Pegawai;
use App\Models\RekapInsentifMarketing;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;

class InsentifController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = Pegawai::with(['staff' => function ($q) {
            $q->where('jabatan', 'pemasaran');
        }])->where('is_staff', 1)->get();

        return view('admin.pemasaran.intensifMarketing', compact('pegawai'));
    }


    public function rekap()
    {
        $rekapan = RekapInsentifMarketing::all();
        return view('admin.pemasaran.insentifMarketing.rekap', compact('rekapan'));
    }

    public function postRekap(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $cek = RekapInsentifMarketing::where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($cek) return response()->json('Ada');

        $filename = uniqid() . ".pdf";
        $data = InsentifMarketing::with('pegawai')->where('bulan', $bulan)->where('tahun', $tahun)->get();
        $pdf = PDF::loadView('admin.pemasaran.insentifMarketing.rekappdf', compact('data'));
        $pdf->setOption('header-html', view('header'))->save('storage/rekap-insentif-marketing/' . $filename);

        RekapInsentifMarketing::create([
            'file' => $filename,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);

        return response()->json('Sukses');
    }

    public function deleteRekap($id)
    {
        $rekap = RekapInsentifMarketing::find($id);
        Storage::disk('public')->delete('rekap-insentif-marketing/' . $rekap->file);
        $rekap->delete();
        return response()->json('Sukses');
    }

    public function store(Request $request)
    {
        $insentif = InsentifMarketing::firstOrCreate([
            'pegawai_id' => $request->dosen,
            'tahun_ajaran' => tahunAjaran()
        ]);
        $insentif->jumlah = $request->jumlah;
        $insentif->save();

        return redirect()->route('admin.intensif-marketing.index')->with(['success' => 'Berhasil update data']);
    }

    public function show(Request $request)
    {
        $tmp = explode("-", $request->tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $pegawai = Pegawai::with(['insentif' => function ($q) use ($bulan, $tahun) {
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
                'aksi' => $dt->insentif->count()
            ];
        }
        return response()->json($data);
    }

    public function edit(Pegawai $staff, $tanggal)
    {
        if ($staff->is_staff != 1) abort(403);
        $cek = $staff->load(['staff' => function ($q) {
            $q->where('jabatan', 'pemasaran');
        }]);
        if ($cek->staff->count() < 1) abort(403);

        $tmp = explode("-", $tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $data = InsentifMarketing::where([
            ['pegawai_id', $staff->id],
            ['bulan', $bulan],
            ['tahun', $tahun]
        ])->first();
        if (!$data) $data = MasterInsentifMarketing::first();
        return view('admin.pemasaran.insentifMarketing.edit', compact('data'));
    }

    public function update(Pegawai $staff, $tanggal, Request $request)
    {
        $tmp = explode("-", $tanggal);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        // dd($request->all());
        $data = InsentifMarketing::firstOrCreate([
            'pegawai_id' => $staff->id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
        $data->total_daftar_regular = $request->total_daftar_regular;
        $data->daftar_regular = $request->daftar_regular;
        $data->total_daftar_dd_inter = $request->total_daftar_dd_inter;
        $data->daftar_dd_inter = $request->daftar_dd_inter;
        $data->total_daftar_dd_nasional = $request->total_daftar_dd_nasional;
        $data->daftar_dd_nasional = $request->daftar_dd_nasional;
        $data->total_registrasi_regular = $request->total_registrasi_regular;
        $data->registrasi_regular = $request->registrasi_regular;
        $data->total_registrasi_bisnis = $request->total_registrasi_bisnis;
        $data->registrasi_bisnis = $request->registrasi_bisnis;
        $data->total_registrasi_dd_inter = $request->total_registrasi_dd_inter;
        $data->registrasi_dd_inter = $request->registrasi_dd_inter;
        $data->total_registrasi_dd_nasional = $request->total_registrasi_dd_nasional;
        $data->registrasi_dd_nasional = $request->registrasi_dd_nasional;

        $data->total_wawancara = $request->wawancaraTotal;
        $data->wawancara = $request->wawancara;
        $data->jumlah = $request->total;
        $data->save();
        return redirect()->route('admin.insentif-marketing.index')->with(['success' => 'Berhasil update data']);
    }

    public function destroy($id)
    {
        //
    }

    public function master()
    {
        $data = MasterInsentifMarketing::first();
        return view('admin.pemasaran.insentifMarketing.master', compact('data'));
    }

    public function masterPost(MasterInsentifRequest $request)
    {
        $cek = MasterInsentifMarketing::all();
        if ($cek->count() > 0) {
            $data = $cek[0];
            $data->daftar_regular = $request->daftar_regular;
            $data->daftar_dd_inter = $request->daftar_dd_inter;
            $data->daftar_dd_nasional = $request->daftar_dd_nasional;
            $data->registrasi_regular = $request->registrasi_regular;
            $data->registrasi_bisnis = $request->registrasi_bisnis;
            $data->registrasi_dd_inter = $request->registrasi_dd_inter;
            $data->registrasi_dd_nasional = $request->registrasi_dd_nasional;
            $data->wawancara = $request->wawancara;
            $data->save();
        } else {
            MasterInsentifMarketing::create([
                'daftar_regular' => $request->daftar_regular,
                'daftar_dd_inter' => $request->daftar_dd_inter,
                'daftar_dd_nasional' => $request->daftar_dd_nasional,
                'registrasi_regular' => $request->registrasi_regular,
                'registrasi_bisnis' => $request->registrasi_bisnis,
                'registrasi_dd_inter' => $request->registrasi_dd_inter,
                'registrasi_dd_nasional' => $request->registrasi_dd_nasional,
                'wawancara' => $request->wawancara,
            ]);
        }
        return redirect()->route('admin.insentif.master')->with(['success' => 'Berhasil menyimpan data']);
    }
}
