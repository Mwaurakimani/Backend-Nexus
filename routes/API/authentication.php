<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/authenticate', function (Request $request) {

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        $existingToken = $user->tokens()->first();

        if ($existingToken) {
            $existingToken->delete();
            $token = $user->createToken('API Token');

            return response()->json([
                'success' => true,
                'token' => $token->plainTextToken
            ], 200);
        } else {
            $token = $user->createToken('API Token');

            return response()->json([
                'success' => true,
                'token' => $token->plainTextToken
            ], 200);
        }
    }

    return response()->json(['error' => 'Invalid credentials'], 401);
});


