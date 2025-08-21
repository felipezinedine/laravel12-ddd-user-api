<?php

namespace App\Domain\User\Service;

use App\Application\User\DTO\UserCreateDTO;
use App\Application\User\DTO\UserUpdateDTO;
use App\Domain\User\Repositories\UserInterface;
use App\Exceptions\UserNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index ()
    {
        return $this->userInterface->index();
    }

    public function getById (int $userId)
    {
        return $this->userInterface->getById($userId);
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
            throw new ValidationException($validator);
        }

        $dto = new UserCreateDTO($request->name, $request->email, $request->cpf, $request->password);
        return $this->userInterface->store($dto->toArray());
    }

    public function update (Request $request, int $userId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $userId . ',id',
            'cpf' => 'unique:users,cpf,' . $userId . ',id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $dto = new UserUpdateDTO($request->name, $request->email, $request->cpf);

        return $this->userInterface->update($dto->toArray(), $userId);
    }

    public function delete (int $userId)
    {
        if ($this->userInterface->getById($userId) == null) {
            throw new UserNotFoundException();
        }

        return $this->userInterface->delete($userId);
    }
}
