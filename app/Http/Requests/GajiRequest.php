<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GajiRequest extends FormRequest
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
            'gaji' => 'required|numeric',
            'lembur' => 'required|numeric',
            'makan' => 'required|numeric',
            'jabatan' => 'required|numeric',
            'keahlian' => 'required|numeric',
            'pulsa' => 'required|numeric',
            'tol' => 'required|numeric',
            'kurangGaji' => 'required|numeric',
            'reward' => 'required|numeric',
            'thr' => 'required|numeric',
            'bpjsKesehatan' => 'required|numeric',
            'bpjsKerja' => 'required|numeric',
            'izin' => 'required|numeric',
            'telat' => 'required|numeric',
            'alpha' => 'required|numeric',
            'sanksi' => 'required|numeric',
            'kasbon' => 'required|numeric',
            'makanNonDinas' => 'required|numeric',
            'potonganLain' => 'required|numeric',
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
            'jabatan' => str_replace(',', '', $this->jabatan),
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
        ]);
    }
}
