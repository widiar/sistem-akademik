<?php

namespace App\Http\Controllers;

use App\Models\AbsenDosen;
use App\Models\Dosen;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function dosen(Request $request)
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);

        if ($request->search) {
            $cek = Dosen::where('nip', 'like', "%$request->search%")->where('is_dosen', true);
            if ($cek->exists()) $dosen = $cek->paginate(10);
            else $dosen = Dosen::where('nama', 'like', "%$request->search%")->where('is_dosen', true)->paginate(10);
        } else
            $dosen = Dosen::where('is_dosen', true)->paginate(10);

        return view('admin.akademik.absenDosen', compact('dosen', 'bulan'));
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
        $dosen = Dosen::find($request->dosen);
        $sks = $dosen->sks()->where('tahun_ajaran', tahunAjaran())->first();
        if ($sks) {
            if ($request->bulan <= 6) {
                if ($request->sks > ($sks->semester_genap * 4)) return response()->json('Lebih');
            } else {
                if ($request->sks > ($sks->semester_ganjil * 4)) return response()->json('Lebih');
            }
        }
        //store
        $cek = $dosen->absen('where', tahunAjaran())->where('bulan', $request->bulan)->first();
        if ($cek) {
            $cek->absen = $request->sks;
            $cek->save();
        } else {
            $absen = new AbsenDosen([
                'bulan' => $request->bulan,
                'absen' => $request->sks,
                'tahun_ajaran' => tahunAjaran()
            ]);
            $dosen->absen()->save($absen);
        }
        return response()->json('Sukses');
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
