<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'surname' => 'required|string|max:255',
'name' => 'required|string|max:255',
'patronymic' => 'nullable|string|max:255',
'sex' => 'required|boolean',
'birthday' => 'required|date',
'login' => 'required|string|max:255|unique:users',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|max:255|confirmed',
        ];
    }
}
