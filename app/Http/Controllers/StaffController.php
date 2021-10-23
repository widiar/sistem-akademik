<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Models\DetailDosen;
use App\Models\DetailStaff;
use App\Models\Pegawai;
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
        $dosen = Pegawai::all();
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
    public function store(PegawaiRequest $request)
    {
        if (in_array("dosen", $request->jabatan)) $is_dosen = TRUE;
        else $is_dosen = NULL;
        if (in_array("staff", $request->jabatan)) $is_staff = TRUE;
        else $is_staff = NULL;
        $pegawai = Pegawai::create([
            'nip' => $request->nip,
            'nama' =>  $request->nama,
            'email' => $request->email,
            'is_dosen' => ($is_dosen) ? $is_dosen : NULL,
            'is_staff' => ($is_staff) ? $is_staff : NULL,
        ]);
        if (in_array("dosen", $request->jabatan)) {
            $pegawai->detailDosen()->create([
                'mengajar' => $request->mengajar,
                'wali' => $request->wali,
                'transport' => $request->transport,
                'regular' => $request->regular,
                'karyawan' => $request->karyawan,
                'eksekutif' => $request->eksekutif,
                'interTeori' => $request->interTeori,
                'interPraktek' => $request->interPraktek,
                'kerjaPraktek' => $request->kerjaPraktek,
                'skripsi1' => $request->skripsi1,
                'skripsi2' => $request->skripsi2,
                'ta1' => $request->ta1,
                'ta2' => $request->ta2,
                'seminarSkripsi' => $request->seminarSkripsi,
                'seminarTerbuka' => $request->seminarTerbuka,
                'proposal' => $request->proposal,
                'ngujiTA' => $request->ngujiTA,
                'koreksiRegular' => $request->koreksiRegular,
                'koreksiKaryawan' => $request->koreksiKaryawan,
                'koreksiInter' => $request->koreksiInter,
                'soalRegular' => $request->soalRegular,
                'soalKaryawan' => $request->soalKaryawan,
                'soalInter' => $request->soalInter,
                'pengawas' => $request->pengawas,
                'lemburPengawas' => $request->lemburPengawas,
                'koor' => $request->koor,
            ]);
        }
        if (in_array("staff", $request->jabatan)) {
            $dt =  [];
            foreach ($request->jabatanStaff as $jbt) {
                $dt[] = ['jabatan' => $jbt];
            }

            $pegawai->staff()->createMany($dt);
            $pegawai->detailStaff()->create([
                'gaji' => $request->gaji,
                'lembur' => $request->lembur,
                'makan' => $request->makan,
                'jabatan' => $request->jabatanGaji,
                'keahlian' => $request->keahlian,
                'pulsa' => $request->pulsa,
                'tol' => $request->tol,
                'kurang_gaji' => $request->kurangGaji,
                'reward' => $request->reward,
                'thr' => $request->thr,
                'bpjs_kesehatan' => $request->bpjsKesehatan,
                'bpjs_kerja' => $request->bpjsKerja,
                'izin' => $request->izin,
                'telat' => $request->telat,
                'gaji' => $request->gaji,
                'alpha' => $request->alpha,
                'sanksi' => $request->sanksi,
                'kasbon' => $request->kasbon,
                'makanNonDinas' => $request->makanNonDinas,
                'potonganLain' => $request->potonganLain,
            ]);
        }
        return redirect()->route('admin.staff.index')->with(['success' => 'Berhasil menambah data pegawai']);
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

    public function edit($id)
    {
        $data = Pegawai::with(['dosen', 'staff', 'detailDosen', 'detailStaff'])->findOrFail($id);
        return view('admin.hrd.staff.edit', compact('data'));
    }

    public function update(PegawaiRequest $request, $id)
    {
        if (in_array("dosen", $request->jabatan)) $is_dosen = TRUE;
        else $is_dosen = NULL;
        if (in_array("staff", $request->jabatan)) $is_staff = TRUE;
        else $is_staff = NULL;
        $data = Pegawai::with(['dosen', 'staff', 'detailDosen', 'detailStaff'])->find($id);
        $data->nip = $request->nip;
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->is_dosen = $is_dosen;
        $data->is_staff = $is_staff;
        $data->save();

        if (in_array("dosen", $request->jabatan)) {
            $detailDosen = DetailDosen::firstOrCreate(['pegawai_id' => $data->id]);
            $detailDosen->mengajar = $request->mengajar;
            $detailDosen->wali = $request->wali;
            $detailDosen->transport = $request->transport;
            $detailDosen->regular = $request->regular;
            $detailDosen->karyawan = $request->karyawan;
            $detailDosen->eksekutif = $request->eksekutif;
            $detailDosen->interTeori = $request->interTeori;
            $detailDosen->interPraktek = $request->interPraktek;
            $detailDosen->kerjaPraktek = $request->kerjaPraktek;
            $detailDosen->skripsi1 = $request->skripsi1;
            $detailDosen->skripsi2 = $request->skripsi2;
            $detailDosen->ta1 = $request->ta1;
            $detailDosen->ta2 = $request->ta2;
            $detailDosen->seminarSkripsi = $request->seminarSkripsi;
            $detailDosen->seminarTerbuka = $request->seminarTerbuka;
            $detailDosen->proposal = $request->proposal;
            $detailDosen->ngujiTA = $request->ngujiTA;
            $detailDosen->koreksiRegular = $request->koreksiRegular;
            $detailDosen->koreksiKaryawan = $request->koreksiKaryawan;
            $detailDosen->koreksiInter = $request->koreksiInter;
            $detailDosen->soalRegular = $request->soalRegular;
            $detailDosen->soalKaryawan = $request->soalKaryawan;
            $detailDosen->soalInter = $request->soalInter;
            $detailDosen->pengawas = $request->pengawas;
            $detailDosen->lemburPengawas = $request->lemburPengawas;
            $detailDosen->koor = $request->koor;
            $detailDosen->save();
        } else {
            if ($data->detailDosen) $data->detailDosen()->delete();
        }
        if (in_array("staff", $request->jabatan)) {
            $dt =  [];
            foreach ($request->jabatanStaff as $jbt) {
                $dt[] = ['jabatan' => $jbt];
            }
            $data->staff()->delete();
            $data->staff()->createMany($dt);

            $detailStaff = DetailStaff::firstOrCreate(['pegawai_id' => $data->id]);
            $detailStaff->gaji = $request->gaji;
            $detailStaff->lembur = $request->lembur;
            $detailStaff->makan = $request->makan;
            $detailStaff->jabatan = $request->jabatanGaji;
            $detailStaff->keahlian = $request->keahlian;
            $detailStaff->pulsa = $request->pulsa;
            $detailStaff->tol = $request->tol;
            $detailStaff->kurang_gaji = $request->kurangGaji;
            $detailStaff->reward = $request->reward;
            $detailStaff->thr = $request->thr;
            $detailStaff->bpjs_kesehatan = $request->bpjsKesehatan;
            $detailStaff->bpjs_kerja = $request->bpjsKerja;
            $detailStaff->izin = $request->izin;
            $detailStaff->telat = $request->telat;
            $detailStaff->gaji = $request->gaji;
            $detailStaff->alpha = $request->alpha;
            $detailStaff->sanksi = $request->sanksi;
            $detailStaff->kasbon = $request->kasbon;
            $detailStaff->makanNonDinas = $request->makanNonDinas;
            $detailStaff->potonganLain = $request->potonganLain;
            $detailStaff->save();
        } else {
            if ($data->detailStaff) {
                $data->staff()->delete();
                $data->detailStaff()->delete();
            }
        }

        return redirect()->route('admin.staff.index')->with(['success' => 'Berhasil update data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pegawai::with(['dosen', 'staff', 'detailDosen', 'detailStaff'])->find($id);
        if ($data->dosen()->count() > 0) $data->dosen()->delete();
        if ($data->detailStaff) {
            $data->staff()->delete();
            $data->detailStaff()->delete();
        }
        if ($data->detailDosen) $data->detailDosen()->delete();
        $data->delete();
        return response()->json('Sukses');
    }
}
