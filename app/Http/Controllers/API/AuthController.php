<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // User Registration
    public function register(RegisterRequest $request)
    {
        // Create user with hashed password
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Create Sanctum token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response with token and user data
        return response()->json([
            'token' => $token,
            'user'  => $user,
        ], 201);
    }

    // User Login
    public function login(LoginRequest $request)
    {
        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check user exists and password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Create Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response with token and user data
        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    // Optional: Logout (Revoke tokens)
    public function logout(Request $request)
    {
        // Revoke current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
