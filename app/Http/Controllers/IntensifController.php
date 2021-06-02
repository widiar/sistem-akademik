<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\IntensifMarketing;
use Illuminate\Http\Request;

class IntensifController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $cek = Dosen::where('nip', 'like', "%$request->search%")->where('is_marketing', true);
            if ($cek->exists()) $dosen = $cek->paginate(10);
            else $dosen = Dosen::where('nama', 'like', "%$request->search%")->where('is_marketing', true)->paginate(10);
        } else
            $dosen = Dosen::where('is_marketing', true)->paginate(10);

        return view('admin.pemasaran.intensifMarketing', compact('dosen'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dosen = Dosen::find($request->dosen);
        $jumlah = $request->jumlah;
        $cek = $dosen->intensif()->where('tahun_ajaran', tahunAjaran())->first();
        if ($cek) {
            $cek->jumlah = $jumlah;
            $cek->save();
        } else {
            $intensif = new IntensifMarketing([
                'jumlah' => $jumlah,
                'tahun_ajaran' => tahunAjaran()
            ]);
            $dosen->intensif()->save($intensif);
        }
        return redirect()->route('admin.intensif-marketing.index')->with(['success' => 'Berhasil update data']);
    }

    public function show($id)
    {
        $cek = IntensifMarketing::where('dosen_id', $id)->where('tahun_ajaran', tahunAjaran())->first();
        if ($cek) return response()->json(["jumlah" => $cek->jumlah]);
        else return response()->json(["jumlah" => 0]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
