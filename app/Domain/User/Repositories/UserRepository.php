<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Mappers\UserMapper;
use App\Domain\User\Models\User as UserModel;
use App\Domain\User\Entities\User as UserEntity;

class UserRepository implements UserInterface
{
    protected $userModel;
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index (): array
    {
        return UserModel::all()
            ->map(fn($model) => UserMapper::toEntity($model))
            ->toArray();
    }

    public function getById (int $userId): ?UserEntity
    {
        $model = UserModel::find($userId);
        return $model ? UserMapper::toEntity($model) : null;
    }

    public function store (array $data)
    {
        $model = UserModel::create($data);
        return UserMapper::toEntity($model);
    }

    public function update (array $data, int $userId)
    {
        $model = UserModel::find($userId);
        $model->update($data);
        return UserMapper::toEntity($model);
    }

    public function delete (int $userId)
    {
        return UserModel::findOrFail($userId)->delete();
    }
}
