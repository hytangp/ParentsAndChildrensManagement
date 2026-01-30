<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUpdateChildrenRequest extends FormRequest
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
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'parents' => ['nullable', 'array'],
            'parents.*' => ['string', 'exists:parents,id']
        ];
    }
}