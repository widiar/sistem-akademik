<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\KategoriDosen;
use App\Models\KDosen;
use App\Models\PDosen;
use App\Models\PjDosen;
use App\Models\SksDosen;
use App\Models\WDosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function create($tipe)
    {
        $kategori = KategoriDosen::all();
        return view('admin.akademik.addDosen', compact('kategori', 'tipe'));
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
            'nama' =>  $request->nama
        ]);
        $dosen->kategori()->attach($request->kategori);

        return redirect()->route('admin.dosen.list', $request->tipe)->with(['success' => 'Berhasil menambah dosen']);
    }

    public function show($id)
    {
        //
    }

    public function edit(Dosen $dosen, $tipe)
    {
        $tmp = [];
        foreach ($dosen->kategori as $k) array_push($tmp, $k->id);
        $kategori = KategoriDosen::whereNotIn('id', $tmp)->get();
        $sks = $dosen->sks()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $pembimbing = $dosen->pembimbing()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $penguji = $dosen->penguji()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $koor = $dosen->koordinator()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $wali = $dosen->wali()->where('tahun_ajaran', $this->tahunAjaran())->first();
        return view('admin.akademik.editDosen', compact(
            'kategori',
            'dosen',
            'tipe',
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
        $dosen->kategori()->sync($request->kategori);
        $dosen->save();

        //pengajar
        $sks = $dosen->sks()->where('tahun_ajaran', $this->tahunAjaran())->first();
        if (in_array(1, $request->kategori)) {
            if ($sks) {
                $sks->semester_ganjil = $request->sksGanjil;
                $sks->semester_genap = $request->sksGenap;
                $sks->save();
            } else {
                $sksDosen = new SksDosen([
                    'semester_ganjil' => $request->sksGanjil,
                    'semester_genap' => $request->sksGenap,
                    'tahun_ajaran' => $this->tahunAjaran()
                ]);
                $dosen->sks()->save($sksDosen);
            }
        } else if ($sks) $sks->delete();
        //pembimbing
        $pembimbing = $dosen->pembimbing()->where('tahun_ajaran', $this->tahunAjaran())->first();
        if (in_array(2, $request->kategori)) {
            if ($pembimbing) {
                $pembimbing->semester_ganjil = $request->pGanjil;
                $pembimbing->semester_genap = $request->pGenap;
                $pembimbing->save();
            } else {
                $pembimbingDosen = new PDosen([
                    'semester_ganjil' => $request->pGanjil,
                    'semester_genap' => $request->pGenap,
                    'tahun_ajaran' => $this->tahunAjaran()
                ]);
                $dosen->pembimbing()->save($pembimbingDosen);
            }
        } else if ($pembimbing) $pembimbing->delete();
        //penguji
        $penguji = $dosen->penguji()->where('tahun_ajaran', $this->tahunAjaran())->first();
        if (in_array(3, $request->kategori)) {
            if ($penguji) {
                $penguji->semester_ganjil = $request->pjGanjil;
                $penguji->semester_genap = $request->pjGenap;
                $penguji->save();
            } else {
                $pengujiDosen = new PjDosen([
                    'semester_ganjil' => $request->pjGanjil,
                    'semester_genap' => $request->pjGenap,
                    'tahun_ajaran' => $this->tahunAjaran()
                ]);
                $dosen->penguji()->save($pengujiDosen);
            }
        } else if ($penguji) $penguji->delete();

        //koordinator
        $koordinator = $dosen->koordinator()->where('tahun_ajaran', $this->tahunAjaran())->first();
        if (in_array(4, $request->kategori)) {
            if ($koordinator) {
                $koordinator->semester_ganjil = $request->kGanjil;
                $koordinator->semester_genap = $request->kGenap;
                $koordinator->save();
            } else {
                $koordinatorDosen = new KDosen([
                    'semester_ganjil' => $request->kGanjil,
                    'semester_genap' => $request->kGenap,
                    'tahun_ajaran' => $this->tahunAjaran()
                ]);
                $dosen->koordinator()->save($koordinatorDosen);
            }
        } else if ($koordinator) $koordinator->delete();
        //wali
        $wali = $dosen->wali()->where('tahun_ajaran', $this->tahunAjaran())->first();
        if (in_array(5, $request->kategori)) {
            if ($wali) {
                $wali->semester_ganjil = $request->wGanjil;
                $wali->semester_genap = $request->wGenap;
                $wali->save();
            } else {
                $waliDosen = new WDosen([
                    'semester_ganjil' => $request->wGanjil,
                    'semester_genap' => $request->wGenap,
                    'tahun_ajaran' => $this->tahunAjaran()
                ]);
                $dosen->wali()->save($waliDosen);
            }
        } else if ($wali) $wali->delete();


        return redirect()->route('admin.dosen.list', $request->tipe)->with(['success' => 'Berhasil update dosen']);
    }

    public function destroy(Dosen $dosen)
    {
        $kategori = $dosen->kategori;
        $dosen->kategori()->detach($kategori);
        $dosen->delete();
        return response()->json('Sukses');
    }

    public function list($tipe, Request $request)
    {
        if (strcmp($tipe, 'pengajar') == 0) $kategori = KategoriDosen::find(1);
        else if (strcmp($tipe, 'pembimbing') == 0) $kategori = KategoriDosen::find(2);
        else if (strcmp($tipe, 'penguji') == 0) $kategori = KategoriDosen::find(3);
        else if (strcmp($tipe, 'koordinator') == 0) $kategori = KategoriDosen::find(4);
        else if (strcmp($tipe, 'wali') == 0) $kategori = KategoriDosen::find(5);
        else return redirect()->route('admin.dosen.list', 'pengajar');
        if ($request->search) {
            $cek = $kategori->dosen()->where('nip', 'like', "%$request->search%");
            if ($cek->exists()) $dosen = $cek->paginate(10);
            else $dosen = $kategori->dosen()->where('nama', 'like', "%$request->search%")->paginate(10);
        } else
            $dosen = $kategori->dosen()->paginate(10);
        return view('admin.akademik.dosen',  compact('tipe', 'dosen'));
    }

    public function tahunAjaran()
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
