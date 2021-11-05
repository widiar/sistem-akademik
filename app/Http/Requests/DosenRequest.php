<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DosenRequest extends FormRequest
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
        $additional = [];
        if ($this->ta2pembimbing1 > 0) {
            $additional['ta2pembimbing1nama'] = 'required';
        }
        if ($this->ta2pembimbing2 > 0) {
            $additional['ta2pembimbing2nama'] = 'required';
        }
        if ($this->skripsi2pembimbing1 > 0) {
            $additional['skripsi2pembimbing1nama'] = 'required';
        }
        if ($this->skripsi2pembimbing2 > 0) {
            $additional['skripsi2pembimbing2nama'] = 'required';
        }
        if ($this->seminarSkripsi > 0) {
            $additional['seminarSkripsiNama'] = 'required';
        }
        if ($this->seminarTerbuka > 0) {
            $additional['seminarTerbukaNama'] = 'required';
        }
        if ($this->proposal > 0) {
            $additional['proposalNama'] = 'required';
        }
        if ($this->pengujiTugasAkhir > 0) {
            $additional['pengujiTugasAkhirNama'] = 'required';
        }

        return [
            'nip' => 'required',
            'nama' => 'required',
            'ta2pembimbing1' => 'required|numeric',
            'ta2pembimbing2' => 'required|numeric',
            'skripsi2pembimbing1' => 'required|numeric',
            'skripsi2pembimbing2' => 'required|numeric',
            'seminarSkripsi' => 'required|numeric',
            'seminarTerbuka' => 'required|numeric',
            'proposal' => 'required|numeric',
            'pengujiTugasAkhir' => 'required|numeric',
            'wali' => 'required|numeric',
            'kerjaPraktek' => 'required|numeric',
        ] + $additional;
    }

    public function messages()
    {
        return [
            // 'required' => 'This field is required',
        ];
    }
}
