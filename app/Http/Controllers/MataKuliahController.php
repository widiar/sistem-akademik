<?php

namespace App\Http\Controllers;

use App\Http\Requests\MataKuliahRequest;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return view('admin.akademik.matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('admin.akademik.matakuliah.create');
    }

    public function store(MataKuliahRequest $request)
    {
        $matakuliah = MataKuliah::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jam' => $request->jam,
            'hari' => $request->hari,
            'sks' => $request->sks,
        ]);
        $matakuliah->dosen()->attach($request->dosen);
        return redirect()->route('admin.matakuliah.index')->with(['success' => 'Berhasil menambah matakuliah']);
    }

    public function edit(MataKuliah $matakuliah)
    {
        // dd($matakuliah->dosen);
        $dosen = Dosen::all();
        return view('admin.akademik.matakuliah.edit', compact('matakuliah', 'dosen'));
    }

    public function update(MataKuliahRequest $request, MataKuliah $matakuliah)
    {
        $matakuliah->kode = $request->kode;
        $matakuliah->nama = $request->nama;
        $matakuliah->jam = $request->jam;
        $matakuliah->hari = $request->hari;
        $matakuliah->sks = $request->sks;
        $matakuliah->save();
        $matakuliah->dosen()->sync($request->dosen);
        return redirect()->route('admin.matakuliah.index')->with(['success' => 'Berhasil update matakuliah']);
    }

    public function delete(MataKuliah $matakuliah)
    {
        $dosen = $matakuliah->dosen;
        $matakuliah->dosen()->detach($dosen);
        $matakuliah->delete();
        return response()->json('Sukses');
    }
}
