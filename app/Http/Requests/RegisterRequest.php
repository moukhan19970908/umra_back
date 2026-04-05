<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|min:6',
            'surname' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Полное имя объязательно к заполнению',
            'surname.required' => 'Фамилия объязательно к заполнению',
            'phone.required' => 'Телефон объязательно к заполнению',
            'password.required' => 'Пароль объязательно к заполнению'
        ];
    }
}
