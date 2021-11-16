<?php

namespace App\Http\Controllers;

use App\Models\AbsenDosen;
use App\Models\AbsenStaff;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function dosen(Request $request)
    {
        $m = date('n');
        $now = date('d-m-Y');
        $bulan = array_slice(getBulan(), 0, $m);
        $dosen = Pegawai::where('is_dosen', true)->get();
        $matakuliah = MataKuliah::all();

        return view('admin.akademik.absenDosen', compact('dosen', 'bulan', 'matakuliah', 'now'));
    }

    public function list(Request $request)
    {
        $hari = dayInIndonesia(date('D', strtotime($request->tanggal)));
        $dt = [];
        $no = 0;
        $matakuliah = MataKuliah::with('dosen')->where('hari', $hari)->where('kategori', $request->kategori)->get();
        foreach ($matakuliah as $mt) {
            $idDosen = $mt->dosen->id;
            $absen = $mt->load('absen');
            $absen = $mt->absen()->where('tanggal', date('Y-m-d', strtotime($request->tanggal)))->first();
            // dd($cek->count(), $cek);
            $dt[] = [
                'no' => ++$no,
                'matakuliah' => $mt->nama,
                'nama' => $mt->dosen->nama,
                'jam' => $mt->jam,
                'id' => "$mt->id|$idDosen",
                'f' => ($absen) ? 1 : 0,
                'absen' => ($absen) ? $absen->hadir : 0
            ];
        }
        return response()->json([
            'data' => $dt,
            'total' => $no,
            // 'cek' => $c
        ]);
    }

    public function postAbsenDosen(Request $request)
    {
        $hadir = $request->absen;
        $matkul = [];
        $dosen = [];
        foreach ($request->id as $dt) {
            $tmp = explode('|', $dt);
            array_push($matkul, $tmp[0]);
            array_push($dosen, $tmp[1]);
        }
        // $absen =  AbsenDosen::where('tanggal', date('Y-m-d', strtotime($request->tanggal)))->get();
        foreach (array_map(NULL, $hadir, $matkul, $dosen) as $x) {
            list($h, $m, $d) = $x;
            $cek = AbsenDosen::firstOrCreate([
                'pegawai_id' => $d,
                'matakuliah_id' => $m,
                'tanggal' => date('Y-m-d', strtotime($request->tanggal))
            ]);
            $cek->hadir = $h;
            $cek->kategori = $request->kategori;
            $cek->save();
        }
        return response()->json([
            'status' => 200
        ]);
    }

    public function staff(Request $request)
    {
        $now = date('d-m-Y');
        $dosen = Pegawai::where('is_staff', true)->get();
        return view('admin.hrd.absenStaff', compact('now', 'dosen'));
    }

    public function showAbsenStaff(Pegawai $pegawai, $bulan)
    {
        $bulanTahun = $bulan;
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];

        if ($pegawai->is_staff === FALSE || $pegawai->is_staff === NULL) abort(404);

        $pegawai = $pegawai->load(['absenStaff' => function ($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }]);
        // dd($pegawai);
        return view('admin.hrd.showAbsenStaff', compact('bulanTahun', 'pegawai'));
    }

    public function postAbsenStaff(Pegawai $pegawai, $bulan, Request $request)
    {
        $request->validate([
            'cuti' => 'required|integer',
            'sakit' => 'required|integer',
            'izin' => 'required|integer',
            'alpha' => 'required|integer',
            'short' => 'required|integer',
            'telat_kurang' => 'required|integer',
            'telat_lebih' => 'required|integer',
            'no_finger' => 'required|integer',
            'total_SIA' => 'required|integer',
        ]);
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];

        $cek = AbsenStaff::firstOrCreate([
            'pegawai_id' => $pegawai->id,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
        $cek->cuti = $request->cuti;
        $cek->sakit = $request->sakit;
        $cek->izin = $request->izin;
        $cek->alpha = $request->alpha;
        $cek->short = $request->short;
        $cek->telat_kurang = $request->telat_kurang;
        $cek->telat_lebih = $request->telat_lebih;
        $cek->no_finger = $request->no_finger;
        $cek->total_SIA = $request->total_SIA;
        $cek->save();

        return redirect()->route('admin.absen.staff')->with(['success' => 'Berhasil menyimpan data']);
    }

    public function listStaff(Request $request)
    {
        $absen =  AbsenStaff::where('tanggal', date('Y-m-d', strtotime($request->tanggal)))->get();
        $dt = [];
        $sudahAbsen = [];
        $no = 0;
        if ($absen->count()) {
            foreach ($absen as $a) {
                $dt[] = [
                    'no' => ++$no,
                    'nama' => $a->pegawai->nama,
                    'id' => $a->pegawai->id,
                    'f' => 1,
                    'absen' => $a->hadir
                ];
                $sudahAbsen[] = [
                    'id' => $a->pegawai->id,
                    'is_hadir' => $a->hadir,
                    'is_izin' => $a->izin,
                    'keterangan' => $a->keterangan
                ];
            }
        } else {
            $data = Pegawai::where('is_staff', 1)->get();
            foreach ($data as $ds) {
                $dt[] = [
                    'no' => ++$no,
                    'nama' => $ds->nama,
                    'id' => $ds->id,
                    'f' => 0,
                    'absen' => 0
                ];
            }
        }
        return response()->json([
            'data' => $dt,
            'total' => $no,
            'absen' => $sudahAbsen
        ]);
    }

    public function absenStaff(Request $request)
    {
        // dd($request->data[0]['id']);
        $absen =  AbsenStaff::where('tanggal', date('Y-m-d', strtotime($request->tanggal)))->get();
        foreach ($request->data as $data) {
            $cek = AbsenStaff::firstOrCreate([
                'pegawai_id' => $data['id'],
                'tanggal' => date('Y-m-d', strtotime($request->tanggal))
            ]);
            $cek->hadir = ($data['is_hadir'] == "true") ? 1 : 0;
            $cek->izin = isset($data['is_izin']) ? 1 : NULL;
            $cek->keterangan = isset($data['keterangan']) ? $data['keterangan'] : NULL;
            $cek->save();
        }
        return response()->json([
            'status' => 200
        ]);
    }
}
