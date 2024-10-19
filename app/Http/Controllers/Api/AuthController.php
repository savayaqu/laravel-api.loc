<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /*
     * Регистрация
     */
    public function register(RegisterRequest $request)
    {
        $roleId = Role::firstOrCreate(['code' => 'user'])->id;

        $user = User::create([
            ...$request->validated(),
            'role_id' => $roleId
        ]);
        $user->api_token = Hash::make(Str::random(60));
        $user->save();
        return response([
            'user' => UserResource::make($user),
            'token' => $user->api_token,
        ], 201);
    }


    /*
     * Авторизация
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('login', 'password')))
            throw new ApiException(401, 'Неверный логин и/или пароль');

        //пОЛУЧЕНИЕ ТЕкущего токена
        $user = Auth::user();
        //Сохранение нового токена
        $user->api_token = Hash::make(Str::random(60));
        $user->save();
        return response([
            'token' => $user->api_token,
            'data' => UserResource::make($user),
        ], 200);
    }


    /*
     * Выход
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        return response()->json(['message' => 'Вы вышли из системы'], 200);
    }
}
