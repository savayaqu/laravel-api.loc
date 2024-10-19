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
        $token = $user->createToken('remember_token')->plainTextToken;
        return response([
            'token' => $token,
            'data' => UserResource::make($user),
        ], 201);
    }


    /*
     * Авторизация
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('login', 'password')))
            throw new ApiException(401, 'Invalid credentials');

        $user = Auth::user();
        $token = $user->createToken('remember_token')->plainTextToken;
        return response([
            'token' => $token,
            'data' => UserResource::make($user),
        ], 201);
    }


    /*
     * Выход
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(null, 204);
    }
}
