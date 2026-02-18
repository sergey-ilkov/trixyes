<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostAdminFormRequest extends FormRequest
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
            'title.*' => 'required',
            'slug.*' => ['required', Rule::unique('posts', 'slug->*')->ignore($this->id)],
            'description.*' => 'required|min:100',
            'views' => 'required|integer',
            'image' => 'image|mimes:png,jpg,webp,jpeg,svg,gif|max:1024',
            'alt_image' => 'required',
            'body.*' => 'required|min:500',
        ];
    }
}