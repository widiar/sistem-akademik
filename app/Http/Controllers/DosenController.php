<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenRequest;
use App\Models\KategoriDosen;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Pegawai::where('is_dosen', true)->get();
        return view('admin.akademik.dosen',  compact('dosen'));
    }

    /*
    public function create()
    {
        $kategori = KategoriDosen::all();
        return view('admin.akademik.addDosen', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
        ]);
        $dosen = Pegawai::create([
            'nip' => $request->nip,
            'nama' =>  $request->nama,
            'staf_akademik' => true,
        ]);
        $data = [];
        if (in_array(1, $request->kategori)) {
            $data[1] = [
                'semester_ganjil' => $request->sksGanjil,
                'semester_genap' => $request->sksGenap,
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(2, $request->kategori)) {
            $data[2] = [
                'semester_ganjil' => $request->pGanjil,
                'semester_genap' => $request->pGenap,
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(3, $request->kategori)) {
            $data[3] = [
                'semester_ganjil' => $request->pjGanjil,
                'semester_genap' =>  $request->pjGenap,
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(4, $request->kategori)) {
            $data[4] = [
                'semester_ganjil' => $request->kGanjil,
                'semester_genap' => $request->kGenap,
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(5, $request->kategori)) {
            $data[5] = [
                'semester_ganjil' => $request->wGanjil,
                'semester_genap' => $request->wGenap,
                'tahun_ajaran' => tahunAjaran()
            ];
        }

        $dosen->kategori()->attach($data);

        return redirect()->route('admin.dosen')->with(['success' => 'Berhasil menambah dosen']);
    }
    */

    public function show($id)
    {
        //
    }

    public function edit(Pegawai $pegawai)
    {
        $tmp = [];
        if ($pegawai->is_dosen === FALSE || $pegawai->is_dosen === NULL) abort(404);
        $kategori = KategoriDosen::all();
        // dd($pegawai->dosen);
        $ta = $pegawai->dosen()->where('kategori_id', 1)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $skripsi = $pegawai->dosen()->where('kategori_id', 2)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $penguji = $pegawai->dosen()->where('kategori_id', 3)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $koor = $pegawai->dosen()->where('kategori_id', 4)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $wali = $pegawai->dosen()->where('kategori_id', 5)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $kp = $pegawai->dosen()->where('kategori_id', 6)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        // dd(json_decode($ta->pivot->semester_ganjil));
        // $sks = $pembimbing = $penguji = $koor = $wali = null;
        return view('admin.akademik.editDosen', compact(
            'kategori',
            'pegawai',
            'ta',
            'skripsi',
            'penguji',
            'koor',
            'wali',
            'kp'
        ));
    }

    public function update(DosenRequest $request, Pegawai $dosen)
    {
        // dd($request->sksGanjil);
        // dd($request->all());

        $data = [];
        if (in_array(1, $request->kategori)) {
            $ganjil = [
                'ganjil' => $request->taGanjil,
                'ta1' => $request->ta1Ganjil,
                'ta2' => $request->ta2Ganjil
            ];
            $genap = [
                'genap' => $request->taGenap,
                'ta1' => $request->ta1Genap,
                'ta2' => $request->ta2Genap
            ];
            $data[1] = [
                'semester_ganjil' => json_encode($ganjil),
                'semester_genap' => json_encode($genap),
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(2, $request->kategori)) {
            $ganjil = [
                'ganjil' => $request->skripsiGanjil,
                'skripsi1' => $request->skripsi1Ganjil,
                'skripsi2' => $request->skripsi2Ganjil
            ];
            $genap = [
                'genap' => $request->skripsiGenap,
                'skripsi1' => $request->skripsi1Genap,
                'skripsi2' => $request->skripsi2Genap
            ];
            $data[2] = [
                'semester_ganjil' => json_encode($ganjil),
                'semester_genap' => json_encode($genap),
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(3, $request->kategori)) {
            $data[3] = [
                'semester_ganjil' => 0,
                'semester_genap' =>  0,
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(4, $request->kategori)) {
            $ganjil = [
                'ganjil' => $request->koorGanjil,
            ];
            $genap = [
                'genap' => $request->koorGenap,
            ];
            $data[4] = [
                'semester_ganjil' => json_encode($ganjil),
                'semester_genap' => json_encode($genap),
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(5, $request->kategori)) {
            $ganjil = [
                'ganjil' => $request->waliGanjil,
            ];
            $genap = [
                'genap' => $request->waliGenap,
            ];
            $data[5] = [
                'semester_ganjil' => json_encode($ganjil),
                'semester_genap' => json_encode($genap),
                'tahun_ajaran' => tahunAjaran()
            ];
        }
        if (in_array(6, $request->kategori)) {
            $ganjil = [
                'ganjil' => $request->kpGanjil,
            ];
            $genap = [
                'genap' => $request->kpGenap,
            ];
            $data[6] = [
                'semester_ganjil' => json_encode($ganjil),
                'semester_genap' => json_encode($genap),
                'tahun_ajaran' => tahunAjaran()
            ];
        }

        $dosen->dosen()->sync($data);
        $dosen->save();


        return redirect()->route('admin.dosen')->with(['success' => 'Berhasil update dosen']);
    }

    public function destroy(Pegawai $dosen)
    {
        $kategori = $dosen->dosen;
        $dosen->dosen()->detach($kategori);
        $dosen->delete();
        return response()->json('Sukses');
    }

    public function list(Request $request)
    {
        $search = $request->search;
        $dosen = Pegawai::where("nama", 'ilike', "%$search%")->where('is_dosen', 1)->get();
        $data = [];
        foreach ($dosen as $ds) {
            $data[] = [
                'id' => $ds->id,
                'text' => $ds->nama
            ];
        }
        return response()->json($data);
    }
}
