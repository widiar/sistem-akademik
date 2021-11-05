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
            'daftar' => 'required|integer',
            'regular' => 'required|integer',
            'karyawan' => 'required|integer',
            'international' => 'required|integer',
            'wawancara' => 'required|integer',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'daftar' => str_replace(',', '', $this->daftar),
            'regular' => str_replace(',', '', $this->regular),
            'karyawan' => str_replace(',', '', $this->karyawan),
            'international' => str_replace(',', '', $this->international),
            'wawancara' => str_replace(',', '', $this->wawancara),
        ]);
    }
}
