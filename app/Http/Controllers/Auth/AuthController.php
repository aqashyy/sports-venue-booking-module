<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validated = $request->validate([
            'name'      =>  'required|string|max:255',
            'email'     =>  'required|email|unique:users',
            'phone'     =>  'required|numeric|unique:users',
            'password'  =>  'required|min:8'
        ]);

        $user   =   User::create($validated);
        if($user)
        {
            return response()->json([
                'message'   => 'Registration successfully completed.',
                'token' =>  $user->createToken('auth-token')->plainTextToken,
            ],200);
        }
        return response()->json([
            'message'   => 'Oops..something went wrong!',
        ],401);

    }
    public function login(Request $request)
    {

        $credentials    =   $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        if(Auth::attempt($credentials))
        {
            return response()->json([
                'token' =>  auth()->user()->createToken('auth-token')->plainTextToken
            ],200);
        }

        return response()->json([
            'message' => 'invalid credentials!'
        ],401);

    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout success!'
        ],200);
    }
}
