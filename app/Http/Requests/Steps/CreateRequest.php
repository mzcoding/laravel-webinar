<?php

declare(strict_types=1);

namespace App\Http\Requests\Steps;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'goal_id' => ['required', 'integer', 'exists:goals,id'],
            'name' => ['required', 'string'],
            'started_at' => ['required', 'date', 'date_format:Y-m-d'],
            'finished_at' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:started_at'],
        ];
    }
}
