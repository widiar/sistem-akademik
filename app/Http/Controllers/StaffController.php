<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ck = '03-10-2021';
        // dd(date('Y-m-d', strtotime($ck)));
        $dosen = Dosen::where('staf_akademik', '!=', 1)->get();
        return view('admin.hrd.staff.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hrd.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
        ]);
        $hrd = in_array("hrd", $request->jabatan);
        $keuangan = in_array("keuangan", $request->jabatan);
        $pemasaran = in_array("pemasaran", $request->jabatan);
        Dosen::create([
            'nip' => $request->nip,
            'nama' =>  $request->nama,
            'staf_akademik' => 0,
            'staf_hrd' => $hrd,
            'staf_keuangan' => $keuangan,
            'staf_pemasaran' => $pemasaran,
        ]);
        return redirect()->route('admin.staff.index')->with(['success' => 'Berhasil menambah data staff']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Dosen::find($id);
        return view('admin.hrd.staff.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
        ]);
        $hrd = in_array("hrd", $request->jabatan);
        $keuangan = in_array("keuangan", $request->jabatan);
        $pemasaran = in_array("pemasaran", $request->jabatan);
        $data = Dosen::find($id);
        $data->nip = $request->nip;
        $data->nama = $request->nama;
        $data->staf_hrd = $hrd;
        $data->staf_keuangan = $keuangan;
        $data->staf_pemasaran = $pemasaran;
        $data->save();
        return redirect()->route('admin.staff.index')->with(['success' => 'Berhasil update data staff']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Dosen::find($id);
        $data->delete();
        return response()->json('Sukses');
    }
}
