<?php

namespace App\Http\Controllers;

use App\Models\InsentifMarketing;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class IntensifController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = Pegawai::with(['staff' => function ($q) {
            $q->where('jabatan', 'pemasaran');
        }])->where('is_staff', 1)->get();

        return view('admin.pemasaran.intensifMarketing', compact('pegawai'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $insentif = InsentifMarketing::firstOrCreate([
            'pegawai_id' => $request->dosen,
            'tahun_ajaran' => tahunAjaran()
        ]);
        $insentif->jumlah = $request->jumlah;
        $insentif->save();

        return redirect()->route('admin.intensif-marketing.index')->with(['success' => 'Berhasil update data']);
    }

    public function show($id)
    {
        $cek = InsentifMarketing::where('pegawai_id', $id)->where('tahun_ajaran', tahunAjaran())->first();
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
