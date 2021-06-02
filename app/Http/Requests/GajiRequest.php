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
            'pokokDosen' => 'required|numeric',
            'tunjanganDosen' => 'required|numeric',
            'bonusDosen' => 'required|numeric',
            'pokokStaff' => 'required|numeric',
            'tunjanganStaff' => 'required|numeric',
            'bonusStaff' => 'required|numeric',
            'pokokMarketing' => 'required|numeric',
            'tunjanganMarketing' => 'required|numeric',
            'bonusMarketing' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'pokokDosen' => 'Gaji Pokok Dosen',
            'pokokStaff' => 'Gaji Pokok Staff',
            'pokokMarketing' => 'Gaji Pokok Marketing',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'pokokDosen' => str_replace(',', '', $this->pokokDosen),
            'tunjanganDosen' => str_replace(',', '', $this->tunjanganDosen),
            'bonusDosen' => str_replace(',', '', $this->bonusDosen),
            'pokokMarketing' => str_replace(',', '', $this->pokokMarketing),
            'tunjanganMarketing' => str_replace(',', '', $this->tunjanganMarketing),
            'bonusMarketing' => str_replace(',', '', $this->bonusMarketing),
            'pokokStaff' => str_replace(',', '', $this->pokokStaff),
            'tunjanganStaff' => str_replace(',', '', $this->tunjanganStaff),
            'bonusStaff' => str_replace(',', '', $this->bonusStaff),
        ]);
    }
}
