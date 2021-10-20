<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GajiDosenRequest extends FormRequest
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
        return [
            'mengajar' => 'required|numeric',
            'wali' => 'required|numeric',
            'transport' => 'required|numeric',
            'regular' => 'required|numeric',
            'karyawan' => 'required|numeric',
            'eksekutif' => 'required|numeric',
            'interTeori' => 'required|numeric',
            'interPraktek' => 'required|numeric',
            'kerjaPraktek' => 'required|numeric',
            'skripsi1' => 'required|numeric',
            'skripsi2' => 'required|numeric',
            'ta1' => 'required|numeric',
            'ta2' => 'required|numeric',
            'seminarSkripsi' => 'required|numeric',
            'seminarTerbuka' => 'required|numeric',
            'proposal' => 'required|numeric',
            'ngujiTA' => 'required|numeric',
            'koreksiRegular' => 'required|numeric',
            'koreksiKaryawan' => 'required|numeric',
            'koreksiInter' => 'required|numeric',
            'soalRegular' => 'required|numeric',
            'soalKaryawan' => 'required|numeric',
            'soalInter' => 'required|numeric',
            'pengawas' => 'required|numeric',
            'lemburPengawas' => 'required|numeric',
            'koor' => 'required|numeric',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'mengajar' => str_replace(',', '', $this->mengajar),
            'wali' => str_replace(',', '', $this->wali),
            'transport' => str_replace(',', '', $this->transport),
            'interTeori' => str_replace(',', '', $this->interTeori),
            'interPraktek' => str_replace(',', '', $this->interPraktek),
            'kerjaPraktek' => str_replace(',', '', $this->kerjaPraktek),
            'regular' => str_replace(',', '', $this->regular),
            'karyawan' => str_replace(',', '', $this->karyawan),
            'eksekutif' => str_replace(',', '', $this->eksekutif),
            'skripsi1' => str_replace(',', '', $this->skripsi1),
            'skripsi2' => str_replace(',', '', $this->skripsi2),
            'ta1' => str_replace(',', '', $this->ta1),
            'ta2' => str_replace(',', '', $this->ta2),
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
            'dosenWali' => str_replace(',', '', $this->dosenWali),
            'pengawas' => str_replace(',', '', $this->pengawas),
            'lemburPengawas' => str_replace(',', '', $this->lemburPengawas),
            'koor' => str_replace(',', '', $this->koor),
        ]);
    }
}
