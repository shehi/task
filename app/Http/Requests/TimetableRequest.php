<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimetableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'started_at' => 'nullable|date',
            'ended_at' => 'nullable|date|gt:started_at',
        ];
    }
}
