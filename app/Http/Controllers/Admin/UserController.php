<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::get();

        return response()->json($users);
    }

    public function store(Request $request)
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

        return response()->json(['message' => __('admin.user_created_successfully'), 'user' => $user], 201);
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => __('admin.user_not_found')], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => __('admin.user_not_found')], 404);
        }

        $validatedData = $request->validate([
            'name'     => ['sometimes', 'string', 'max:255'],
            'email'    => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update($validatedData);

        return response()->json(['message' => __('admin.user_updated_successfully'), 'user' => $user]);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => __('admin.user_not_found')], 404);
        }

        $user->delete();

        return response()->json(['message' => __('admin.user_deleted_successfully')]);
    }
}
