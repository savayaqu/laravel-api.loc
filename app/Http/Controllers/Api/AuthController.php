<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\Role;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //reg
    public function register(RegisterRequest $request) {
        // find role
        $role_id = Role::where(['code' => 'user'])->first()->id;
        // find validated data
        $validated = $request->validated();
        // create new user
        $user = User::create([... $validated, 'role_id' => $role_id]);
        //create token
        $token = $user->createToken('token')->plainTextToken;
        // return answer with token
        return response()->json([new UserResource($user), 'token' => $token])->setStatusCode(201);

    }
    //auth


    //logout
}
