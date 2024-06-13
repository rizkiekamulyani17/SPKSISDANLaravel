<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nis' => 'required',
            'nama_siswa' => 'required|max:60|min:5',
            'kelas_id'    => 'required',
            'jenis_kelamin'   => 'required',
            'agama'  => 'required',
            'alamat'   => 'required',
            'validasi'    => 'required',
            'user_id'     => 'required',
        ];
    }
}