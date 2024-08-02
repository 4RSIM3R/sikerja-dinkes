<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class WebSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'chief_name' => 'required|string|max:255',
            'chief_nip' => 'required|string|max:255',
            'banner' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg|max:1024',
        ];
    }
}
