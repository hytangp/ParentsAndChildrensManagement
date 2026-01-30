<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'country' => ['required', 'string'],
            'birthdate' => ['required', 'date', 'date_format:Y-m-d']
        ];
    }
}