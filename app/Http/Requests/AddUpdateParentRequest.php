<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUpdateParentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'birth_date' => ['required', 'date', 'date_format:Y-m-d'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'residential_proofs' => ['nullable', 'array'],
            'residential_proofs.*' => ['file', 'mimes:pdf,jpeg,png,jpg', 'max:5120'],
            'education' => ['nullable', 'string'],
            'occupation' => ['nullable', 'string'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'childrens' => ['nullable', 'array'],
            'childrens.*' => ['string', 'exists:childrens,id']
        ];
    }
}