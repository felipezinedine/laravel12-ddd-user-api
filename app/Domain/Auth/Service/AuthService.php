<?php

namespace App\Domain\Auth\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\AuthenticationException;
use App\Domain\User\Models\User as UserModel;
use Illuminate\Validation\ValidationException;
use App\Application\UseCases\RegisterUserUseCase;

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
            throw new ValidationException($validator);
        }

        if ($request->filled('email')) {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                throw new AuthenticationException('Unauthorized');
            }

            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return ['token' => $token, 'user' => $user];
        }

        if ($request->filled('cpf')) {
            if (!Auth::attempt($request->only(['cpf', 'password']))) {
                throw new AuthenticationException('Unauthorized');
            }

            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return ['token' => $token, 'user' => $user];
        }

        throw new AuthenticationException('Unauthorized');
    }

    public function register (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|unique:users,cpf',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $getUseCase = app(RegisterUserUseCase::class);
        $responseUseCase = $getUseCase->handle($request);

        return [
            'token' => $responseUseCase['token'],
            'user' => $responseUseCase['user'],
        ];
    }

    public function generateToken (UserModel $user)
    {
        return $user->createToken('authToken')->accessToken;
    }
}
