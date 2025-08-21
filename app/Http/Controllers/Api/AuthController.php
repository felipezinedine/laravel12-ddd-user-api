<?php

namespace App\Http\Controllers\Api;

use App\Domain\Auth\Service\AuthService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
            $returnService = $this->authService->login($request);
            return response()->json(array_merge(['success' => true], $returnService));
        } catch (ValidationException $e) {
            return response()->json(['error' => true, 'errors' => $e->errors()], 422);
        } catch (AuthenticationException $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 401);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function register (Request $request)
    {
        try {
            $returnService = $this->authService->register($request);
            return response()->json(array_merge(['success' => true], $returnService));
        } catch (ValidationException $e) {
            return response()->json(['error' => true, 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }
}
