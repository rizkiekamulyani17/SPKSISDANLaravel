<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BobotRequest extends FormRequest
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
            'bobot_id' => 'required|array', // Menambahkan aturan untuk bobot_id
            'bobot_id.*' => 'required|numeric', // Menambahkan aturan untuk setiap bobot_id dalam array
            'value' => 'required|array'
        ];
    }
}
