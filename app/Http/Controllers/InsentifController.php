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
use ImageKit\ImageKit;
use Illuminate\Support\Facades\File;

class InsentifController extends Controller
{
    protected function imageKit()
    {
        return new imageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_SECRET_KEY'),
            env('IMAGE_KIT_ENDPOINT')
        );
    }
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

        if (env('APP_ENV') == 'local') {
            $pdf->setOption('header-html', view('header'))->save('storage/rekap-insentif-marketing/' . $filename);
            RekapInsentifMarketing::create([
                'file' => $filename,
                'bulan' => $bulan,
                'tahun' => $tahun
            ]);
        } else {
            $imageKit = $this->imageKit();
            $path = base_path('public/uploads/files/');
            $pdf->setOption('header-html', view('header'))->save($path . $filename);
            $uploadFile = $imageKit->upload([
                'file' => fopen($path . $filename, "r"),
                'fileName' => $filename,
                'folder' => "sistem-akademik//rekap-insentif-marketing//"
            ]);
            RekapInsentifMarketing::create([
                'file' => json_encode([
                    "field" => $uploadFile->success->fileId,
                    "url" => $uploadFile->success->url,
                ]),
                'bulan' => $bulan,
                'tahun' => $tahun
            ]);
            File::delete($path . $filename);
        }

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
        $data->total_daftar = $request->daftarTotal;
        $data->daftar = $request->daftar;
        $data->total_regular = $request->regularTotal;
        $data->regular = $request->regular;
        $data->total_karyawan = $request->karyawanTotal;
        $data->karyawan = $request->karyawan;
        $data->total_international = $request->internationalTotal;
        $data->international = $request->international;
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
            $data->daftar = $request->daftar;
            $data->regular = $request->regular;
            $data->karyawan = $request->karyawan;
            $data->international = $request->international;
            $data->wawancara = $request->wawancara;
            $data->save();
        } else {
            MasterInsentifMarketing::create([
                'daftar' => $request->daftar,
                'regular' => $request->regular,
                'karyawan' => $request->karyawan,
                'international' => $request->international,
                'wawancara' => $request->wawancara,
            ]);
        }
        return redirect()->route('admin.insentif.master')->with(['success' => 'Berhasil menyimpan data']);
    }
}
