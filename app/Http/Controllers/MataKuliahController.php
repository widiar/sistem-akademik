<?php

namespace App\Http\Controllers;

use App\Http\Requests\MataKuliahRequest;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return view('admin.akademik.matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        $hari = [
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
        ];
        return view('admin.akademik.matakuliah.create', compact('hari'));
    }

    public function store(MataKuliahRequest $request)
    {
        MataKuliah::create([
            'kode' => $request->kode,
            'kode_kelas' => $request->kode_kelas,
            'nama' => $request->nama,
            'jam' => $request->jam,
            'hari' => $request->hari,
            'sks' => $request->sks,
            'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
            'kategori' => $request->kategori,
            'pegawai_id' => $request->dosen
        ]);
        return redirect()->route('admin.matakuliah.index')->with(['success' => 'Berhasil menambah matakuliah']);
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view('admin.akademik.matakuliah.edit', compact('matakuliah'));
    }

    public function update(MataKuliahRequest $request, MataKuliah $matakuliah)
    {
        $matakuliah->kode = $request->kode;
        $matakuliah->kode_kelas = $request->kode_kelas;
        $matakuliah->nama = $request->nama;
        $matakuliah->jam = $request->jam;
        $matakuliah->hari = $request->hari;
        $matakuliah->sks = $request->sks;
        $matakuliah->jumlah_mahasiswa = $request->jumlah_mahasiswa;
        $matakuliah->kategori = $request->kategori;
        $matakuliah->pegawai_id = $request->dosen;
        $matakuliah->save();
        return redirect()->route('admin.matakuliah.index')->with(['success' => 'Berhasil update matakuliah']);
    }

    public function delete(MataKuliah $matakuliah)
    {
        $dosen = $matakuliah->dosen;
        $matakuliah->dosen()->detach($dosen);
        $matakuliah->delete();
        return response()->json('Sukses');
    }

    public function list(Request $request)
    {
        $search = $request->search;
        if (env('DB_CONNECTION') == 'mysql')
            $matkul = MataKuliah::where("nama", 'like', "%$search%")->distinct('nama')->get();
        else
            $matkul = MataKuliah::where("nama", 'ilike', "%$search%")->distinct('nama')->get();
        $data = [];
        foreach ($matkul as $ds) {
            $data[] = [
                'id' => $ds->nama,
                'text' => $ds->nama
            ];
        }
        return response()->json($data);
    }
}
