<?php

namespace App\Http\Controllers;

use App\Models\AbsenDosen;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function dosen(Request $request)
    {
        $m = date('n');
        $now = date('d-m-Y');
        $bulan = array_slice(getBulan(), 0, $m);
        $dosen = Dosen::where('staf_akademik', true)->get();
        $matakuliah = MataKuliah::all();

        return view('admin.akademik.absenDosen', compact('dosen', 'bulan', 'matakuliah', 'now'));
    }

    public function list(Request $request)
    {
        $hari = dayInIndonesia(date('D', strtotime($request->tanggal)));
        $absen =  AbsenDosen::where('tanggal', $request->tanggal)->get();
        $dt = [];
        $no = 0;
        if ($absen->count()) {
            foreach ($absen as $a) {
                $dt[] = [
                    'no' => ++$no,
                    'matakuliah' => $a->matkul->nama,
                    'nama' => $a->dosen->nama,
                    'jam' => $a->matkul->jam,
                    'id' => $a->matkul->id . "|" . $a->dosen->id,
                    'f' => 1,
                    'absen' => $a->hadir
                ];
            }
        } else {
            $matakuliah = MataKuliah::where('hari', $hari)->get();
            foreach ($matakuliah as $mt) {
                foreach ($mt->dosen as $ds) {
                    $dt[] = [
                        'no' => ++$no,
                        'matakuliah' => $mt->nama,
                        'nama' => $ds->nama,
                        'jam' => $mt->jam,
                        'id' => "$mt->id|$ds->id",
                        'f' => 0,
                        'absen' => 0
                    ];
                }
            }
        }
        return response()->json([
            'data' => $dt,
            'total' => $no
        ]);
    }

    public function cekSks(Dosen $dosen)
    {

        $sks = $dosen->sks()->where('tahun_ajaran', tahunAjaran())->first();
        // dd($sks->semester_genap);
        if ($sks) {
            $m = date('n');
            if ($m <= 6) {
                if ($sks->semester_genap) {
                    $a = $dosen->absen('where', tahunAjaran())->where('bulan', $m)->first();
                    if ($a) $absen = $a->absen;
                    else $absen = '';
                    return response()->json([
                        'absen' => $absen,
                        'msg' => 'Ada'
                    ]);
                } else return response()->json(['msg' => 'Tidak']);
            } else {
                if ($sks->semester_ganjil) {
                    $a = $dosen->absen('where', tahunAjaran())->where('bulan', $m)->first();
                    if ($a) $absen = $a->absen;
                    else $absen = '';
                    return response()->json([
                        'absen' => $absen,
                        'msg' => 'Ada'
                    ]);
                } else return response()->json(['msg' => 'Tidak']);
            }
        } else return response()->json(['msg' => 'Tidak']);
    }

    public function ambilAbsenDosen(Dosen $dosen, $bulan)
    {
        $absen = $dosen->absen('where', tahunAjaran())->where('bulan', $bulan)->first();
        if ($absen)
            return response()->json([
                'absen' => $absen->absen,
                'msg' => 'Ada'
            ]);
        else return response()->json(['msg' => 'Tidak']);
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
        $absen =  AbsenDosen::where('tanggal', $request->tanggal)->get();
        foreach (array_map(NULL, $hadir, $matkul, $dosen) as $x) {
            list($h, $m, $d) = $x;
            if ($absen->count()) {
                $cek = AbsenDosen::where([
                    ['dosen_id', $d],
                    ['matakuliah_id', $m],
                    ['tanggal', $request->tanggal]
                ])->first();
                $cek->hadir = $h;
                $cek->save();
            } else {
                AbsenDosen::create([
                    'dosen_id' => $d,
                    'matakuliah_id' => $m,
                    'hadir' => $h,
                    'tanggal' => $request->tanggal
                ]);
            }
        }
        return response()->json([
            'status' => 200
        ]);
    }

    public function staff(Request $request)
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);

        if ($request->search) {
            $cek = Dosen::where('nip', 'like', "%$request->search%")->where('is_staff', true)->where('is_dosen', false);
            if ($cek->exists()) $dosen = $cek->paginate(10);
            else $dosen = Dosen::where('nama', 'like', "%$request->search%")->where('is_staff', true)->where('is_dosen', false)->paginate(10);
        } else
            $dosen = Dosen::where('is_staff', true)->where('is_dosen', false)->paginate(10);

        return view('admin.hrd.absenStaff', compact('dosen', 'bulan'));
    }

    public function cekStaff(Dosen $dosen, $bulan)
    {
        $absen = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', $bulan)->first();
        if ($absen)
            return response()->json([
                'absen' => $absen->absen,
                'msg' => 'Ada'
            ]);
        else return response()->json(['msg' => 'Tidak']);
    }

    public function absenStaff(Request $request)
    {
        $dosen = Dosen::find($request->dosen);
        //store
        $cek = $dosen->absen('where', tahunAjaran())->where('bulan', $request->bulan)->first();
        if ($cek) {
            $cek->absen = $request->sks;
            $cek->save();
        } else {
            $absen = new AbsenDosen([
                'bulan' => $request->bulan,
                'absen' => $request->absen,
                'tahun_ajaran' => tahunAjaran()
            ]);
            $dosen->absen()->save($absen);
        }
        return response()->json('Sukses');
    }
}
