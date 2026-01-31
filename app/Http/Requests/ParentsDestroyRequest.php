<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentsDestroyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ids' => ['required', 'array']
        ];
    }
}
