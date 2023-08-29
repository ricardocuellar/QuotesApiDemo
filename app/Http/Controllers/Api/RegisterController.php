<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function  store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }
}
