<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class SessionController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer'
    ]);

    }

    public function destroy(Request $request){

        if($request){
            $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out']);
        // return reddirect('/');
    }else {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }
}
}
