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
            $cek->save();
        }
        return response()->json([
            'status' => 200
        ]);
    }

    public function staff(Request $request)
    {
        $now = date('d-m-Y');
        return view('admin.hrd.absenStaff', compact('now'));
    }

    public function listStaff(Request $request)
    {
        $absen =  AbsenStaff::where('tanggal', date('Y-m-d', strtotime($request->tanggal)))->get();
        $dt = [];
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
            'total' => $no
        ]);
    }

    public function absenStaff(Request $request)
    {
        $absen =  AbsenStaff::where('tanggal', date('Y-m-d', strtotime($request->tanggal)))->get();
        foreach (array_combine($request->id, $request->absen) as $id => $hadir) {
            if ($absen->count()) {
                $cek = AbsenStaff::where([
                    ['pegawai_id', $id],
                    ['tanggal', date('Y-m-d', strtotime($request->tanggal))]
                ])->first();
                $cek->hadir = $hadir;
                $cek->save();
            } else {
                AbsenStaff::create([
                    'pegawai_id' => $id,
                    'hadir' => $hadir,
                    'tanggal' => date('Y-m-d', strtotime($request->tanggal))
                ]);
            }
        }
        return response()->json([
            'status' => 200
        ]);
    }
}
