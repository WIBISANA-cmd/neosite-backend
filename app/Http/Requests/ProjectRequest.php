<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_name' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:perencanaan,desain,development,testing,selesai'],
            'progress_percent' => ['required', 'integer', 'min:0', 'max:100'],
            'deadline' => ['nullable', 'date'],
        ];
    }
}
