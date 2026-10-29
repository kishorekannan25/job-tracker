<?php

namespace App\Http\Requests;

use App\Enums\ApplicationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company' => 'required|max:255',
            'role' => 'required|max:255',
            'status' => ['required', Rule::enum(ApplicationStatus::class)],
            'applied_date' => 'required|date',
            'salary_range' => 'nullable|max:255',
            'notes' => 'nullable',
            'interview_at' => 'nullable|date',
        ];
    }
}
