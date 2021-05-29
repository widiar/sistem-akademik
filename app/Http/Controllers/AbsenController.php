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
        $bulan = array_slice($this->getBulan(), 0, $m);

        if ($request->search) {
            $cek = Dosen::where('nip', 'like', "%$request->search%");
            if ($cek->exists()) $dosen = $cek->paginate(10);
            else $dosen = Dosen::where('nama', 'like', "%$request->search%")->paginate(10);
        } else
            $dosen = Dosen::paginate(10);

        return view('admin.akademik.absenDosen', compact('dosen', 'bulan'));
    }

    public function cekSks(Dosen $dosen)
    {

        $sks = $dosen->sks()->where('tahun_ajaran', $this->tahunAjaran())->first();
        // dd($sks->semester_genap);
        if ($sks) {
            $m = date('n');
            if ($m <= 6) {
                if ($sks->semester_genap) {
                    $a = $dosen->absen('where', $this->tahunAjaran())->where('bulan', $m)->first();
                    if ($a) $absen = $a->absen;
                    else $absen = '';
                    return response()->json([
                        'absen' => $absen,
                        'msg' => 'Ada'
                    ]);
                } else return response()->json(['msg' => 'Tidak']);
            } else {
                if ($sks->semester_ganjil) {
                    $a = $dosen->absen('where', $this->tahunAjaran())->where('bulan', $m)->first();
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
        $absen = $dosen->absen('where', $this->tahunAjaran())->where('bulan', $bulan)->first();
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
        $sks = $dosen->sks()->where('tahun_ajaran', $this->tahunAjaran())->first();
        if ($sks) {
            if ($request->bulan <= 6) {
                if ($request->sks > ($sks->semester_genap * 4)) return response()->json('Lebih');
            } else {
                if ($request->sks > ($sks->semester_ganjil * 4)) return response()->json('Lebih');
            }
        }
        //store
        $cek = $dosen->absen('where', $this->tahunAjaran())->where('bulan', $request->bulan)->first();
        if ($cek) {
            $cek->absen = $request->sks;
            $cek->save();
        } else {
            $absen = new AbsenDosen([
                'bulan' => $request->bulan,
                'absen' => $request->sks,
                'tahun_ajaran' => $this->tahunAjaran()
            ]);
            $dosen->absen()->save($absen);
        }
        return response()->json('Sukses');
    }

    protected function getBulan()
    {
        return [
            (object)["id" => 1, "name" => "Januari"],
            (object)["id" => 2, "name" => "Februari"],
            (object)["id" => 3, "name" => "Maret"],
            (object)["id" => 4, "name" => "April"],
            (object)["id" => 5, "name" => "Mei"],
            (object)["id" => 6, "name" => "Juni"],
            (object)["id" => 7, "name" => "Juli"],
            (object)["id" => 8, "name" => "Agustus"],
            (object)["id" => 9, "name" => "September"],
            (object)["id" => 10, "name" => "Oktober"],
            (object)["id" => 11, "name" => "November"],
            (object)["id" => 12, "name" => "Desember"],
        ];
    }
    protected function tahunAjaran()
    {
        $month = date('n');
        $year = date('Y');
        if ($month <= 6) {
            $y = $year - 1;
            $tahunAjaran = $y . "/" . $year;
        } else {
            $y = $year + 1;
            $tahunAjaran = $year . "/" . $y;
        }
        return $tahunAjaran;
    }
}
