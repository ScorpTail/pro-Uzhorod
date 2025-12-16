<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userData = $request->all();

        $user = User::create([
            'name'     => $userData['name'],
            'email'    => $userData['email'],
            'password' => bcrypt($userData['password']),
        ]);

        auth()->login($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'   => $user,
            'token'  => $token,
            'message' => __('front.auth.register_success'),
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'   => $user,
            'token'  => $token,
            'message' => __('front.auth.login_success'),
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => __('front.auth.logout_success'),
        ], 200);
    }
}
