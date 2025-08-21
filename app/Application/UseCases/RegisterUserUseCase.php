<?php

namespace App\Application\UseCases;

use App\Domain\Auth\Service\AuthService;
use app\Domain\User\Mappers\UserMapper;
use App\Domain\User\Service\UserService;
use Illuminate\Http\Request;

class RegisterUserUseCase
{
    protected $userService, $authService;

    public function __construct(UserService $userService, AuthService $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function handle (Request $request): array
    {
        $user = $this->userService->store($request);
        $token = $this->authService->generateToken(UserMapper::toModel($user));

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
