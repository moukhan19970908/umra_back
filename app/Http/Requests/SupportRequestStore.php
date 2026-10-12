<?php

namespace App\Http\Requests;

use App\Models\SupportRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupportRequestStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Normalize phone to digits only, as it is stored for users.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone' => preg_replace('/\D/', '', (string) $this->phone),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['required', Rule::in(array_keys(SupportRequest::SUBJECTS))],
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15',
            'message' => 'required|string|min:10|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Выберите тему обращения',
            'subject.in' => 'Выберите тему обращения из списка',
            'email.required' => 'Почта обязательна к заполнению',
            'email.email' => 'Введите корректный адрес почты',
            'phone.required' => 'Телефон обязателен к заполнению',
            'phone.digits_between' => 'Введите корректный номер телефона',
            'message.required' => 'Опишите вашу проблему',
            'message.min' => 'Опишите проблему подробнее (минимум 10 символов)',
            'message.max' => 'Описание не должно превышать 5000 символов',
        ];
    }
}
