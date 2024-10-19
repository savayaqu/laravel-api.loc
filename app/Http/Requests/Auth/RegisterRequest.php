<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;

class RegisterRequest extends ApiRequest
{
    //Правило авторизации
    public function authorize(): bool
    {
        return true;
    }
    // Правила валидации
    public function rules(): array
    {
        return [
            'login'      => ['required', 'string', 'max:255', 'unique:users'],
            'email'      => ['required', 'email', 'max:255', 'unique:users'],
            'surname'    => ['required', 'string', 'max:255'],
            'name'       => ['required', 'string', 'max:255'],
            'patronymic' => ['nullable', 'string', 'max:255'],
            'sex'        => ['required', 'boolean'],
            'birthday'   => ['required', 'date'  , 'max:255'],
            'password'   => ['required', 'string', 'max:255'],
        ];
    }
    // Кастомные сообщения об ошибках
}
