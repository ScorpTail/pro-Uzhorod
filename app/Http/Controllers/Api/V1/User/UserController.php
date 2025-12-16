<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $user,
            'appeals' => $user->appeals,
        ], 200);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name'  => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
        ]);

        $user = $request->user();

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        $user->save();

        return response()->json([
            'user'    => $user,
            'message' => __('front.user.update_success'),
        ], 200);
    }

    public function delete(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        $user->delete();

        return response()->json([
            'message' => __('front.user.delete_success'),
        ], 200);
    }
}
