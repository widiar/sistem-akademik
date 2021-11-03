<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $staff = '';
        if (is_array($this->jabatan) && in_array("staff", $this->jabatan)) $staff = '|required';
        $dosen = '';
        if (is_array($this->jabatan) && in_array("dosen", $this->jabatan)) $dosen = '|required';
        return [
            'nip' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email',

            'jabatanStaff' => $staff,
            'gaji' => 'numeric' . $staff,
            'lembur' => 'numeric' . $staff,
            'makan' => 'numeric' . $staff,
            'jabatanGaji' => 'numeric' . $staff,
            'keahlian' => 'numeric' . $staff,
            'pulsa' => 'numeric' . $staff,
            'tol' => 'numeric' . $staff,
            'kurangGaji' => 'numeric' . $staff,
            'reward' => 'numeric' . $staff,
            'thr' => 'numeric' . $staff,
            'bpjsKesehatan' => 'numeric' . $staff,
            'bpjsKerja' => 'numeric' . $staff,
            'izin' => 'numeric' . $staff,
            'telat' => 'numeric' . $staff,
            'alpha' => 'numeric' . $staff,
            'sanksi' => 'numeric' . $staff,
            'kasbon' => 'numeric' . $staff,
            'makanNonDinas' => 'numeric' . $staff,
            'potonganLain' => 'numeric' . $staff,

            'mengajar' => 'numeric' . $dosen,
            'wali' => 'numeric' . $dosen,
            'transport' => 'numeric' . $dosen,
            'regular' => 'numeric' . $dosen,
            'karyawan' => 'numeric' . $dosen,
            'eksekutif' => 'numeric' . $dosen,
            'interTeori' => 'numeric' . $dosen,
            'interPraktek' => 'numeric' . $dosen,
            'kerjaPraktek' => 'numeric' . $dosen,
            // 'skripsi1' => 'numeric' . $dosen,
            'skripsi2Pembimbing1' => 'numeric' . $dosen,
            'skripsi2Pembimbing2' => 'numeric' . $dosen,
            // 'ta1' => 'numeric' . $dosen,
            'ta2Pembimbing1' => 'numeric' . $dosen,
            'ta2Pembimbing2' => 'numeric' . $dosen,
            'seminarSkripsi' => 'numeric' . $dosen,
            'seminarTerbuka' => 'numeric' . $dosen,
            'proposal' => 'numeric' . $dosen,
            'ngujiTA' => 'numeric' . $dosen,
            'koreksiRegular' => 'numeric' . $dosen,
            'koreksiKaryawan' => 'numeric' . $dosen,
            'koreksiInter' => 'numeric' . $dosen,
            'soalRegular' => 'numeric' . $dosen,
            'soalKaryawan' => 'numeric' . $dosen,
            'soalInter' => 'numeric' . $dosen,
            'pengawas' => 'numeric' . $dosen,
            'lemburPengawas' => 'numeric' . $dosen,
            'koor' => 'numeric' . $dosen,
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'gaji' => str_replace(',', '', $this->gaji),
            'lembur' => str_replace(',', '', $this->lembur),
            'makan' => str_replace(',', '', $this->makan),
            'tol' => str_replace(',', '', $this->tol),
            'kurangGaji' => str_replace(',', '', $this->kurangGaji),
            'reward' => str_replace(',', '', $this->reward),
            'jabatanGaji' => str_replace(',', '', $this->jabatanGaji),
            'keahlian' => str_replace(',', '', $this->keahlian),
            'pulsa' => str_replace(',', '', $this->pulsa),
            'thr' => str_replace(',', '', $this->thr),
            'bpjsKesehatan' => str_replace(',', '', $this->bpjsKesehatan),
            'bpjsKerja' => str_replace(',', '', $this->bpjsKerja),
            'izin' => str_replace(',', '', $this->izin),
            'telat' => str_replace(',', '', $this->telat),
            'alpha' => str_replace(',', '', $this->alpha),
            'sanksi' => str_replace(',', '', $this->sanksi),
            'kasbon' => str_replace(',', '', $this->kasbon),
            'makanNonDinas' => str_replace(',', '', $this->makanNonDinas),
            'potonganLain' => str_replace(',', '', $this->potonganLain),

            'mengajar' => str_replace(',', '', $this->mengajar),
            'wali' => str_replace(',', '', $this->wali),
            'transport' => str_replace(',', '', $this->transport),
            'interTeori' => str_replace(',', '', $this->interTeori),
            'interPraktek' => str_replace(',', '', $this->interPraktek),
            'kerjaPraktek' => str_replace(',', '', $this->kerjaPraktek),
            'regular' => str_replace(',', '', $this->regular),
            'karyawan' => str_replace(',', '', $this->karyawan),
            'eksekutif' => str_replace(',', '', $this->eksekutif),
            // 'skripsi1' => str_replace(',', '', $this->skripsi1),
            'skripsi2Pembimbing1' => str_replace(',', '', $this->skripsi2Pembimbing1),
            'skripsi2Pembimbing2' => str_replace(',', '', $this->skripsi2Pembimbing2),
            // 'ta1' => str_replace(',', '', $this->ta1),
            'ta2Pembimbing1' => str_replace(',', '', $this->ta2Pembimbing1),
            'ta2Pembimbing2' => str_replace(',', '', $this->ta2Pembimbing2),
            'seminarSkripsi' => str_replace(',', '', $this->seminarSkripsi),
            'seminarTerbuka' => str_replace(',', '', $this->seminarTerbuka),
            'proposal' => str_replace(',', '', $this->proposal),
            'ngujiTA' => str_replace(',', '', $this->ngujiTA),
            'koreksiRegular' => str_replace(',', '', $this->koreksiRegular),
            'koreksiKaryawan' => str_replace(',', '', $this->koreksiKaryawan),
            'koreksiInter' => str_replace(',', '', $this->koreksiInter),
            'soalRegular' => str_replace(',', '', $this->soalRegular),
            'soalKaryawan' => str_replace(',', '', $this->soalKaryawan),
            'soalInter' => str_replace(',', '', $this->soalInter),
            'pengawas' => str_replace(',', '', $this->pengawas),
            'lemburPengawas' => str_replace(',', '', $this->lemburPengawas),
            'koor' => str_replace(',', '', $this->koor),
        ]);
    }
}
