<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ActivityWebRequest extends FormRequest
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
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'report_period_start' => 'required|date',
            'report_period_end' => 'required|date', 
            'execution_task' => 'required|string',
            'result_plan' => 'required|string', // Rencana Hasil Kerja
            'action_plan' => 'required|string', // Rencana Aksi
            'output' => 'required|string',
            'budget' => 'nullable|numeric|min:0',
            'budget_source' => 'nullable|string',
        ];
    }
}
