<?php

namespace App\Http\Controllers\Api;

use App\Domain\Auth\Service\AuthService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct (AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login (Request $request)
    {
        try {
            return $this->authService->login($request);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }
}
