<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
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

    public function laporanBulanan()
    {
        $m = date('n');
        $bulan = array_slice(getBulan(), 0, $m);
        $dosen = Pegawai::where('is_dosen', true)->get();
        return view('admin.akademik.laporanBulanan',  compact('dosen', 'bulan'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Pegawai $pegawai, $bulan)
    {
        $bulanTahun = $bulan;
        $tmp = explode("-", $bulan);
        $bulan = $tmp[0];
        $tahun = $tmp[1];

        if ($pegawai->is_dosen === FALSE || $pegawai->is_dosen === NULL) abort(404);
        $pegawai = $pegawai->load(['dosen' => function ($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }]);
        // dd($pegawai);
        return view('admin.akademik.editDosen', compact('bulanTahun', 'pegawai'));
        /*
        $kategori = KategoriDosen::all();
        $ta = $pegawai->dosen()->where('kategori_id', 1)->wherePivot('bulan', $bulan)->wherePivot('tahun', $tahun)->first();
        $skripsi = $pegawai->dosen()->where('kategori_id', 2)->wherePivot('bulan', $bulan)->wherePivot('tahun', $tahun)->first();
        $penguji = $pegawai->dosen()->where('kategori_id', 3)->wherePivot('bulan', $bulan)->wherePivot('tahun', $tahun)->first();
        $koor = $pegawai->dosen()->where('kategori_id', 4)->wherePivot('bulan', $bulan)->wherePivot('tahun', $tahun)->first();
        $wali = $pegawai->dosen()->where('kategori_id', 5)->wherePivot('bulan', $bulan)->wherePivot('tahun', $tahun)->first();
        $kp = $pegawai->dosen()->where('kategori_id', 6)->wherePivot('bulan', $bulan)->wherePivot('tahun', $tahun)->first();
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
            'kp',
            'bulanTahun'
        ));
        */
    }

    public function update(DosenRequest $request, Pegawai $dosen)
    {
        // dd($request->sksGanjil);
        // dd($request->all());
        $tmp = explode("-", $request->bulanTahun);
        $bulan = $tmp[0];
        $tahun = $tmp[1];
        $data = Dosen::firstOrCreate([
            'pegawai_id' => $dosen->id,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
        $data->tugas_akhir_2_pembimbing_1 = $request->ta2pembimbing1;
        $data->tugas_akhir_2_pembimbing_1_nama = json_encode(($request->ta2pembimbing1nama) ? $request->ta2pembimbing1nama : []);
        $data->tugas_akhir_2_pembimbing_2 = $request->ta2pembimbing2;
        $data->tugas_akhir_2_pembimbing_2_nama = json_encode(($request->ta2pembimbing2nama) ? $request->ta2pembimbing2nama : []);

        $data->skripsi_2_pembimbing_1 = $request->skripsi2pembimbing1;
        $data->skripsi_2_pembimbing_1_nama = json_encode(($request->skripsi2pembimbing1nama) ? $request->skripsi2pembimbing1nama : []);
        $data->skripsi_2_pembimbing_2 = $request->skripsi2pembimbing2;
        $data->skripsi_2_pembimbing_2_nama = json_encode(($request->skripsi2pembimbing2nama) ? $request->skripsi2pembimbing2nama : []);

        $data->penguji_seminar_skripsi = $request->seminarSkripsi;
        $data->penguji_seminar_skripsi_nama = json_encode(($request->seminarSkripsiNama) ? $request->seminarSkripsiNama : []);
        $data->penguji_seminar_terbuka =  $request->seminarTerbuka;
        $data->penguji_seminar_terbuka_nama =  json_encode(($request->seminarTerbukaNama) ? $request->seminarTerbukaNama : []);
        $data->penguji_proposal_TA =  $request->proposal;
        $data->penguji_proposal_TA_nama =  json_encode(($request->proposalNama) ? $request->proposalNama : []);
        $data->penguji_tugas_akhir = $request->pengujiTugasAkhir;
        $data->penguji_tugas_akhir_nama = json_encode(($request->pengujiTugasAkhirNama) ? $request->pengujiTugasAkhirNama : []);

        $data->wali = $request->wali;
        $data->kerja_praktek = $request->kerjaPraktek;
        $data->save();

        return redirect()->route('admin.dosen.laporan.bulanan')->with(['success' => 'Berhasil update dosen']);
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
