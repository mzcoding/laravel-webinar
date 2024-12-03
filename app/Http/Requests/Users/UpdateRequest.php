<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'  => ['required', 'string', 'min:2', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50'],
            /*'ids'   => ['required', 'array'],
            'ids.*' => ['required', 'integer', 'exists:users,id'],*/
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Поле :attribute обязательно',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '"имя пользователя"'
        ];
    }

    public function getName(): string
    {
        return $this->validated('name');
    }
}
