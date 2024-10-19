<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    // Вызов исключения при ошибке валидации
    public function failedValidation(Validator $validator) {
        throw new ApiException(422, 'Ошибка валидации данных', $validator->errors());
    }
    // Вызов исключения при ошибке авторизации
    public function failedAuthorization()
    {
        throw new ApiException(401, 'Ошибка авторизации');
    }
}
