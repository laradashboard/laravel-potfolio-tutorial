<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'start_year' => ['required', 'string', 'max:10'],
            'end_year' => ['nullable', 'string', 'max:10'],
            'current' => ['nullable', 'boolean'],
            'summary' => ['nullable', 'string'],
            'company_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'company_website' => ['nullable', 'url', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('current') && $this->current) {
            $this->merge([
                'end_year' => null,
            ]);
        }
    }
}
