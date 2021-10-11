<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\KategoriDosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('staf_akademik', true)->get();
        return view('admin.akademik.dosen',  compact('dosen'));
    }


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
        $dosen = Dosen::create([
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

    public function show($id)
    {
        //
    }

    public function edit(Dosen $dosen)
    {
        $tmp = [];
        foreach ($dosen->kategori as $k) array_push($tmp, $k->id);
        $kategori = KategoriDosen::whereNotIn('id', $tmp)->get();
        // dd($kategori, $dosen->kategori, $sks->pivot->semester_ganjil);
        $sks = $dosen->kategori()->where('kategori_id', 1)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $pembimbing = $dosen->kategori()->where('kategori_id', 2)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $penguji = $dosen->kategori()->where('kategori_id', 3)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $koor = $dosen->kategori()->where('kategori_id', 4)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $wali = $dosen->kategori()->where('kategori_id', 5)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        // $sks = $pembimbing = $penguji = $koor = $wali = null;
        return view('admin.akademik.editDosen', compact(
            'kategori',
            'dosen',
            'sks',
            'pembimbing',
            'penguji',
            'koor',
            'wali',
        ));
    }

    public function update(Request $request, Dosen $dosen)
    {
        // dd($request->sksGanjil);
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
        ]);
        $dosen->nip = $request->nip;
        $dosen->nama = $request->nama;

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

        $dosen->kategori()->sync($data);
        $dosen->save();


        return redirect()->route('admin.dosen')->with(['success' => 'Berhasil update dosen']);
    }

    public function destroy(Dosen $dosen)
    {
        $kategori = $dosen->kategori;
        $dosen->kategori()->detach($kategori);
        $dosen->delete();
        return response()->json('Sukses');
    }

    public function list(Request $request)
    {
        $search = $request->search;
        $dosen = Dosen::where("nama", 'like', "%$search%")->where('staf_akademik', 1)->get();
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
