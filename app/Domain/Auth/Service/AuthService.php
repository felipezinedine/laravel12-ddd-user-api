<?php

namespace App\Domain\Auth\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function login (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:cpf|email',
            'cpf' => 'required_without:email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {

            $errors = collect($validator->errors()->toArray())
                ->map(fn($messages) => $messages[0])
                ->toArray();

            return response()->json(
                ['error' => true, 'msg' => 'Validation failed', 'errors' => $errors],
            422);
        }

        if ($request->filled('email')) {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(['error' => true, 'msg' => 'Unauthorized'], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);
        }

        if ($request->filled('cpf')) {
            if (!Auth::attempt($request->only(['cpf', 'password']))) {
                return response()->json(['error' => true, 'msg' => 'Unauthorized'], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);
        }

        return response()->json(['error' => true, 'msg' => 'Unauthorized'], 401);
    }
}
