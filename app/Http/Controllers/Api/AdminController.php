<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


   public function login(Request $request){

        $fields = $request->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string',
            ],
            [
                'username.required' => 'username is required',
                'password.required' => 'Password is required',
            ]
        );

        $admin = Admin::where('username', $fields['username'])->first();

        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response([
                'error' => 'Username or Password wrong'
            ], 401);
        }

        $token = $admin->createToken($request['username'], ['admin'])->plainTextToken;

        $response = [
            'admin' => $admin,
            'admin_token' => $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {
        $fields = $request->validate(
            [
                'name' => 'required|string',
                'username' => 'required|string|unique:admins,username',
                'email' => 'required|string|email|unique:admins,email',
                'password' => 'required|string|confirmed|min:8',
            ],
            [
                'name.required' => 'name is required',
                'username.required' => 'Username is required',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
            ]
        );

        $admin = Admin::create([
            'name' => $fields['name'],
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        $token = $admin->createToken($request['username'], ['admin'])->plainTextToken;

        $response = [
            'admin' => $admin,
            'admin_token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logged out successfully'
        ]);
    }
}
