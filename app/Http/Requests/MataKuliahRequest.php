<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MataKuliahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('matakuliah');
        return [
            'kode' => [
                'required',
                Rule::unique('mata_kuliah')->ignore($id),
            ],
            'nama' => 'required',
            'jam' => 'required',
            'hari' => 'required',
            'sks' => 'required|integer',
            'kategori' => 'required'
        ];
    }
}
