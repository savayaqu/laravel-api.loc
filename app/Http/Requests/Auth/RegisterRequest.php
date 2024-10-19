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
    public function messages(): array {
        return [
            'surname'.'required' => 'Фамилия обязательна для заполнения',
            'name'.'required' => 'Имя обязательно для заполнения',
            'surname'.'max' => 'Фамилия должна состоять максимум из 255 символов',
            'name'.'max' => 'Имя должно состоять максимум из 255 символов',
            'patronymic'.'max' => 'Отчество должно состоять максимум из 255 символов',
            'birthday'.'required' => 'Дата рождения обязательна для заполнения',
            'birthday'.'date' => 'ДР должен в формате YYYY-MM-DD',
            'login'.'required' => 'Логин обязателен для заполнения',
            'password'.'required' => 'Пароль обязателен для заполнения',
            'email'.'required' => 'Почта обязательна для заполнения',
            'sex'.'required' => 'Секс обязателен',
            'sex'.'boolean' => '0 - женщина 1 - мужчина',
            'login'.'max' => 'Логин должен состоять максимум из 255 символов',
            'email'.'max' => 'Почта должен состоять максимум из 255 символов',
            'password'.'max' => 'Пароль должен состоять максимум из 255 символов',

            'login'.'unique' => 'Данный логин занят',
            'email'.'unique' => 'Данная почта занята',


        ];
    }
}
