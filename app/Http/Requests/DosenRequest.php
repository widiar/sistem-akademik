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
        if (is_array($this->kategori) && in_array(1, $this->kategori)) {
            $additional['taGanjil'] = 'required|numeric';
            $additional['ta1Ganjil'] = 'required|numeric';
            $additional['ta2Ganjil'] = 'required|numeric';
            $additional['taGenap'] = 'required|numeric';
            $additional['ta1Genap'] = 'required|numeric';
            $additional['ta2Genap'] = 'required|numeric';
        }
        if (is_array($this->kategori) && in_array(2, $this->kategori)) {
            $additional['skripsiGanjil'] = 'required|numeric';
            $additional['skripsi1Ganjil'] = 'required|numeric';
            $additional['skripsi2Ganjil'] = 'required|numeric';
            $additional['skripsiGenap'] = 'required|numeric';
            $additional['skripsi1Genap'] = 'required|numeric';
            $additional['skripsi2Genap'] = 'required|numeric';
        }
        if (is_array($this->kategori) && in_array(6, $this->kategori)) {
            $additional['kpGanjil'] = 'required|numeric';
            $additional['kpGenap'] = 'required|numeric';
        }
        if (is_array($this->kategori) && in_array(4, $this->kategori)) {
            $additional['koorGanjil'] = 'required|numeric';
            $additional['koorGenap'] = 'required|numeric';
        }
        if (is_array($this->kategori) && in_array(5, $this->kategori)) {
            $additional['waliGanjil'] = 'required|numeric';
            $additional['waliGenap'] = 'required|numeric';
        }

        return [
            'nip' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
        ] + $additional;
    }

    public function messages()
    {
        return [
            'required' => 'This field is required',
        ];
    }
}
