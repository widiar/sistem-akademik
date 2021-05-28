<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\KategoriDosen;
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
        $kategori = KategoriDosen::all();
        return view('admin.akademik.editDosen', compact('kategori', 'dosen', 'tipe'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
        ]);
        $dosen->nip = $request->nip;
        $dosen->nama = $request->nama;
        $dosen->kategori()->sync($request->kategori);
        $dosen->save();

        return redirect()->route('admin.dosen.list', $request->tipe)->with(['success' => 'Berhasil update dosen']);
    }

    public function destroy($id)
    {
        //
    }

    public function list($tipe)
    {
        if (strcmp($tipe, 'pengajar') == 0) $kategori = KategoriDosen::find(1);
        else if (strcmp($tipe, 'pembimbing') == 0) $kategori = KategoriDosen::find(2);
        else if (strcmp($tipe, 'penguji') == 0) $kategori = KategoriDosen::find(3);
        else if (strcmp($tipe, 'koordinator') == 0) $kategori = KategoriDosen::find(4);
        else if (strcmp($tipe, 'wali') == 0) $kategori = KategoriDosen::find(5);
        $dosen = $kategori->dosen;
        return view('admin.akademik.dosen',  compact('tipe', 'dosen'));
    }
}
