<?php

namespace App\Http\Controllers\Api;

use App\Domain\User\Service\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

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
            return $this->userService->index();
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function show (int $userId)
    {
        try {
            return $this->userService->getById($userId);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function store (Request $request)
    {
        try {
            return $this->userService->store($request);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function update (Request $request, int $userId)
    {
        try {
            return $this->userService->update($request, $userId);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function delete (int $userId)
    {
        try {
            return $this->userService->delete($userId);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }
}
