<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceAdminFormRequest extends FormRequest
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
            'name.*' => ['required', Rule::unique('services', 'name->*')->ignore($this->id)],
            'icon' => 'image|mimes:png,jpg,webp,jpeg,svg,gif|max:100',
            'alt_image' => 'required',
            'interset' => 'required|numeric|between:0,100.00',
            'term' => 'required|integer',
            'amount' => 'required|integer',
            'promo_code' => 'nullable|string',
            'promo_discount' => 'nullable|integer',
            'vote_rating' => 'required|integer|between:1,10',
            'vote_count' => 'required|integer',
            'url' => 'required|url',
            'license.*' => 'required|string',
            'comp_name' => 'required',
            'email' => 'required|string',
            'address.*' => 'required',
            'phone' => 'required|string',

            'f-rating' => 'required|numeric|between:0,10',
            'f-approve' => 'required|numeric|between:0,10',
            'f-cost' => 'required|numeric|between:0,10',
        ];
    }
}