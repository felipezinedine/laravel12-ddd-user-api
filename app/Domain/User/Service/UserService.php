<?php

namespace App\Domain\User\Service;

use App\Application\User\DTO\UserCreateDTO;
use App\Application\User\DTO\UserUpdateDTO;
use App\Domain\User\Repositories\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserService
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index ()
    {
        return response()->json(['success' => true, 'users' => $this->userInterface->index()], 200);
    }

    public function getById (int $userId)
    {
        return response()->json(['success' => true, 'user' => $this->userInterface->getById($userId)], 200);
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email|string',
            'cpf' => 'required|unique:users,cpf',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors()->toArray())
                ->map(fn($messages) => $messages[0])
                ->toArray();

            return response()->json(['error' => true, 'errors' => $errors], 422);
        }

        $dto = new UserCreateDTO($request->name, $request->email, $request->cpf, $request->password);

        return response()->json([
            'success' => true,
            'msg' => 'Usuário criado com sucesso!',
            'user' => $this->userInterface->store($dto->toArray())
        ]);
    }

    public function update (Request $request, int $userId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $userId . ',id',
            'cpf' => 'unique:users,cpf,' . $userId . ',id',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors()->toArray())
                ->map(fn($messages) => $messages[0])
                ->toArray();

            return response()->json(['error' => true, 'errors' => $errors], 422);
        }

        $dto = new UserUpdateDTO($request->name, $request->email, $request->cpf);

        return response()->json(['success' => true, 'user' => $this->userInterface->update($dto->toArray(), $userId)], 200);
    }

    public function delete (int $userId)
    {
        if ($this->userInterface->getById($userId) == null) {
            return response()->json(['error' => true, 'msg' => 'Usuário não existe na nossa base de dados!'], 404);
        }

        $this->userInterface->delete($userId);

        return response()->json(['success' => true, 'msg' => 'Usuário excluído com sucesso!'], 200);
    }
}
