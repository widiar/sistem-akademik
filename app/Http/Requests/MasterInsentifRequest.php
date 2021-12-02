<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MasterInsentifRequest extends FormRequest
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
            'daftar_regular' => 'required|numeric',
            'daftar_dd_inter' => 'required|numeric',
            'daftar_dd_nasional' => 'required|numeric',
            'registrasi_regular' => 'required|numeric',
            'registrasi_bisnis' => 'required|numeric',
            'registrasi_dd_inter' => 'required|numeric',
            'registrasi_dd_nasional' => 'required|numeric',
            'wawancara' => 'required|numeric',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'daftar_regular' => str_replace(',', '', $this->daftar_regular),
            'daftar_dd_inter' => str_replace(',', '', $this->daftar_dd_inter),
            'daftar_dd_nasional' => str_replace(',', '', $this->daftar_dd_nasional),
            'registrasi_regular' => str_replace(',', '', $this->registrasi_regular),
            'registrasi_bisnis' => str_replace(',', '', $this->registrasi_bisnis),
            'registrasi_dd_inter' => str_replace(',', '', $this->registrasi_dd_inter),
            'registrasi_dd_nasional' => str_replace(',', '', $this->registrasi_dd_nasional),
            'wawancara' => str_replace(',', '', $this->wawancara),
        ]);
    }
}
