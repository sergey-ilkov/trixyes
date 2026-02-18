<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ActionAdminFormRequest extends FormRequest
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
            // 'name' => ['required', Rule::unique('actions')->ignore($this->id)],
            'name.*' => ['required', Rule::unique('actions', 'name->*')->ignore($this->id)],
            'slug' => ['required', Rule::unique('actions')->ignore($this->id)],
        ];
    }
}