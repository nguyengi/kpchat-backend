<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $user = User::findByName($request->get('name'));
            $user->tokens()->delete();
            $token = $user->createToken('api');
            return UserResource::make($user)->withToken($token->plainTextToken);
        }
        return Response::unauthorized();
    }

    public function register(UserRegisterRequest $request)
    {
        $name = $request->get('name');
        if (! User::findByName($name)) {
            $user = User::create([
                'name' => $name,
                'password' => Hash::make($request->get('password'))
            ]);
            $token = $user->createToken('api');
            return UserResource::make($user)->withToken($token->plainTextToken);
        }
        return Response::badRequest();
    }

    public function user(Request $request)
    {
        return UserResource::make($request->user());
    }
}
