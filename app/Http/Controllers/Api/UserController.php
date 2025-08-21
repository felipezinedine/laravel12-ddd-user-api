<?php

namespace App\Http\Controllers\Api;

use App\Domain\User\Service\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index ()
    {
        try {
            return response()->json(['success' => true, 'users' => $this->userService->index()], 200);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function show (int $userId)
    {
        try {
            return response()->json(['success' => true, 'user' => $this->userService->getById($userId)], 200);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function store (Request $request)
    {
        try {
            return response()->json([
                'success' => true,
                'msg' => 'Usuário criado com sucesso!',
                'user' => $this->userService->store($request)
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => true, 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function update (Request $request, int $userId)
    {
        try {
            response()->json(['success' => true, 'user' => $this->userService->update($request, $userId)], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => true, 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function delete (int $userId)
    {
        try {
            $this->userService->delete($userId);
            return response()->json(['success' => true, 'msg' => 'Usuário excluído com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }
}
